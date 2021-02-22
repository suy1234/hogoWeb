<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Question\Entities\Question;
use DB;
class QuestionController extends Controller
{
    public function checkExam(Request $request)
    {
        $data = $request->all();
        $answers = !empty($request->answers) ? $request->answers : [];
        $max_question_true = !empty($request->max_question_true) ? (int) $request->max_question_true : 28;
        $questions = Question::with(['answers' => function($query){
            return $query->where('is_answer', 1);
        }])
        ->where('group_type_id', $request->exam_id)
        ->select('id', 'title', 'content','group_type_id')
        ->get()->keyBy('id');

        $dataSendView = [];
        $total_question_true = 0;
        foreach ($questions as $id => $question) {
            $has_check = false;
            $question->answers = $question->answers->keyBy('id')->toArray();
            if(!empty($answers[$id])){
                if(count($question->answers) == count($answers[$id])){
                    foreach ($answers[$id] as $id_answer => $answer) {
                        if(!empty($question->answers[$id_answer])){
                            $has_check = true;
                            $total_question_true += 1;
                        }else{
                            $has_check = false;
                            break;
                        }
                    }   
                }
            }
            $dataSendView[$id] = [
                'has_check' => $has_check,
                'answers' => array_keys($question->answers)
            ];
        }

        return response()->json([
            'success' => ($max_question_true <= $total_question_true) ? true : false, 
            'data' => $dataSendView, 
            'total_question' => $questions->count(),
            'note' => ($max_question_true <= $total_question_true) ? 'ĐẠT' : 'KHÔNG ĐẠT',
            'total_question_true' => $total_question_true,
            'max_question_true' => $max_question_true
        ]);
    }

}
