<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Product\Amin\ProductTable;
use Modules\Core\Entities\Category;

class Product extends AppModel
{
    protected $module = 'product';
    protected $fillable = array(
        'parent_id',
        'barcode',
        'sku',
        'title',
        'rating',
        'alias',
        'description',
        'content',
        'img',
        'gallerys',
        'category_id',
        'brand_id',
        'group_ids',
        'properties_id',
        'unit_id',
        'price',
        'price_sale',
        'price_percent',
        'price_sort',
        'price_customer_1',
        'price_customer_2',
        'price_customer_3',
        'price_customer_4',
        'price_customer_5',
        'price_customer_6',
        'price_from_date',
        'price_to_date',
        'by_pos',
        'by_website',
        'inventory_quantity',
        'warehouses_quantity_set',
        'warehouses_quantity_warning',
        'weight',
        'width',
        'length',
        'height',
        'order',
        'view_count',
        'status',
        'published_at',
        'created_by',
    );
    
    protected $casts = [
        'gallerys' => 'array',
        'group_ids' => 'array',
    ];
    
    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    protected static function boot() {
        parent::boot();

        static::creating(function (self $product) {
            $product->created_by = auth()->id();
        });
        static::addGlobalScope('active', function (Builder $product) {
            $product->where('status', 1);
        });

        static::saved(function (self $product) {
            $product->updateOrCreateSeo();
        });
    }

    
    public function table($request)
    {
        $query = $this->search($request);

        $query->select('parent_id', 'category_id', 'title', 'price', 'price_sale', 'sku', 'status');
        return new ProductTable($query);
    }

    public function search($request)
    {
        $query = $this->newQuery()->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->where('title', 'like', '%'.$keyword.'%');
        }
        return $query;
    }

    public function getMapData($param)
    {

    }
}
