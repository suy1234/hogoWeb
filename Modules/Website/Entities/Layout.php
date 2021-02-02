<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Widget\Entities\WidgetTheme;

class Layout extends AppModel
{
    protected $module = 'website';
    protected $fillable = array(
        'title',
        'type',
        'page_id',
        'parent_id',
        'class',
        'widget_id',
        'widget',
        'widget_type',
        'config',
        'status',
        'created_by',
        'updated_at',
        'created_at'           
    );
    protected $casts = [
        'config' => 'array',
    ];
    protected $with = ['widgets'];

    protected static function boot() {
        parent::boot();
        static::creating(function (self $layout) {
            $layout->created_by = auth()->id();
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
        return $query->whereNull('parent_id');
    }

    public function parents()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function widgets()
    {
        return $this->hasMany($this, 'parent_id')->orderBy('order', 'asc');
    }

    public function widget_theme() {
        return $this->hasOne(WidgetTheme::class, 'id', 'widget_id');
    }

    public function layouts()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function getMapData($param)
    {
        return [
            'url_widget' => route('admin.layouts.design', ['id' => $param->id]),
            'type' => trans('core::cores.layout_type.'.$param->type)
        ];
    }
}
