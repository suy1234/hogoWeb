<?php

namespace Modules\Education\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Education\Entities\Courses;
use Modules\User\Entities\User;
use Modules\Education\Entities\Subjects;
use Carbon\Carbon;
class Classs extends AppModel
{
    protected $module = 'education';
    protected $table = 'class';
    protected $fillable = array(
        'code',
        'course_id',
        'subject_id',
        'teacher_id',
        'max',
        'time_theory',
        'time_practice',
        'graduation_exam',
        'driving_exam_provisional',
        'driving_exam',
        'status',
        'created_by',
        'created_by',
        'updated_at',
        'created_at'           
    );

    protected $dates = [
        'graduation_exam:d-m-Y',
        'driving_exam_provisional:d-m-Y',
        'driving_exam:d-m-Y'
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

    public function subject() {
        return $this->hasOne(Subjects::class, 'id','subject_id');
    }

    public function course() {
        return $this->hasOne(Courses::class, 'id','course_id');
    }

    public function teacher() {
        return $this->hasOne(User::class, 'id','teacher_id');
    }

    public function customers() {
        return $this->hasMany(ClassCustomer::class, 'class_id', 'id');
    }

    public function getMapData($item)
    {
        return [
            'subject' => @$item->subject->title,
            'teacher' => @$item->teacher->fullname,
            'course' => @$item->course->title,
            'count_customer' => $item->customers()->count(),
            'graduation_exam' => Carbon::parse($item->graduation_exam)->format('d-m-Y'),
            'driving_exam_provisional' => Carbon::parse($item->driving_exam_provisional)->format('d-m-Y'),
            'driving_exam' => Carbon::parse($item->driving_exam)->format('d-m-Y')
        ];
    }
}
