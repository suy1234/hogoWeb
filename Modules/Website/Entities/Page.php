<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Website\Entities\Layout;

class Page extends AppModel
{
    protected $module = 'website';
    protected $fillable = array(
        "type",
        "page_default",
        "title",
        "alias",
        "description",
        "content",
        "gallerys",
        "img",
        "order",
        "view_count",
        "status",
        "published_at",
        "created_by",
        "updated_at",
        "created_at"           
    );
    
    protected $casts = [
        'gallerys' => 'array',
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function (self $page) {
            $page->created_by = auth()->id();
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });

        static::saved(function (self $page) {
            $page->updateOrCreateSeo();
        });
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
            'url_builder' => route('admin.pages.editor', ['id' => $param->id]),
            'url_design' => route('admin.pages.design', ['id' => $param->id]),
        ];
    }

    public function layouts()
    {
        return $this->hasMany(Layout::class, 'page_id');
    }
}
