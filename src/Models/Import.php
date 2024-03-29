<?php

namespace Corals\Modules\Amazon\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Import extends BaseModel
{
    use PresentableTrait;
    use LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'amazon.models.import';

    protected $table = 'amazon_imports';

    protected $guarded = ['id'];

    protected $casts = ['keywords' => 'array'];

    public function categories()
    {
        return $this->belongsToMany(AmazonCategory::class, 'amazon_category_import');
    }

    public function products()
    {
        return $this->belongsToMany(\ImportProduct::class, 'amazon_import_product');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
