<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Core\Entities\Category;
use Modules\Core\Http\Requests\SaveCategoryRequest;
class CategoryController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'core::categorys';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'core::admin.categorys';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveCategoryRequest::class;

    public function getResourceData()
    {
        return [
            'categorys' => Category::where('type', request()->code)->select('title', 'id')->get()
        ];
    }

    public function store()
    {
        $this->disableSearchSyncing();
        \DB::beginTransaction();
        $entity = $this->getModel()->create(
            $this->getRequest('store')->all()
        );
        \DB::commit();
        $this->searchable($entity);

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity);
        }
        return response()->json([
            'success' => true, 
            'resource' => trans('core::functions.'.request()->code).' '.trans('validation.attributes.create_success'), 
            'url' => route("{$this->getRoutePrefix()}.edit", ['id' => $entity->id, 'code' => request()->code])
        ]);
    }

    public function edit($code, $id)
    {
        $data = array_merge([
            $this->getResourceName() => $this->getEntity($id),
        ], $this->getFormData('edit', $id), $this->getResourceData(), $this->getConfig());
        return view("{$this->viewPath}.edit", $data);
    }

    public function update($code, $id)
    {
        $entity = $this->getEntity($id);
        \DB::beginTransaction();
        $this->disableSearchSyncing();
        $entity->update(
            $this->getRequest('update')->all()
        );
        \DB::commit();
        $this->searchable($entity);
        if (method_exists($this, 'redirectTo')) {
            return response()->json(['success' => true, 'resource' => trans('core::functions.'.$code).' '.trans('validation.attributes.update_success'), 'url' => route("{$this->getRoutePrefix()}.edit", ['id' => $entity->id, 'code' => request()->code])]);
        }

        return response()->json(['success' => true, 'resource' => trans('core::functions.'.$code).' '.trans('validation.attributes.update_success'), 'url' => route("{$this->getRoutePrefix()}.edit", ['id' => $entity->id, 'code' => request()->code])]);
    }
}
