<?php

namespace Modules\Question\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Question\Entities\QuestionAnswer;
use Modules\Core\Entities\Category;
use Modules\Core\Entities\Groups;
use Modules\Core\Entities\GroupTypes;

class Question extends AppModel
{
    protected $module = 'question';
    protected $fillable = array(
        "title",
        "content",
        "img",
        "category_id",
        "group_id",
        "group_type_id",
        "status",
        "created_by",
        "updated_at",
        "created_at"           
    );
    protected static function boot() {
        parent::boot();
        static::creating(function (self $question) {
            $question->created_by = auth()->id();
        });
        static::created(function (self $question) {
            if (request()->has('answers')) {
                $input = [];
                foreach (request()->answers as $value) {
                    if(!empty($value['title'])){
                        $value['is_answer'] = ($value['is_answer'] == 'true') ? 1 : 0;
                        $value['question_id'] = $question->id;
                        $input[] = $value;
                    }
                }
                $question->answers()->insert($input);
            }
        });
        static::updated(function (self $question) {
            if (request()->has('answers')) {
                $input = [];
                foreach (request()->answers as $value) {
                    if(!empty($value['answers'])){
                        $value['is_answer'] = ($value['is_answer'] == 'true') ? 1 : 0;
                        $question->answers()->updateOrCreate([
                            'id' => $value['id']
                        ],$value);
                    }
                }
            }
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }

    public function answers() {
        return $this->hasMany(QuestionAnswer::class, 'question_id', 'id');
    }

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function group() {
        return $this->hasOne(Groups::class, 'id', 'group_id');
    }

    public function group_type() {
        return $this->hasOne(GroupTypes::class, 'id', 'group_type_id');
    }

    public function search($request)
    {
        $query = $this->newQuery()->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->where(function ($q) use ($keyword)
            {
                return $q->where('title', 'like', '%'.$keyword.'%')
                ->orWhere('content', 'like', '%'.$keyword.'%');
            });
        }
        return $query;
    }

    public function getMapData($param)
    {
        return [
            'category' => @$param->category->title,
            'group' => @$param->group->title,
            'group_type' => @$param->group_type->title
        ];
    }
}
