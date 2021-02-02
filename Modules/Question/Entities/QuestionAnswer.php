<?php

namespace Modules\Question\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
class QuestionAnswer extends AppModel
{
    protected $fillable = array(
        "question_id",
        "title",
        "img",
        "content",
        "is_answer",
        "status",
        "created_by",
        "updated_at",
        "created_at"           
    );

    public function getIsAnswerAttribute($is_answer)
    {
        return ($is_answer == 1) ? true : false;
    }
}
