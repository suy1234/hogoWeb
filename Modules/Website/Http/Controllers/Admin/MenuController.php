<?php

namespace Modules\Website\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Website\Entities\Menu;
use Modules\Website\Http\Requests\SaveMenuRequest;
use Modules\Core\Entities\Setting;
use Modules\Core\Entities\Category;
use Modules\Core\Entities\Groups;
use Modules\Core\Entities\GroupTypes;
use Modules\Website\Entities\Page;
// use Modules\Website\Entities\Post;

class MenuController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'website::menus.menu';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'website::admin.menu';
    protected $routePrefix = 'admin.menus';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveMenuRequest::class;

    public function index(Request $request)
    {
        $menus = $this->getModel()->where('parent_id', 0)->whereNull('menu_id')->pluck('title', 'id');
        $setting = Setting::where('type', 'package')->first(['config']);
        $category_menus = [
            'page' => trans('website::menus.package.page')
        ];

        if(in_array('Website', $setting->config)){
            $category_menus['category_post'] = trans('website::menus.package.category_post');
            $category_menus['group_post'] = trans('website::menus.package.group_post');
        }
        if(in_array('Bank', $setting->config)){
            $category_menus['category_bank'] = trans('website::menus.package.category_bank');
            $category_menus['group_bank'] = trans('website::menus.package.group_bank');
        }
        if(in_array('Product', $setting->config)){
            $category_menus['category_product'] = trans('website::menus.package.category_product');
            $category_menus['group_product'] = trans('website::menus.package.group_product');
        }
        return view("{$this->viewPath}.index", ['menus' => $menus, 'category_menus' => $category_menus]);
    }

    public function getDataPackage(Request $request)
    {  
        $packages = [];
        switch ($request->tab) {
            case 'category_post':
                $packages = Category::where('type', 'post')->get(['title', 'id', 'alias']);
                break;
            case 'group_post':
                $packages = Groups::where('type', 'post')->get(['title', 'id', 'alias']);
                break;
            case 'category_product':
                $packages = Category::where('type', 'product')->get(['title', 'id', 'alias']);
                break;
            case 'group_product':
                $packages = Groups::where('type', 'product')->get(['title', 'id', 'alias']);
                break;

            case 'category_bank':
                $packages = Category::where('type', 'bank')->get(['title', 'id', 'alias']);
                break;
            case 'group_bank':
                $packages = Groups::where('type', 'bank')->get(['title', 'id', 'alias']);
                break;
            
            default:
                $packages = Page::get(['title', 'id', 'alias']);
                break;
        }
        return response()->json(['success' => true, 'data' => $packages]);
    }

    public function storeMenu(Request $request){
        $data = $request->list;
        foreach ($data as $key => $value) {
            $menu = Menu::find($value['id']);
            $menu->parent_id = 0;
            $menu->order = $key;
            $menu->save();
            if(!empty($value['children'])){
                if(!empty($value['children'])){
                    $this->storeMenuChildren($value['children'], $value['id']);
                }
            }
        }
        return response()->json(['success' => true, 'resource' => trans('validation.attributes.update_success')]); 
    }

    public function storeMenuChildren($data, $parent_id)
    {
        foreach ($data as $key => $value) {
            $menu = Menu::find($value['id']);
            $menu->parent_id = $parent_id;
            $menu->order = $key;
            $menu->save();
            if(!empty($value['children'])){
                $this->storeMenuChildren($value['children'], $value['id']);
            }
        }
    }

    public function updateMenu(Request $request){
        $data = $request->data;
        if(!empty($data['id'])){
            $result = Menu::where('id', $data['id'])->update(['title' => $data['title'], 'icon' => $data['icon'], 'url' => $data['url']]);
            if($result){
                return response()->json(['success' => true, 'resource' => trans('validation.attributes.update_success')]); 
            }
        }
        return response()->json(['success' => false, 'resource' => trans('validation.attributes.error')]); 
    }

    public function delete(Request $request)
    {
        return response()->json(['success' => Menu::find($request->id)->delete()]); 
    }

    public function get(Request $request)
    {
        return response()->json(['success' => true, 'data' => Menu::find($request->id)]); 
    }

    public function getList(Request $request)
    {
        return response()->json(['success' => true, 'data' => $this->getModel()->where('menu_id', $request->menu_id)->where('parent_id', 0)->orderBy('order')->get()]);
    }
}
