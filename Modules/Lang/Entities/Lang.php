<?php

namespace Modules\Lang\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
class Lang extends AppModel
{
    protected $module = 'lang';
    protected $table = 'languages';
    protected $fillable = array(
        "title",
        "code",
        "default",
        "status",
        "created_by",
        "updated_at",
        "created_at"           
    );
    protected static function boot() {
        parent::boot();
        static::creating(function (self $lang) {
            $lang->created_by = auth()->id();
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }

    public function search($request)
    {
        $query = $this->newQuery()->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->where('title', 'like', '%'.$keyword.'%')->orWhere('code', 'like', '%'.$keyword.'%');
        }
        return $query;
    }
}
