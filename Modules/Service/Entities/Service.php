<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
class Service extends AppModel
{
    protected $module = 'service';
    protected $fillable = array(
        "title",
        "description",
        "path",
        "status",
        "created_by",
        "updated_at",
        "created_at"           
    );
    protected static function boot() {
        parent::boot();
        static::creating(function (self $product) {
            $product->created_by = auth()->user()->id;
        });
    }

    public function search($request)
    {
        $query = $this->newQuery();
        if(!empty($keyword = array_get($request->all(), 'keyword'))){
            $query = $query->where('title', 'like', '%'.$keyword.'%')->orWhere('description', 'like', '%'.$keyword.'%');
        }
        if(!empty($create_by = array_get($request->all(), 'create_by'))){
            $query = $query->where('created_by', $create_by);
        }

        return $query;
    }
}
