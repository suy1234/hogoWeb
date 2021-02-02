<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Question\Entities\QuestionAnswer;
use Modules\Core\Entities\Seo;
class Setting extends AppModel
{
	protected $module = 'core';
	protected $fillable = array(
        "type",
        "config",
        "updated_at",
        "created_at"           
    );
	protected $casts = [
        'config' => 'array',
    ];
}
