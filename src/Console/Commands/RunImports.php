<?php namespace Corals\Modules\Amazon\Console\Commands;


use Corals\Modules\Amazon\Models\Import;
use Corals\Modules\Marketplace\Models\Store;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class RunImports extends Command
{
    protected $signature = 'import:run';
    protected $description = 'Execute Pending Imports to import products';

    public function handle()
    {
        return $this->processImports();
    }


    public function processImports()
    {

        $running_import = Import::where('status', 'in_progress')->first();
        if ($running_import) {
            $this->info("There is already running import process ");
            return false;
        }

        $import = Import::pending()->orderBy('created_at', 'asc')->first();
        if (!$import) {
            $this->info("There is no Pending imports");
            return true;
        }


        try {
            $this->info("Running Import: " . $import->title);

            $categories = \ImportCategory::whereNotNull('external_id')->pluck('id', 'external_id')->toArray();
            $brands = \ImportBrand::all()->pluck('id', 'name')->toArray();
            $tags = \ImportTag::all()->pluck('id', 'name')->toArray();

            //$import->status = 'in_progress';
            $import->notes = '';
            $import->save();

            if ($import->keywords) {
                $keywords = implode(', ', $import->keywords);

            } else {
                $keywords = "";
            }

            $associate_tag = "";
            if ($import->store_id) {
                $store = Store::find($import->store_id);

                $config = [
                    'api_key' => $store->getSettingValue('amazon_api_access_key', ''),
                    'api_secret_key' => $store->getSettingValue('amazon_api_access_secret', ''),
                    'host' => 'webservices.amazon.' . $store->getSettingValue('amazon_api_country', 'com'),
                    'region' => $store->getSettingValue('amazon_api_region', '')
                ];
                $associate_tag = $store->getSettingValue('amazon_api_associate_tag', '');


            } else {
                $config = [
                    'api_key' => \Settings::get('amazon_api_access_key', ''),
                    'api_secret_key' => \Settings::get('amazon_api_access_secret', ''),
                    'associate_tag' => \Settings::get('amazon_api_associate_tag', ''),
                    'host' => 'webservices.amazon.' . \Settings::get('amazon_api_country', 'com'),
                    'region' => \Settings::get('amazon_api_region', '')
                ];
                $associate_tag = \Settings::get('amazon_api_associate_tag', '');
            }

            \AmazonProduct::reconfig($config);

            Config::set('amazon-product.associate_tag', $associate_tag);
            $scan_pages = $import->max_result_pages ?? 1000;


            if ($import->categories->count() > 0) {

                foreach ($import->categories as $import_category) {

                    for ($i = 1; $i <= $scan_pages; $i++) {

                        $response = \AmazonProduct::search($import_category->name, $keywords, $i);
                        $this->parseResponse($response, $categories, $tags, $import, $brands);

                    }
                }
            } else {

                for ($i = 1; $i <= $scan_pages; $i++) {
                    $response = \AmazonProduct::search('All', $keywords, $i);
                    $this->parseResponse($response, $categories, $tags, $import, $brands);
                }
            }
            $this->info("Finishing Import: " . $import->title);

            $import->status = 'completed';
            $import->save();
        } catch (\Exception $exception) {
            $errors = [];

            if (!empty($errors)) {
                $error = implode("\n", $errors);
            } else {
                $error = $exception->getMessage();
            }
            dd($exception);

            $this->error("Error while importing : " . $error);
            $import->notes = $exception->getMessage();
            //$import->status = 'failed';
            $import->save();
            log_exception($exception, Import::class, 'import');

        }

    }

    function parseResponse($response, $categories, $tags, $import, $brands)
    {

        foreach ($response['SearchResult']['Items'] as $item) {
            $title = $item['ItemInfo']['Title']['DisplayValue'];

            if (isset($item['ItemInfo']['ByLineInfo']) && isset($item['ItemInfo']['ByLineInfo']['Brand'])) {
                $brand = $item['ItemInfo']['ByLineInfo']['Brand']['DisplayValue'];;

            } else {
                $brand = "";
            }
            $asin = $item['ASIN'];

            $features = [];
            if (isset($item['ItemInfo']['Features'])) {
                foreach ($item['ItemInfo']['Features']['DisplayValues'] as $key => $feature) {
                    array_push($features, $feature);
                }
            }
            if (isset($item['Offers'])) {
                $price = $item['Offers']['Listings'][0]['Price']['Amount'];
            } else {
                $price = 0.0;
            }
            $max_images = $import->image_count ? $import->image_count : 1000;
            $image_urls = $this->getItemImages($item, $max_images);
            $amazonUrl = $item['DetailPageURL'];
            $product = [
                'title' => $title,
                'asin' => $asin,
                'features' => $features,
                'price' => $price,
                'amazon_url' => $amazonUrl,
                'image_urls' => $image_urls,
                'brand' => $brand
            ];
            if ($import->store_id) {
                $product['store_id'] = $import->store_id;
            }


            $sku_exists = \ImportSKU::where('code', $product['asin'])->first();
            if ($sku_exists) {
                $import_product = $sku_exists->product;
            } else {
                $import_product = new \ImportProduct();
            }

            if ($product['brand']) {
                list($brand_id, $brands) = $this->createMissingBrand($product['brand'], $brands);

            }

            $import_product->name = $product['title'];
            $import_product->type = 'simple';
            $import_product->description = '<br>' . implode(', ', $product['features']);
            $import_product->name = $product['title'];
            $import_product->status = 'active';

            $import_product->save();


            $import_product->brand_id = $brand_id;
            $import_product->external_url = $product['amazon_url'];
            $import_product->save();

            $import_product->clearMediaCollection('ecommerce-product-gallery');

            $sku_data = ['regular_price' => $product['price'], 'code' => $product['asin'], 'inventory' => 'infinite'];

            \ImportSKU::where('code', $product['asin'])->delete();
            $sku = $import_product->sku()->create($sku_data);

            $first = true;
            $sku_image_url = "";
            foreach ($product['image_urls'] as $image_url) {
                if ($first) {
                    $import_product->addMediaFromUrl($image_url)->withCustomProperties(['root' => 'amazon_media_import', 'featured' => true])->toMediaCollection('ecommerce-product-gallery');
                    $sku_image_url = $image_url;
                } else {
                    $import_product->addMediaFromUrl($image_url)->withCustomProperties(['root' => 'amazon_media_import'])->toMediaCollection('ecommerce-product-gallery');

                }
                $first = false;

            }
            if ($sku_image_url) {
                //$import_product->copyFirstMediatoSKU($sku);
                $sku->addMediaFromUrl($sku_image_url)->withCustomProperties(['root' => 'amazon_media_import'])->toMediaCollection('ecommerce-sku-image');
            }


            $import->products()->sync($import_product, false);

            $item_categories = $this->getItemCategories($item);
            if ($item_categories) {
                list($categories, $product_categories) = $this->createMissingCategories($categories, [array_pop($item_categories)]);
                $import_product->categories()->sync($product_categories, []);
            }


        }
        return [$categories, $brands, $tags];
    }

    function getItemImages($item, $image_count)
    {
        $imageUrls = [];
        if ($item['Images']['Primary']) {
            $imageUrls[] = $item['Images']['Primary']['Large']['URL'];
            if (count($imageUrls) >= $image_count) {
                return $imageUrls;
            }

        }
        if (isset($item['Images']['Variants'])) {
            foreach ($item['Images']['Variants'] as $image) {
                $imageUrls[] = $image['Large']['URL'];
                if (count($imageUrls) >= $image_count) {
                    return $imageUrls;
                }
            }
        }
        return $imageUrls;
    }


    function createMissingCategories($categories, $item_categories)
    {
        $product_categories = [];
        foreach ($item_categories as $item_category) {
            if (!array_key_exists($item_category['id'], $categories) && !in_array($item_category['name'], $categories)) {
                $category = new \ImportCategory();
                $category->external_id = $item_category['id'];
                $category->name = $item_category['name'];
                $category->is_featured = false;
                $category->slug = \Str::slug($item_category['name']);
                $category->save();
                $categories[$item_category['id']] = $category->id;
                $product_categories[] = $category->id;
            } else {
                if (array_key_exists($item_category['id'], $categories)) {
                    $product_categories[] = $categories[$item_category['id']];
                } else {
                    $product_categories[] = array_search($item_category['name'], $categories);

                }

            }
        }

        return [$categories, $product_categories];
    }


    function createMissingBrand($brand_name, $brands)
    {

        if (!array_key_exists($brand_name, $brands)) {
            $brand = new \ImportBrand();
            $brand->name = $brand_name;
            $brand->slug = \Str::slug($brand_name);
            $brand->save();
            $brands[$brand_name] = $brand->id;
            return [$brand->id, $brands];
        } else {
            return [$brands[$brand_name], $brands];

        }


    }


    function getItemCategories($item)
    {
        $categories = [];
        if ($item['BrowseNodeInfo']) {
            foreach ($item['BrowseNodeInfo']['BrowseNodes'] as $node) {

                $categories[] = ['name' => $node['Ancestor']['Ancestor']['DisplayName'], 'id' => $node['Ancestor']['Ancestor']['Id']];

            };


        }

        return $categories;
    }


}
