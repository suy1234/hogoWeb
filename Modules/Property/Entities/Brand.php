<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Website\Entities\Layout;

class Brand extends AppModel
{
    protected $module = 'product';
    protected $fillable = array(
        "title",
        "alias",
        "description",
        "content",
        "gallerys",
        "img",
        "view_count",
        "status",
        "created_by",
        "updated_at",
        "created_at"           
    );
    
    protected $casts = [
        'gallerys' => 'array',
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function (self $entity) {
            $entity->created_by = auth()->id();
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });

        static::saved(function (self $entity) {
            $entity->updateOrCreateSeo();
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

    public function getMapData($param)
    {

    }

    public function layouts()
    {
        return $this->hasMany(Layout::class, 'page_id');
    }
}
