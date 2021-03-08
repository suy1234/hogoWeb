<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Modules\Website\Entities\Page;
use Modules\Website\Entities\Layout;

class IndexController extends WebsiteController
{
    public function index(Request $request)
    {
    	$page = Page::where('page_default' ,1)->first();
        $seo = $page->getSeo();
        $layouts = $page->layouts()->with('widgets')->get()->toArray();
        \View::share('class_page', 'home');
        return view('themes.default.index', compact('seo', 'page', 'layouts'));
    }

    public function default(Request $request)
    {
        $layouts = Layout::get();
         \View::share('class_page', 'page');
        return view('themes.default.default', compact( 'layouts'));
    }
}
