<?php

namespace App\Http\Requests;

use App\Http\Controllers\AssistantController;
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
            /*'g-recaptcha-response' => ['required', 'captcha'],*/
            'owner_name' => ['nullable', 'string', 'max:255', 'min:3'],
            'owner_mobile_number' => ['required', 'numeric', 'min:11', 'regex:/(09)[0-9]{9}/'],
            'image' => ['nullable', 'mimes:jpeg,jpg,png', 'max:3000'], // max 3000kb
            'slider.*' => ['nullable', 'mimes:jpeg,jpg,png', 'max:3000'], // max 3000kb
            /*'street_name' => ['nullable', 'string'],*/
            'address' => ['required', 'string'],
            'estate_id' => ['required', 'numeric'],
            'area_id' => ['required', 'numeric'],
            'transfer_id' => ['required', 'numeric'],
            'area' => ['nullable', 'numeric'],
            'plaque' => ['nullable', 'numeric'],
            'floor' => ['numeric', 'nullable'],
            'all_floor' => ['nullable', 'boolean'],
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

    public function messages()
    {

        return [
            'slider.*.mimes' => 'فرمت قابل قبول برای عکس های اسلایدر jpeg, jpg, png می باشد',
            'slider.*.max' => 'حجم عکس ها نباید بیشتر از باشد 200 کیلوبایت.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'owner_mobile_number' => AssistantController::filterNumber($this->get('owner_mobile_number')),
        ]);
        $this->merge([
            'area' => AssistantController::filterNumber($this->get('area')),
        ]);
        $this->merge([
            'plaque' => AssistantController::filterNumber($this->get('plaque')),
        ]);
        $this->merge([
            'floor' => AssistantController::filterNumber($this->get('floor')),
        ]);
        $this->merge([
            'number_of_floor' => AssistantController::filterNumber($this->get('number_of_floor')),
        ]);
        $this->merge([
            'number_of_room' => AssistantController::filterNumber($this->get('number_of_room')),
        ]);
        $this->merge([
            'apartment_unit' => AssistantController::filterNumber($this->get('apartment_unit')),
        ]);
        $this->merge([
            'year_of_construction' => AssistantController::filterNumber($this->get('year_of_construction')),
        ]);
    }
}
