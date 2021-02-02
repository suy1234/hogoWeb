<?php

namespace Modules\Bank\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Illuminate\Database\Eloquent\Builder;
use Modules\Bank\Entities\Bank;
use Modules\Core\Entities\Category;
use Modules\Core\Entities\Groups;

class BankInterestRate extends AppModel
{
    protected $module = 'bank';
    protected $fillable = array(
        "title",
        "bank_id",
        "category_id",
        "group_id",
        "content",
        "bank_info",
        "status",
        "created_by",
        "updated_at",
        "created_at"           
    );
    
    protected $casts = [
        'bank_info' => 'array',
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function (self $bankInterestRate) {
            $bankInterestRate->created_by = auth()->id();
        });
        static::saving(function (self $bankInterestRate) {
            $title = !empty($bankInterestRate->group) ? mb_strtolower($bankInterestRate->group->title) : '';
            $bankInterestRate->title = $bankInterestRate->category->title.' '.$title.' '.mb_strtolower($bankInterestRate->category->bank).' '.mb_strtolower($bankInterestRate->bank->title);
        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }

    public function search($request)
    {
        $query = $this->newQuery()->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->where(function ($q) use ($keyword)
            {
                return $q->where('content', 'like', '%'.$keyword.'%');
            });
        }
        return $query;
    }

    public function bank() {
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function group() {
        return $this->hasOne(Groups::class, 'id', 'group_id');
    }
}
