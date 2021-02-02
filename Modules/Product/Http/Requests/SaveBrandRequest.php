<?php
namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveBrandRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
        ];
    }
}
