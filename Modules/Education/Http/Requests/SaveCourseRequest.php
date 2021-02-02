<?php
namespace Modules\Education\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'school_from_year' => 'required',
            'school_to_year' => 'required',
        ];
    }
}
