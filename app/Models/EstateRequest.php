<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstateRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_name',
        'owner_mobile_number',
        'area_id',
        'transfer_id',
        'estate_id',
        'address',
        'area',
        'street_name',
        'plaque',
        'floor',
        'number_of_floor',
        'number_of_room',
        'apartment_unit',
        'year_of_construction',
        'direction_id',
        'mortgage_price',
        'rent_price',
        'buy_price',
        'description',
        'empty',
        'presell',
        'exchange',
        'parking',
        'warehouse',
        'elevator',
        'electric_door',
        'iphone_video',
        'toilet',
        'balcony',
        'wall_cupboard',
        'surface_gas',
        'master_bath',
        'jacuzzi',
        'security_door',
        'cctv',
        'presence_owner',
        'convertable',
        'rebuilt',
        'no_owner',
        'full_authority',
        'separate_way',
        'single_type',
        'flat',
        'barbecue',
        'unit_zero',
        'roof_garden',
    ];

    public function direction()
    {
        return $this->hasMany(Direction::class, 'id', 'direction_id');
    }

    public function estateType()
    {
        return $this->hasMany(Estate::class, 'id', 'estate_id');
    }
}
