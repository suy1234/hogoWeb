<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use Modules\Website\Entities\PageTheme;
use Modules\Website\Entities\Layout;
use Modules\Website\Entities\Menu;
use Modules\Core\Entities\Groups;
use Modules\Core\Entities\Setting;

class WebsiteController extends Controller
{
    protected $default;
    public function __construct()
    {
        $config = Setting::where('type', 'activation_date')->first();
        $folder = $config->config['folder'].'/3';
        \View::share('layout_default', Layout::with('widgets')->whereNotNull('type')->get()->keyBy('type')->toArray());
        \View::share('path', compact('folder'));
    }
}
