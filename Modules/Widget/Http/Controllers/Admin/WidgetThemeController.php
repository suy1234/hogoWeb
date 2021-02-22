<?php

namespace Modules\Widget\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Widget\Entities\WidgetTheme;
use Modules\Widget\Http\Requests\SaveWidgetThemeRequest;
use Illuminate\Support\Facades\File;
use Storage;

class WidgetThemeController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = WidgetTheme::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'widget::widget_themes.widget_theme';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'widget::admin.widget_themes';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveWidgetThemeRequest::class;


    public function store()
    {
        $this->disableSearchSyncing();
        \DB::beginTransaction();
            $input = $this->getRequest('store')->all();
            $entity = $this->getModel()->create($input);
            $this->createFolder('themes', $entity);
        \DB::commit();
        $this->searchable($entity);

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity);
        }
        return response()->json(['success' => true, 'resource' => $this->getLabel().' '.trans('validation.attributes.create_success'), 'url' => route("{$this->getRoutePrefix()}.index")]);
    }

    public function update($id)
    {
        $entity = $this->getEntity($id);
        \DB::beginTransaction();
            $this->disableSearchSyncing();
            $input = $this->getRequest('update')->all();
            $entity->update($input);
            $this->createFolder('themes', $entity);
        \DB::commit();
        $this->searchable($entity);

        if (method_exists($this, 'redirectTo')) {
            return response()->json(['success' => true, 'resource' => $this->getLabel().' '.trans('validation.attributes.update_success')]);
        }

        return response()->json(['success' => true, 'resource' => $this->getLabel().' '.trans('validation.attributes.update_success')]);
    }

    public function createFolder($folder, $entity)
    {
        $dir = resource_path('views/widgets/'.$folder.'/'.$entity->id);
        if( is_dir($dir) === false )
        {
            mkdir($dir, 0777, true);
        }
        
        file_put_contents($dir.'/index.blade.php', $entity->html);
        return file_put_contents($dir.'/config.php', $entity->config);
    }
}
