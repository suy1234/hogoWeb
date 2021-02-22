<?php

namespace Modules\Website\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Website\Entities\PageTheme;
use Modules\Website\Entities\Widget;
use Modules\Website\Http\Requests\SaveThemeRequest;
use Modules\Website\Entities\Menu;
use Modules\Core\Entities\Groups;

class ThemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->lang = 'vi';
    }

    public function index(Request $request)
    {
        $themes = PageTheme::whereNotNull('type')->where('type', '!=', 'default')->where('page_id', 0)->get(['type']);
        $menus = Menu::where('parent_id', 0)->whereNull('menu_id')->pluck('title', 'id');
        $group_posts = Groups::where('type', 'post')->pluck('title', 'id');
        $group_products = Groups::where('type', 'product')->pluck('title', 'id');
        return view("website::admin.setting_themes.index", compact('themes', 'menus', 'group_posts', 'group_products'));
    }

    public function getTab(Request $request)
    {
        include(base_path('config.php'));
        $themes = $themes[$request->tab];
        $widget = Widget::with('children:parent_id,widget,config,sort')->where('type', $request->tab)->where('parent_id', 0)->first();
        if(!empty($widget) && count($widget->children)){
            $themes = [
                'default' => $widget->config,
                'widgets' => $widget->children
            ];
        }
        return response()->json(['success' => true, 'data' => $themes]);
    }
    public function update(Request $request)
    {
        $widget = Widget::updateOrCreate([
            'type' => $request->type
        ],[
            'type' => $request->type,
            'config' => $request->config,
        ]);
        $widget->update(['config' => $request->config]);
        $data = [];
        $config = json_decode($request->data, true);
        Widget::where('parent_id', $widget->id)->delete();
        foreach ($config as $value) {
            $data[] = [
                'parent_id' => $widget->id,
                'sort' => $value['sort'],
                'widget' => $value['widget'],
                'config' => json_encode($value['config']),
            ];
        }
        Widget::insert($data);
        if($widget){
            return response()->json(['success' => true, 'resource' => trans('validation.attributes.create_success')]);
        }
        return response()->json(['success' => false, 'resource' =>trans('validation.attributes.error')]);
    }
}
