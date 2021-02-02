<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Builder;

class CustomerWebitop extends AppModel
{
    protected $module = 'customer';
    protected $fillable = array(
        'domain_demo',
        'domain',
        'fullname',
        'email',
        'phone',
        'start_date',
        'expired_at',
        'status',
        'created_at',
        'updated_at'
    );

    protected static function boot() {
        parent::boot();
        static::created(function (self $customer) {

        });
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }
    public function table($request)
    {
        Carbon::setLocale(getLangCode());
        $numRow = !empty($request->numRow) ? $request->numRow : 10;
        $query = $this->filter($request);
        // $query = $this->search($request);
        $query = $query->where('type', 'customer');
        
        $results = $query->orderBy('created_at', 'desc')->paginate($numRow);
        $results->map(function($item){
            $item['created_text'] = Carbon::parse($item->created_at)->diffForHumans();
            $item['updated_text'] = Carbon::parse($item->created_at)->diffForHumans();
            $item['option'] = $this->getMapData($item);
            $class = config('core.status_class.'.$item->status);
            $item['status_text'] = '<span class="font-size-base font-weight-normal badge badge-flat border-'.$class.' text-'.$class.'">'.trans($item->module.'::'.$item->table.'.status.'.$item->status).'</span>';
            return $item;
        });
        return $results;
    }

    public function tableStudent($request)
    {
        Carbon::setLocale(getLangCode());
        $numRow = !empty($request->numRow) ? $request->numRow : 10;
        $query = $this->search($request);
        $query = $query->where('type', 'student');
        if(!empty($status = request()->filter['status'])){
            $query = $query->where('status', $status);
        }
        $results = $query->orderBy('created_at', 'desc')->paginate($numRow);
        $results->map(function($item){
            $item['created_text'] = Carbon::parse($item->created_at)->diffForHumans();
            $item['updated_text'] = Carbon::parse($item->created_at)->diffForHumans();
            $item['option'] = $this->getMapData($item);
            $class = config('core.status_class.'.$item->status);
            $item['status_text'] = '<span class="font-size-base font-weight-normal badge badge-flat border-'.$class.' text-'.$class.'">'.trans($item->module.'::'.$item->table.'.status.'.$item->status).'</span>';
            return $item;
        });
        return $results;
    }

    public function filter($request){
        $query = $this->newQuery();
        if(!empty($status = request()->filter['status'])){
            $query = $query->where('status', $status);
        }

        return $query;
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
