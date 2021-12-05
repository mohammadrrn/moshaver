<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrustedOffices extends FormRequest
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
            'real_estate_name' => ['required', 'string', 'max:255', 'min:3'],
            'full_name' => ['required', 'string', 'max:255', 'min:3'],
            'national_code' => ['nullable', 'string', 'min:10', 'unique:trusted_offices'],
            'mobile_number' => ['required', 'numeric', 'min:11', 'unique:trusted_offices', 'regex:/(09)[0-9]{9}/'],
            'score' => ['required', 'numeric'],
            'address' => ['nullable', 'max:255'],
        ];
    }
}
