<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TrustedOfficesUpdate extends FormRequest
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
            'national_code' => ['nullable', 'string', 'min:10'],
            'mobile_number' => ['required', 'numeric', 'min:11', 'unique:users,mobile_number,' . $this->id, 'regex:/(09)[0-9]{9}/'],
            'score' => ['required', 'numeric'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }
}
