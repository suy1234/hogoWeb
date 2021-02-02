<?php

namespace Modules\Bank\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;

class Bank extends AppModel
{
    protected $module = 'bank';
    protected $fillable = array(
        "code",
        "title",
        "description",
        "content",
        "img",
        "gallerys",
        "order",
        "status",
        "created_by",
        "updated_at",
        "created_at"           
    );
    
    protected static function boot() {
        parent::boot();
        static::creating(function (self $bank) {
            $bank->created_by = auth()->id();
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });

        static::saved(function (self $bank) {
            $bank->updateOrCreateSeo();
        });
    }

    public function search($request)
    {
        $query = $this->newQuery()->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->where(function ($q) use ($keyword)
            {
                return $q->where('title', 'like', '%'.$keyword.'%')
                ->orWhere('description', 'like', '%'.$keyword.'%');
            });
        }
        return $query;
    }
}
