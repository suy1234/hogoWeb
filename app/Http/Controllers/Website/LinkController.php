<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Modules\Website\Entities\Page;
use Modules\Core\Entities\Seo;
use Modules\Website\Entities\Widget;
use Modules\Website\Entities\Layout;

class LinkController extends WebsiteController
{
    public function index(Request $request, $link)
    {
        $default = $this->default;
        $seo = Seo::where('alias', $link)->first();

        if(empty($seo)){
            $page = Page::where('type', '404')->first();
            $seo = $page->getSeo();
            return view('themes.default.404', compact('seo', 'page', 'default'));   
        }
        $layouts = Layout::with('widgets');
        switch ($seo->type) {
            case 'posts':
                    $post = \Modules\Website\Entities\Post::find($seo->taxonomy_id);
                    $layouts = collect($layouts->where('type', 'post')->first())['widgets'];
                    $post->view_count += 1;
                    $post->save();
                    return view('themes.default.post', compact('seo', 'post', 'default', 'layouts'));

                break;

            case 'categorys':
                    $category = \Modules\Core\Entities\Category::find($seo->taxonomy_id);
                    if($category->type == 'product'){
                        return view('themes.default.category_product', compact('seo', 'products', 'category', 'default'));
                    }

                    $posts = \Modules\Website\Entities\Post::where('category_id', $category->id)->paginate(20);
                    return view('themes.default.category_post', compact('seo', 'posts', 'category', 'default'));

                break;

            case 'pages':
                    $data = \Modules\Website\Entities\Page::find($seo->taxonomy_id);
                    if(count($data->layouts)){
                        $layouts = $data->layouts;
                        return view('themes.default.widget', compact('seo', 'data', 'default', 'layouts'));
                    }
                    return view('themes.default.page', compact('seo', 'page', 'default'));

                break;
            
            default:
                    $page = Page::where('type', '404')->first();
                    $seo = $page->getSeo();
                    return view('themes.default.404', compact('seo', 'page', 'default'));
                break;
        }
        return view('themes.default.index', compact('seo', 'page', 'themes', 'default', 'header_active'));
    }

    public function edit(Request $request)
    {
        return view('themes.edit');
    }
}
