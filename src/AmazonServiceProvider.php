<?php

namespace Corals\Modules\Amazon;

use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\api\DefaultApi;
use Amazon\ProductAdvertisingAPI\v1\Configuration;
use Corals\Foundation\Providers\BasePackageServiceProvider;
use Corals\Modules\Amazon\Console\Commands\RunImports;
use Corals\Modules\Amazon\Facades\Amazon;
use Corals\Modules\Amazon\Models\Import as Import;
use Corals\Modules\Amazon\Providers\AmazonAuthServiceProvider;
use Corals\Modules\Amazon\Providers\AmazonObserverServiceProvider;
use Corals\Modules\Amazon\Providers\AmazonRouteServiceProvider;
use Corals\Settings\Facades\Modules;
use Corals\Settings\Facades\Settings;
use GuzzleHttp\Client;
use Illuminate\Foundation\AliasLoader;

class AmazonServiceProvider extends BasePackageServiceProvider
{
    protected $defer = true;
    /**
     * @var
     */
    protected $packageCode = 'corals-amazon';

    /**
     * Bootstrap the application events.
     *
     * @return void
     */

    public function bootPackage()
    {
        // Load view
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'Amazon');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'Amazon');

        // Load migrations
//        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->registerCustomFieldsModels();
        $this->registerCommand();


        \AmazonProduct::macro('reconfig', function (array $config) {
            $client = new Client();

            $conf = (new Configuration)
                ->setAccessKey($config['api_key'])
                ->setSecretKey($config['api_secret_key'])
                ->setRegion($config['region'])
                ->setHost($config['host']);

            $api = new DefaultApi($client, $conf);
            $this->config($api);

            return $this;
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function registerPackage()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/amazon.php', 'amazon');

        $this->app->register(AmazonRouteServiceProvider::class);
        $this->app->register(AmazonAuthServiceProvider::class);
        $this->app->register(AmazonObserverServiceProvider::class);

        $this->app->booted(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Amazon', Amazon::class);
            if (\Modules::isModuleActive('corals-marketplace')) {

                $namespace = "Marketplace";
            } else {
                $namespace = "Ecommerce";

            }
            $loader->alias('ImportBrand', 'Corals\\Modules\\' . $namespace . '\\Models\\Brand');
            $loader->alias('ImportCategory', 'Corals\\Modules\\' . $namespace . '\\Models\\Category');
            $loader->alias('ImportProduct', 'Corals\\Modules\\' . $namespace . '\\Models\\Product');
            $loader->alias('ImportSKU', 'Corals\\Modules\\' . $namespace . '\\Models\\SKU');
            $loader->alias('ImportTag', 'Corals\\Modules\\' . $namespace . '\\Models\\Tag');

        });

    }

    protected function registerCustomFieldsModels()
    {
        Settings::addCustomFieldModel(Import::class);
    }

    protected function registerCommand()
    {
        $this->commands(RunImports::class);
    }

    public function registerModulesPackages()
    {
        Modules::addModulesPackages('corals/amazon');
    }
}
