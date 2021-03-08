<?php

namespace Modules\Product\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Product\Entities\Attribute;
use Modules\Product\Http\Requests\SaveAttributeRequest;
class AttributeController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Attribute::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'product::attributes.attribute';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'product::admin.attributes';
    protected $routePrefix = 'admin.attributes';
    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveAttributeRequest::class;

    public function index(){
        $attributes = Attribute::with('children')->whereNull('parent_id')->where('taxonomy', 'product')->get();
        return view("{$this->viewPath}.index", compact('attributes'));
    }

    public function store()
    {
        $this->disableSearchSyncing();
        \DB::beginTransaction();
        $data = $this->getRequest('store')->all();
        $entity = $this->getModel()->updateOrCreate(
            [
                'id' => @$data['id']
            ], $data
        )->toArray();

        \DB::commit();
        $this->searchable($entity);

        return response()->json([
            'success' => true,
            'resource' => $this->getLabel().' '.trans('validation.attributes.create_success'),
            'data' => $entity
        ]);
    }

    public function destroy()
    {
        \DB::beginTransaction();
            $data = $this->getModel()->withoutGlobalScope('active')->find(request()->id);
            $data->children()->delete();
            $data->delete();
        \DB::commit();
        return response()->json([
            'success' => $data
        ]);
    }
}
