<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => ['required', 'string', 'max:255', 'min:3'],
            'mobile_number' => ['required', 'numeric', 'min:11', 'regex:/(09)[0-9]{9}/'],
            'area_id' => ['required', 'numeric'],
            'type_of_transfer' => ['required', 'numeric'],
            'type_of_estate' => ['required', 'numeric'],
            'range_of_address' => ['required', 'string', 'max:255'],
            'rang_of_area' => ['numeric'],
            'buy_price' => ['nullable', 'numeric'],
            'mortgage_price' => ['nullable', 'numeric'],
            'rent_price' => ['nullable', 'numeric'],
            'description' => ['nullable', 'string'],
        ];
    }
}
