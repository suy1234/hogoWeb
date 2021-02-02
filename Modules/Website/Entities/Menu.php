<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
class Menu extends AppModel
{
    protected $module = 'website';
    protected $fillable = array(
        'parent_id',
        'menu_id',
        'title',
        'url',
        'icon',
        'order',
        'created_by',
        'updated_at',
        'created_at'           
    );
    protected static function boot() {
        parent::boot();
        static::creating(function (self $menu) {
            $menu->created_by = auth()->id();
        });
    }

     protected $appends = [
        'children_sub',
    ];
    public function getChildrenSubAttribute() {
        if(!empty($this->parent_id)){
            $children_sub = Menu::where('parent_id', $this->id)->get();
            return $children_sub ? $children_sub : [];
        }
        else{
            $children_sub = Menu::where('parent_id', $this->id)->get();
            return $children_sub ? $children_sub : [];
        }
        return [];
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
