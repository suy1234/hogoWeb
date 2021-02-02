<?php

namespace Modules\Advisory\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;

class Advisory extends AppModel
{
    protected $module = 'advisory';
    protected $fillable = array(
        "code",
        "title",
        "description",
        "content",
        "img",
        "gallerys",
        "order",
        "status",
        "created_by",
        "updated_at",
        "created_at"           
    );
    
    protected static function boot() {
        parent::boot();
        static::creating(function (self $bank) {
            $bank->created_by = auth()->id();
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }
}
