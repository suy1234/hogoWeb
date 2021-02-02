<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Question\Entities\QuestionAnswer;
use DB;
class Seo extends AppModel
{
	protected $fillable = array(
		"taxonomy_id",
		"type",
		"alias",
		"img",
		"slider",
		"title",
		"description",
		"keyword",
		"published_at",
		"status",
		"updated_at",
		"created_at"           
	);

	protected static function boot() {
        parent::boot();
        static::creating(function (self $seo) {
            // $seo->published_at = date('Y-m-d H:i:s');
        });
        static::saved(function (self $seo) {
            $seo->status = (request()->seo['status'] === 'true') ? 1 : 0;
            DB::table($seo->type)->where('id', $seo->taxonomy_id)->update(['alias' => $seo->alias]);
        });

    }
}
