<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddWriter extends FormRequest
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
            'mobile_number' => ['required', 'numeric', 'min:11', 'unique:users', 'regex:/(09)[0-9]{9}/'],
            'password' => ['required', 'string', 'min:8'],
            'national_code' => ['nullable', 'string', 'min:10'],
            'email' => ['nullable', 'email', 'max:255'],
        ];
    }
}
