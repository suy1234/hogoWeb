<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Question\Entities\Question;
use Modules\Question\Entities\QuestionAnswer;
class ApiController extends Controller
{
    public function convertURL(Request $request)
    {
        return formatUrl($request->text);
    }
    public function index()
    {
        $data = Question::select("id", "title", "img", "content", "category_id")->get();
        foreach ($data as $key => $value) {
            echo "tx.executeSql('INSERT INTO Question (id, title, img, content, category_id) VALUES (".$value['id'].", `".$value['title']."`, null, null, null)');<br>";
        }
        return;
        // echo response()->json(['success' => true, 'data' => $data]);
    }
    public function Answer($value='')
    {
        $data = QuestionAnswer::select("id", "question_id", "title", "img", "content", "is_answer")->get();
        foreach ($data as $key => $value) {
            echo "tx.executeSql('INSERT INTO Answer (id, question_id, title, img, content, is_answer) VALUES (".$value['id'].", ".$value['question_id'].",`".$value['title']."`, null, null, ".(($value['is_answer'] == true)? 1 : 0).")');<br>";
        }
        return;
        echo json_encode($data);
        // return response()->json(['success' => true, 'data' => $data]);
    }
}
