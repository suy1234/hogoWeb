<?php

namespace Modules\Education\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
class ClassCustomer extends AppModel
{
    protected $module = 'education';
    protected $fillable = array(
        'code',
        'class_id',
        'customer_id',
        'tuition',
        'tuition_collected',
        'from_date',
        'status',
        'created_by',
        'created_by',
        'updated_at',
        'created_at'           
    );

    protected $dates = [
        'from_date:d-m-Y'
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function (self $courses) {
            $courses->created_by = auth()->id();
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
