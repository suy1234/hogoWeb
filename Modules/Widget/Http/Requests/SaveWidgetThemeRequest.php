<?php
namespace Modules\Widget\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveWidgetThemeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type' => 'required'
        ];
    }
}
