<?php

namespace Modules\Website\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Website\Entities\Layout;
use Modules\Website\Http\Requests\SaveLayoutRequest;
class LayoutController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Layout::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'website::layouts.layout';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'website::admin.layouts';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveLayoutRequest::class;

    public function edit($id)
    {
        $data = array_merge([
            $this->getResourceName() => $this->getEntity($id),
            'rows' => Layout::find($id)
        ], $this->getFormData('edit', $id), $this->getResourceData(), $this->getConfig());

        return view("{$this->viewPath}.edit", $data);
    }

    public function saveWidget(Request $request)
    {
        foreach (config('widgets.website.rows.'.$request->widget) as $key => $row) {
            Layout::create([
                'parent_id' => $request->parent_id,
                'class' => $row,
                'widget' => $request->widget
            ]);
        }
        return response()->json(['success' => true]);
    }

    public function design($id, Request $request)
    {
        $layout = Layout::find($id);
        $layouts = Layout::where('parent_id', $id)->get();
        $config = config('widgets.website.'.$layout->type);
        return view("{$this->viewPath}.design", compact('layouts', 'layout', 'config'));
    }

    public function listLayouts(Request $request)
    {
        return response()->json(['success' => true, 'data' => Layout::where('parent_id', $request->id)->get()]);
    }
}
