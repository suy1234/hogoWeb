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
use Modules\Website\Entities\Theme;

class WebsiteController extends Controller
{
    protected $default;
    public function __construct()
    {
    	if(! \Schema::hasTable('themes')){
    		echo 'Website này chưa được xây dựng vui lòng liên hệ 0931 15 68 18 để biết thêm chi tiết';die();
    	}
        $theme = Theme::where('status', 1)->select('id')->first();
        if(empty($theme)){
        	echo 'Website đang trong quá trình xây dựng liên hệ 0931 15 68 18 để biết thêm chi tiết';die();
        }
        $this->default = [
            'theme' => $theme,
        ];
        $config = Setting::where('type', 'activation_date')->first();
        $folder = $config->config['folder'].'/'.$theme->id;
        \View::share('layout_default', Layout::with('widgets')->where('theme_id', $theme->id)->whereNotNull('type')->get()->keyBy('type')->toArray());
        \View::share('path', compact('folder'));
    }
}
