<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Website\Entities\Layout;

class Unit extends AppModel
{
    protected $module = 'product';
    protected $fillable = array(
        "title",
        "status",
        "updated_at",
        "created_at"           
    );
    
    protected static function boot() {
        parent::boot();
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
        return $query;
    }

    public function getMapData($param)
    {

    }
}
