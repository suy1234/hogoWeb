<?php

namespace Modules\Product\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Product\Entities\Unit;
use Modules\Product\Http\Requests\SaveUnitRequest;
class UnitController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Unit::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'product::units.unit';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'product::admin.units';
    protected $routePrefix = 'admin.units';
    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveUnitRequest::class;

    public function store()
    {
        $this->disableSearchSyncing();
        \DB::beginTransaction();
        $data = $this->getRequest('store')->all();
        $entity = $this->getModel()->updateOrCreate(
            [
                'id' => @$data['id']
            ], $data
        );
        \DB::commit();
        $this->searchable($entity);

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity);
        }
        return response()->json(['success' => true, 'resource' => $this->getLabel().' '.trans('validation.attributes.create_success')]);
    }
}
