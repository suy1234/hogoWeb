<?php

namespace Modules\Media\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Media\Entities\Media;
use Modules\Media\Http\Requests\SaveMediaRequest;
use File;
use Modules\Core\Entities\Setting;

class MediaController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'media::medias.media';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'media::admin';
    protected $routePrefix = 'admin.medias';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveMediaRequest::class;
    public function modal()
    {
        $data = $this->getResourceData();
        return view("{$this->viewPath}.list", $data);
    }
    public function store(Request $request)
    {
        $setting = Setting::where('type', 'activation_date')->first();
        $folder = 'kh/'.$setting->config['folder'].'/';
        if (!file_exists(public_path($folder))) {
            File::makeDirectory(public_path($folder), $mode = 0777, true, true);
        }

        $path = !empty($request->path) ? $request->path : 'uploads';
        $extension = explode('.', $request->name);
        $type = $extension[count($extension) - 1];
        $imageFileArray = explode(";", $request->file);
        $imageFileArray = explode(",", $imageFileArray[1]);
        $data = base64_decode($imageFileArray[1]);
        
        $path = $path.'/'.date('Y');
        if (!file_exists(public_path($folder.$path))) {
          File::makeDirectory(public_path($folder.$path), $mode = 0777, true, true);
        }
        $file = !empty($request->title) ? date('dmY').'-'.formatUrl($request->title).'.'.$type : date('dmYHis').$request->name;
        $imageName = $path.'/'.$file;
        file_put_contents(public_path($folder.$imageName), $data);

        $this->disableSearchSyncing();
        \DB::beginTransaction();
        $entity = $this->getModel()->create([
            'path' => '/public/'.$folder.$imageName,
            'title' => !empty($request->title) ? $request->title : null,
        ]);
        \DB::commit();
        $this->searchable($entity);

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity);
        }
         return response()->json(['success' => true, 'data' => $entity]);
    }
}
