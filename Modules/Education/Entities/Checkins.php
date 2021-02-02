<?php

namespace Modules\Education\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
class Checkins extends AppModel
{
    protected $module = 'education';
    protected $fillable = array(
        'customer_id',
        'schedule_id',
        'from_date',
        'to_date',
        'qty',
        'status',
        'created_by',
        'updated_at',
        'created_at'      
    );
    protected $dates = [
        'from_date:d-m-Y',
        'to_date:d-m-Y'
    ];
    protected static function boot() {
        parent::boot();
        static::creating(function (self $subject) {
            $subject->created_by = auth()->id();
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }

    public function search($request)
    {
        $query = $this->newQuery()->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->where('title', 'like', '%'.$keyword.'%')->orWhere('code', 'like', '%'.$keyword.'%');
        }
        return $query;
    }
}
