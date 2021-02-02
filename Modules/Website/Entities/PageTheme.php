<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;

class PageTheme extends AppModel
{
    protected $module = 'website';
    protected $fillable = array(
        'type',
        'page_id',
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
}
