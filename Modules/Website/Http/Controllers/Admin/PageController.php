<?php

namespace Modules\Website\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Website\Entities\Page;
use Modules\Website\Entities\Layout;
use Modules\Website\Http\Requests\SavePageRequest;
use Modules\Widget\Entities\WidgetTheme;
use Modules\Website\Services\Theme;

class PageController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'website::pages.page';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'website::admin.pages';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SavePageRequest::class;

    public function editor($id)
    {
        $entity = $this->getEntity($id);
        if (request()->wantsJson()) {
            return $entity;
        }
        return view("{$this->viewPath}.editor")->with($this->getResourceName(), $entity);
    }

    public function design($id)
    {
        $page = $this->getEntity($id);
        return view("{$this->viewPath}.design", compact('page'));
    }

    public function layoutSave(Request $request)
    {
        foreach (config('widgets.website.rows.'.$request->widget) as $key => $row) {
            Layout::create([
                'page_id' => $request->id,
                'class' => $row,
                'widget' => $request->widget
            ]);
        }
        return response()->json(['success' => true]);
    }

    public function listLayouts(Request $request)
    {
        return response()->json(['success' => true, 'data' => Layout::where('page_id', $request->id)->get()]);
    }

    public function build(Request $request)
    {
        $layout_ids = Layout::whereNotNull('widget_id')->get()->pluck('widget_id')->toArray();
        if(count($layout_ids)){
            $api = config('erp.api.layout');
            if(env('APP_ENV') != 'local')
            {
                $http = new \GuzzleHttp\Client;
                $response = $http->post($api['url'], [
                    'form_params' => ['ids' => $layout_ids],
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => $api['key'],
                    ],
                ]);

                $widget_themes = json_decode((string) $response->getBody(), true);
            }else{
                $widget_themes = [
                    'data' => WidgetTheme::whereIn('id', $layout_ids)->get()->toArray()
                ];
            }
            if(!empty($widget_themes['data'])){
                $css = str_replace(["\t", "\n"], '', implode('', array_column($widget_themes['data'], 'css')));
                if(!empty($css)){
                    Theme::buildTheme($css, 'css', 'style.css');
                }
                
                $js = str_replace(["\t", "\n"], '', implode('', array_column($widget_themes['data'], 'js')));
                if(!empty($js)){
                    Theme::buildTheme($js, 'js', 'script.js');
                }
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false]);
    }
    public function layoutDefault($id)
    {
        Page::where('page_default', 1)->update(['page_default' => 0]);
        return response()->json(['success' => Page::where('id', $id)->update(['page_default' => 1])]);
    }
}
