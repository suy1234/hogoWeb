<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Builder;
class Customers extends AppModel
{
    protected $module = 'customer';
    protected $fillable = array(
        'code',
        'type',
        'parent_id',
        'fullname',
        'avatar',
        'cmnd_front',
        'cmnd_back',
        'phone',
        'gender',
        'birthday',
        'email',
        'password',
        'remember_token',
        'passport',
        'country_id',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'note',

        'is_organization',
        'organization_id',
        'organization_size',
        'organization_type',
        'organization_career',
        'organization_name',
        'organization_phone',
        'organization_email',

        'website',
        'vat',
        'level',

        'affiliate_id',
        'event_id',
        'agency_id',
        'status',
        'created_by',
        'created_at',
        'updated_at'
    );
    protected $dates = [
        'birthday:d-m-Y'
    ];
    public function generateCode($id, $key = 0) {

        if ($id < 19990) {
            $id += 19990;
        }
        $list = range('A', 'Z');
        if ($id > 999999) {
            $key += 1;
            return $this->generateCode($id - 1000000, $key);
        }

        return $list[$key] . ((strlen($id) == 6) ? $id : ('0' . $id));
    }

    protected static function boot() {
        parent::boot();
        static::created(function (self $customer) {
            $customer->created_by = auth()->id();
            $customer->code = $customer->generateCode($customer->id + 12919);
            if (!request()->routeIs('admin.students.create')) {
                $customer->type = 'student';
            }
            $customer->save();

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
