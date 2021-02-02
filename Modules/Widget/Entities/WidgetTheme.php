<?php

namespace Modules\Widget\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Entities\Category;
use Modules\Core\Entities\Groups;
use Modules\Core\Entities\GroupTypes;
class WidgetTheme extends AppModel
{
    protected $module = 'widget';
    protected $fillable = array(
        'img',
        'type',
        'config',
        'css',
        'sass',
        'js',
        'html',
        'status',
        'order',
        'view',
        'created_by',
        'updated_at',
        'created_at'           
    );
    
    protected $casts = [
        'config' => 'array',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function (self $widget_theme) {
            $widget_theme->order = $widget_theme->where('type', $widget_theme->type)->count() + 1;
        });

        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }
}
