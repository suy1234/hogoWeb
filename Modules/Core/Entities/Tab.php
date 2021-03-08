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
        "type",
        "order",
        "status",
        "created_by",
        "created_at"           
    );
	
    protected static function boot() {
        parent::boot();
        static::creating(function (self $tab) {
            $tab->created_by = auth()->user()->id;
        });
    }
}
