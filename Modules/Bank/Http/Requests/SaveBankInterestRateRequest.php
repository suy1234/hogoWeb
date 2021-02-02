<?php
namespace Modules\Bank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveBankInterestRateRequest extends FormRequest
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
            'bank_id' => 'required',
            'category_id' => 'required',
        ];
    }
}
