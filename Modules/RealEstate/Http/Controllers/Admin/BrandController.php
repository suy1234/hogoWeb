<?php

namespace Modules\Product\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Product\Entities\Brand;
use Modules\Product\Http\Requests\SaveBrandRequest;
class BrandController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'product::brands.brand';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'product::admin.brands';
    protected $routePrefix = 'admin.brands';
    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveBrandRequest::class;
}
