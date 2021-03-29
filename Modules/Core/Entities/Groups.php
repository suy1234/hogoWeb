<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Question\Entities\QuestionAnswer;
use Modules\Core\Entities\Seo;
class Groups extends AppModel
{
	protected $module = 'core';
	protected $fillable = array(
        "title",
        "description",
        "content",
        "img",
        "slider",
        "order",
        "alias",
        "type",
        "author",
        "published_at",
        "status",
        "created_by",
        "updated_at",
        "created_at"           
    );
	
	protected static function boot() {
        parent::boot();
        static::creating(function (self $group) {
            $group->created_by = auth()->user()->id;
            $group->type = request()->code;
        });
        static::saved(function (self $group) {
            $group->updateOrCreateSeo();
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
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
}
