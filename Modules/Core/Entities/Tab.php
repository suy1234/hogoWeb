<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Question\Entities\QuestionAnswer;
use Modules\Core\Entities\Seo;
class Tab extends AppModel
{
	protected $module = 'core';
	protected $table = 'tabs';
	protected $fillable = array(
        "title",
        "order",
        "alias",
        "published_at",
        "status",
        "created_by",
        "updated_at",
        "created_at"           
    );
	
    protected static function boot() {
        parent::boot();
        static::creating(function (self $category) {
            $category->created_by = auth()->user()->id;
        });
        static::saved(function (self $category) {
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }
}
