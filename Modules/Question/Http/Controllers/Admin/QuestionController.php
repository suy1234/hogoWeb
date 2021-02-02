<?php

namespace Modules\Question\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Core\Entities\Category;
use Modules\Core\Entities\Groups;
use Modules\Core\Entities\GroupTypes;
use Modules\Question\Entities\Question;
use Modules\Question\Entities\QuestionAnswer;
use Modules\Question\Http\Requests\SaveQuestionRequest;
class QuestionController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'question::questions.question';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'question::admin.questions';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveQuestionRequest::class;

    public function getResourceData()
    {
        return [
            'categorys' => Category::where('type', 'question')->whereNull('parent_id')->with('children')->get(['id', 'title', 'group_ids']),
            'category_childrens' => Category::where('type', 'question')->whereNotNull('parent_id')->get(['id', 'group_ids'])->pluck('group_ids', 'id'),
            'groups' => Groups::where('type', 'question')->get()->pluck('title', 'id'),
            'group_types' => GroupTypes::where('type', 'question')->get()->pluck('title', 'id'),
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
        QuestionAnswer::whereIn('question_id', $ids)->delete();
        \DB::commit();
        return response()->json([
            'success' => $result
        ]);
    }
}
