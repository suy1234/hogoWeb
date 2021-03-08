<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Question\Entities\QuestionAnswer;
use Modules\Core\Entities\Seo;
class Attribute extends AppModel
{
	protected $module = 'core';
	protected $table = 'attributes';
	protected $fillable = array(
        'type',
        'title',
        'parent_id',
        'category_id',
        'form_type',
        'config',
        'order',
        'created_at'
    );
	
    protected static function boot() {
        parent::boot();
        static::creating(function (self $attribute) {
            $attribute->created_by = auth()->user()->id;
        });
    }
}
