<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Question\Entities\Question;
use Modules\Core\Entities\Seo;
class Category extends AppModel
{
	protected $module = 'core';
	protected $table = 'categorys';
	protected $fillable = array(
        "title",
        "parent_id",
        "group_ids",
        "group_type_ids",
        "description",
        "content",
        "img",
        "slider",
        "order",
        "type",
        "alias",
        "author",
        "published_at",
        "status",
        "created_by",
        "updated_at",
        "created_at"           
    );
	protected $casts = [
        'group_ids' => 'array',
        'group_type_ids' => 'array',
    ];
    protected static function boot() {
        parent::boot();
        static::creating(function (self $category) {
            $category->created_by = auth()->user()->id;
            $category->type = request()->code;
        });
        static::saved(function (self $category) {
            $category->updateOrCreateSeo();
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id', 'id');
    }

    public function seo()
    {
        return $this->hasOne('Modules\Core\Entities\Seo', 'taxonomy_id', 'id')->where('type', $this->getTable())->withDefault();
    }
    public function tableQuestion($request)
    {
        $numRow = !empty($request->numRow) ? $request->numRow : 10;
        $query = $this->search($request);
        $query = $query->where('lang', getLangCode());
        if(!empty($status = request()->filter['status'])){
            $query = $query->where('status', $status);
        }
        return $query->orderBy('created_at', 'desc')
        ->orderBy('status', 'desc')
        ->paginate($numRow);
    }

    public function search($request)
    {
        $query = $this->newQuery()->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->where('title', 'like', '%'.$keyword.'%');
        }
        $query = $query->where('type', $request->code);
        return $query;
    }

    public function getMapData($param)
    {
        return [
            'question_href' => route('admin.questions.create', ['cat_id' => $param->id]),
            'parent' => @$param->parent->title
        ];
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'category_id', 'id');
    }
}
