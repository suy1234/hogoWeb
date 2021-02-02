<?php

namespace Modules\Website\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Core\Entities\Category;
use Modules\Core\Entities\Groups;
use Modules\Core\Entities\GroupTypes;
use Modules\Website\Entities\Post;
use Modules\Website\Http\Requests\SavePostRequest;
class PostController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'website::posts.post';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'website::admin.posts';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SavePostRequest::class;

    public function getResourceData()
    {
        return [
            'categorys' => Category::where('type', 'post')->whereNull('parent_id')->with('children')->get(['id', 'title', 'group_ids'])
        ];
    }

    public function destroy(Request $request)
    {
        $ids = !empty($request->ids) ? explode(',', $request->ids) : [];
        \DB::beginTransaction();
        $result = $this->getModel()
        ->withoutGlobalScope('active')
        ->whereIn('id', $ids)
        ->delete();
        Seo::whereIn('taxonomy_id', $ids)->where('type', $this->getModel()->getTable())->delete();
        postAnswer::whereIn('post_id', $ids)->delete();
        \DB::commit();
        return response()->json([
            'success' => $result
        ]);
    }
}
