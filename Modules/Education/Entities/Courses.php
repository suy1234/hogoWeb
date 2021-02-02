<?php

namespace Modules\Education\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
class Courses extends AppModel
{
    protected $module = 'education';
    protected $fillable = array(
        'code',
        'title',
        'status',
        'school_from_year',
        'school_to_year',
        'created_by',
        'updated_at',
        'created_at'           
    );
    // protected $dateFormat = 'Y-m-d';
    protected $dates = [
        'school_from_year:d-m-Y',
        'school_to_year:d-m-Y'
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
