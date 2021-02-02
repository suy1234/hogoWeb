<?php
namespace Modules\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveLayoutRequest extends FormRequest
{
    public function rules()
    {
    	if(request()->has('parent_id')){
    		return [];
    	}
        return [
            'title' => 'required'
        ];
    }
}
