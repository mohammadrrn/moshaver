<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstateForm extends FormRequest
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
            'owner_name' => ['nullable', 'string', 'max:255', 'min:3'],
            'owner_mobile_number' => ['required', 'numeric', 'min:11', 'regex:/(09)[0-9]{9}/'],
            'image' => ['nullable'],
            'estate_id' => ['required', 'numeric'],
            'address' => ['required', 'string'],
            'area_id' => ['nullable', 'numeric'],
            'transfer_id' => ['nullable', 'numeric'],
            'area' => ['nullable', 'numeric'],
            'street_name' => ['nullable', 'string'],
            'plaque' => ['nullable', 'numeric'],
            'floor' => ['numeric', 'nullable'],
            'number_of_floor' => ['nullable', 'numeric'],
            'apartment_unit' => ['nullable', 'numeric'],
            'year_of_construction' => ['nullable', 'numeric'],
            'direction_id' => ['nullable', 'numeric'],
            'mortgage_price' => ['nullable', 'numeric'],
            'rent_price' => ['nullable', 'numeric'],
            'description' => ['nullable', 'string'],
            'empty' => ['nullable', 'boolean'],
            'presell' => ['nullable', 'boolean'],
            'exchange' => ['nullable', 'boolean'],
            'parking' => ['nullable', 'boolean'],
            'warehouse' => ['nullable', 'boolean'],
            'elevator' => ['nullable', 'boolean'],
            'electric_door' => ['nullable', 'boolean'],
            'iphone_video' => ['nullable', 'boolean'],
            'toilet' => ['nullable', 'boolean'],
            'balcony' => ['nullable', 'boolean'],
            'wall_cupboard' => ['nullable', 'boolean'],
            'surface_gas' => ['nullable', 'boolean'],
            'master_bath' => ['nullable', 'boolean'],
            'jacuzzi' => ['nullable', 'boolean'],
            'security_door' => ['nullable', 'boolean'],
            'cctv' => ['nullable', 'boolean'],
            'presence_owner' => ['nullable', 'boolean'],
            'convertable' => ['nullable', 'boolean'],
            'rebuilt' => ['nullable', 'boolean'],
            'no_owner' => ['nullable', 'boolean'],
            'full_authority' => ['nullable', 'boolean'],
            'separate_way' => ['nullable', 'boolean'],
            'single_type' => ['nullable', 'boolean'],
            'flat' => ['nullable', 'boolean'],
            'barbecue' => ['nullable', 'boolean'],
            'unit_zero' => ['nullable', 'boolean'],
            'roof_garden' => ['nullable', 'boolean'],
        ];
    }
}
