<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Profile extends FormRequest
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
            'national_code' => ['required', 'string', 'min:10'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'max:255'],
        ];
    }
}
