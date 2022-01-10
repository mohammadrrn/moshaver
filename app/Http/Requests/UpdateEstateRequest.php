<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstateRequest extends FormRequest
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
            "deleted_slider" => ['array', 'nullable'],
            "deleted_image" => ['nullable'],
            'owner_name' => ['nullable', 'string', 'max:255', 'min:3'],
            'owner_mobile_number' => ['required', 'numeric', 'min:11', 'regex:/(09)[0-9]{9}/'],
            'transfer_id' => ['required', 'numeric'],
            'area' => ['nullable', 'numeric'],
            'street_name' => ['nullable', 'string'],
            'plaque' => ['nullable', 'numeric'],
            'floor' => ['numeric', 'nullable'],
            'number_of_floor' => ['nullable', 'numeric'],
            'number_of_room' => ['nullable', 'numeric'],
            'apartment_unit' => ['nullable', 'numeric'],
            'year_of_construction' => ['nullable', 'numeric'],
            'direction_id' => ['required', 'numeric'],
            'mortgage_price' => ['nullable'],
            'rent_price' => ['nullable'],
            'buy_price' => ['nullable'],
            'participation_price' => ['nullable'],
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
            'bathtub' => ['nullable', 'boolean'],
            'security_door' => ['nullable', 'boolean'],
            'cctv' => ['nullable', 'boolean'],
            'roof_garden' => ['nullable', 'boolean'],
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
            'floor_covering_id' => ['nullable'],
            'cabinets_id' => ['nullable'],
            'wall_plugs_id' => ['nullable'],
            'building_facades_id' => ['nullable'],
            'heating_system_id' => ['nullable'],
            'cooling_system_id' => ['nullable'],
            'document_type_id' => ['nullable'],
            'density_id' => ['nullable'],
        ];
    }
}
