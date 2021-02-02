<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Question\Entities\QuestionAnswer;
use Modules\Core\Entities\Seo;
class Units extends AppModel
{
	protected $module = 'core';
	protected $fillable = array(
        'title',
        'type',
        'status',
        'created_by',
        'updated_at',
        'created_at'           
    );
	
    protected static function boot() {
        parent::boot();
        static::creating(function (self $category) {
            $category->created_by = auth()->user()->id;
            $category->type = request()->code;
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
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
