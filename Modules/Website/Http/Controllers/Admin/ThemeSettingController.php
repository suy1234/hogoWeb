<?php

namespace Modules\Website\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Website\Http\Requests\SaveThemeRequest;
use Modules\Website\Entities\Theme as EntityTheme;
use Modules\Website\Services\Theme;

class ThemeSettingController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = EntityTheme::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'website::themes.theme';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'website::admin.themes';
    protected $routePrefix = 'admin.themes';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveThemeRequest::class;

    public function status(Request $request)
    {
        $ids = !empty($request->ids) ? explode(',', $request->ids) : [];
        $this->getModel()->withoutGlobalScope('active')
        ->whereNotIn('id', $ids)
        ->update(['status' => -1]);

        $result = $this->getModel()
        ->withoutGlobalScope('active')
        ->whereIn('id', $ids)
        ->update(['status' => 1]);
        $this->setContentConfig();
        return response()->json([
            'success' => $result
        ]);
    }

    public function update($id)
    {
        $entity = $this->getEntity($id);
        \DB::beginTransaction();
        $this->disableSearchSyncing();
        $entity->update(
            $this->getRequest('update')->all()
        );
        
        if($entity->status == 1){
            $this->setContentConfig();    
        }
        
        \DB::commit();
        $this->searchable($entity);

        if (method_exists($this, 'redirectTo')) {
            return response()->json(['success' => true, 'resource' => $this->getLabel().' '.trans('validation.attributes.update_success')]);
        }

        return response()->json(['success' => true, 'resource' => $this->getLabel().' '.trans('validation.attributes.update_success')]);
    }

    public function setContentConfig()
    {
        $data = $this->getModel()->withoutGlobalScope('active')->where('status', 1)->select('config')->first()->config;
        $font = strtolower($data['font']);
        $css = "
        :root {
            --blue:#3490dc;
            --font-family:'".$data['font']."',sans-serif;
        }
        body {
            margin:0;
            font-family: ".$data['font'].",sans-serif;
            font-size: ".$data['size']."px;
            font-weight:400;
            line-height:1.6;
            color: ".$data['color_website']['text_color'].";
            ".(!empty($data['color_website']['color']) ? "background-color: ".$data['color_website']['color'].";" : '')."
            ".(!empty($data['color_website']['background']) ? "background: url(".$data['color_website']['background'].") no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;" : '')."
        }
        a,a *{
            color: ".$data['color_website']['link_color'].";
        }
        a:hover,a *:hover{
            color: ".$data['color_website']['link_hover_color'].";
        }
        .price{
            color: ".$data['color_website']['price_color'].";
        }
        .price-sale{
            color: ".$data['color_website']['price_sale_color'].";
        }
        @font-face {
          font-family:'Roboto';
          font-style: normal;
          font-weight: 100;
          src: local('roboto thin'), 
          local('roboto thin'), 
          url(/public/fonts/".$font."-thin.ttf) format('truetype')
      }
      @font-face {
          font-family:'Roboto';
          font-style: italic;
          font-weight: 100;
          src: local('roboto thin italic'), 
          local('roboto thin italic'), 
          url(/public/fonts/".$font."-thinitalic.ttf) format('truetype')
      }
      @font-face {
          font-family:'Roboto';
          font-style: normal;
          font-weight: 300;
          src: local('roboto light'), 
          local('roboto light'), 
          url(/public/fonts/".$font."-light.ttf) format('truetype')
      }
      @font-face {
          font-family:'Roboto';
          font-style: italic;
          font-weight: 300;
          src: local('roboto light italic'), 
          local('roboto light italic'), 
          url(/public/fonts/".$font."-thinitalic.ttf) format('truetype')
      }
      @font-face {
          font-family:'Roboto';
          font-style: normal;
          font-weight: 400;
          src: local('roboto regular'), 
          local('roboto regular'), 
          url(/public/fonts/".$font."-regular.ttf) format('truetype')
      }
      @font-face {
          font-family:'Roboto';
          font-style: italic;
          font-weight: 400;
          src: local('roboto italic'), 
          local('roboto italic'), 
          url(/public/fonts/".$font."-italic.ttf) format('truetype')
      }
      @font-face {
          font-family:'Roboto';
          font-style: normal;
          font-weight: 500;
          src: local('roboto'), 
          local('roboto'), 
          url(/public/fonts/".$font.".ttf) format('truetype')
      }
      @font-face {
          font-family:'Roboto';
          font-style: italic;
          font-weight: 500;
          src: local('roboto medium italic'), 
          local('roboto medium italic'), 
          url(/public/fonts/".$font."-mediumitalic.ttf) format('truetype')
      }
      @font-face {
          font-family:'Roboto';
          font-style: normal;
          font-weight: 700;
          src: local('roboto bold'), 
          local('roboto bold'), 
          url(/public/fonts/".$font."-bold.ttf) format('truetype')
      }
      @font-face {
          font-family:'Roboto';
          font-style: italic;
          font-weight: 700;
          src: local('roboto bold italic'), 
          local('roboto bold italic'), 
          url(/public/fonts/".$font."-bolditalic.ttf) format('truetype')
      }
      /*theme Build*/
      ";
      $content = str_replace(["\t", "\n", " "], '',$css); 
      return Theme::buildTheme($content, 'css', 'default.css');
  }
}
