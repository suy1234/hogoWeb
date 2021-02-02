<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Question\Entities\Question;
use Modules\Question\Entities\QuestionAnswer;
use Modules\Core\Entities\Category;
use Modules\Core\Entities\Groups;
use Modules\Core\Entities\GroupTypes;
use Modules\Core\Entities\Untis;
class ExamController extends Controller
{
    public function getGroup()
    {
        $data = [
        	'group_types' => GroupTypes::where('type', 'question')->select('id', 'type', 'title', 'description', 'img')->get(),
            'groups' => Groups::where('type', 'question')->select('id', 'type', 'title', 'description', 'img')->get(),
            'categorys' => Category::where('type', 'question')->select('id', 'type', 'title', 'parent_id', 'description', 'img', 'group_ids', 'group_type_ids')->get(),
        ];
       return response()->json(['success' => true, 'version' => 1.12,'data' => $data]);
    }

    public function getExam()
    {
    	$data = [
    		'questions' => Question::where('status', 1)->get(),
    		'question_answers' => QuestionAnswer::where('status', 1)->get(),
    	];
    	return response()->json(['success' => true, 'version' => 1.12,'data' => $data]);
    }
}
