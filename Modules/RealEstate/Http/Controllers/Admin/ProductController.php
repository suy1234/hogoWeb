<?php

namespace Modules\Product\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Product\Entities\Product;
use Modules\Product\Http\Requests\SaveProductRequest;
use File;
use Modules\Core\Entities\Setting;
use Modules\Core\Entities\Category;
use Modules\Core\Entities\Groups;
use Modules\Core\Entities\GroupTypes;
use Modules\Product\Entities\Brand;

class ProductController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'product::products.product';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'product::admin.products';
    protected $routePrefix = 'admin.products';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveProductRequest::class;

    public function getResourceData()
    {
        return [
            'categorys' => Category::where('type', 'product')->whereNull('parent_id')->with('children')->get(['id', 'title', 'group_ids']),
            'groups' => Groups::where('type', 'product')->get(['id', 'title']),
            'brands' => Brand::get(['id', 'title']),
        ];
    }

    public function store(){
        dd(request()->all());
    }
}
