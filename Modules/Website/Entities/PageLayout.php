<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;

class PageLayout extends AppModel
{
    protected $module = 'website';
    protected $fillable = array(
        'taxonomy',
        'taxonomy_id',
        'title',
        'type',
        'parent_id',
        'widget',
        'widget_type',
        'config',
        'order',
        'created_by',
        'updated_at',
        'created_at'           
    );
    
    protected $casts = [
        'config' => 'array',
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function (self $page_theme) {
            $page_theme->created_by = auth()->id();
        });
    }

    public function search($request)
    {
        $query = $this->newQuery()->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->where(function ($q) use ($keyword)
            {
                return $q->where('title', 'like', '%'.$keyword.'%');
            });
        }
        return $query;
    }

    public function getMapData($param)
    {
        return [
            'url_widget' => route('admin.layouts.widget', ['id' => $param->id])
        ];
    }
}
