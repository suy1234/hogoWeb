<?php

namespace Modules\App\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class AppModel extends Model
{
	// protected $appends = [
 //        'status_text',
 //    ];
    public function table($request)
    {
        Carbon::setLocale(getLangCode());
        $numRow = !empty($request->numRow) ? $request->numRow : 10;
        $query = $this->search($request);
        // $query = $query->where('lang', getLangCode());
        if(!empty($status = request()->filter['status'])){
            $query = $query->where('status', $status);
        }
        $class = config('core.status_class');
        $results = $query->orderBy('created_at', 'desc')->paginate($numRow);
        $data = [
            'current_page' => $results->currentPage(),
            'total' => $results->total(),
            'last_page' => $results->lastPage(),
            'per_page' => $results->perPage(),
        ];
        $data['data'] = $results->sortBy(function ($swatch) use ($class) {
            $swatch->created_text = Carbon::parse($swatch->created_at)->diffForHumans();
            $swatch->updated_text = Carbon::parse($swatch->created_at)->diffForHumans();
            $swatch->option = $this->getMapData($swatch);
            $swatch->status_text = '<span class="font-size-base font-weight-normal badge badge-flat border-'.@$class[$swatch->status].' text-'.@$class[$swatch->status].'">'.trans($swatch->module.'::'.$swatch->table.'.status.'.$swatch->status).'</span>';
            return $swatch;
        });
        return $data;

        // $class = config('core.status_class');
        // $results->map(function($item) use ($class){
        //     $item['created_text'] = Carbon::parse($item->created_at)->diffForHumans();
        //     $item['updated_text'] = Carbon::parse($item->created_at)->diffForHumans();
        //     $item['option'] = $this->getMapData($item);
            
        //     $item['status_text'] = '<span class="font-size-base font-weight-normal badge badge-flat border-'.$class[$item->status].' text-'.$class[$item->status].'">'.trans($item->module.'::'.$item->table.'.status.'.$item->status).'</span>';
        //     return $item;
        // });
        return $results;
    }

    public function getMapData($item)
    {
        return [];
    }
    // public function getCreatedAtAttribute($date)
    // {
    //     return Carbon::parse($date)->diffForHumans();
    // }

    // public function getUpdatedAtAttribute($date)
    // {
    //     return Carbon::parse($date)->diffForHumans();
    // }

    public function updateOrCreateSeo()
    {
        if(!empty(request()->seo)){
            $input = [
                "type" => $this->getTable(),
                "alias" => !empty(request()->seo['alias']) ? request()->seo['alias'] : request()->alias,
                "img" => !empty(request()->seo['img']) ? request()->seo['img'] : request()->img,
                "slider" => !empty(request()->seo['slider']) ? request()->seo['slider'] : request()->slider,
                "title" => !empty(request()->seo['title']) ? request()->seo['title'] : request()->title,
                "description" => !empty(request()->seo['description']) ? request()->seo['description'] : request()->description,
                "keyword"  => !empty(request()->seo['keyword']) ? request()->seo['keyword'] : request()->keyword,
            ];
            if(!empty($this->seo->title)){
                return $this->seo()->update($input);
            }
            return $this->seo()->create($input);
        }
    }

    public function seo()
    {
        return $this->hasOne('Modules\Core\Entities\Seo', 'taxonomy_id', 'id')->where('type', $this->getTable())->withDefault();
    }

    public function getSeo()
    {
        $seo = \Modules\Core\Entities\Seo::where('taxonomy_id', $this->id)->where('type', $this->getTable())->first();
        if(empty($seo)){
            $seo = $this;
        }
        return $seo;
    }

    public function search($request)
    {
        $query = $this->newQuery();
        if(!empty($create_by = array_get($request->all(), 'create_by'))){
            $query = $query->where('created_by', $create_by);
        }
        return $query;
    }
}