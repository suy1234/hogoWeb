<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Entities\Category;
use Modules\Core\Entities\Groups;
use Modules\Core\Entities\GroupTypes;
class Widget extends AppModel
{
    protected $module = 'website';
    protected $fillable = array(
        'type',
        'parent_id',
        'widget',
        'config',
        'sort',
        'status',
        'created_by',
        'updated_at',
        'created_at'           
    );
    
    protected $casts = [
        'config' => 'array',
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function (self $post) {
            $post->created_by = auth()->id();
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }
}
