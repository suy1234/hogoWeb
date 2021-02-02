<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Entities\Category;
use Modules\Core\Entities\Groups;
use Modules\Core\Entities\GroupTypes;
use Modules\User\Entities\User;

class Post extends AppModel
{
    protected $module = 'website';
    protected $fillable = array(
        "title",
        "alias",
        "description",
        "content",
        "category_id",
        "group_ids",
        "gallerys",
        "img",
        "order",
        "view_count",
        "status",
        "published_at",
        "created_by",
        "updated_at",
        "created_at"           
    );
    
    protected $casts = [
        'gallerys' => 'array',
        'group_ids' => 'array'
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function (self $post) {
            $post->created_by = auth()->id();
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });

        static::saved(function (self $post) {
            $post->updateOrCreateSeo();
        });
        static::saving(function (self $post) {
            if(empty(request()->group_ids)){
                $post->group_ids = null;
            }
        });
    }

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function search($request)
    {
        $query = $this->newQuery()->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->where(function ($q) use ($keyword)
            {
                return $q->where('title', 'like', '%'.$keyword.'%')
                ->orWhere('content', 'like', '%'.$keyword.'%');
            });
        }
        return $query;
    }

    public function getMapData($param)
    {
        return [
            'category' => @$param->category->title
        ];
    }

    public function owner(){
        return $this->hasOne(User::class, 'id', 'created_by')->select(['id', 'fullname', 'phone', 'email'])->withDefault([
            'id' => '', 
            'fullname' => 'Admin',
            'phone' => '',
            'email' => ''
        ]);
    }
}
