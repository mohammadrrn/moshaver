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
        'image',
        'thumbnail',
        'sliders',
        'area_id',
        'user_id',
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
        'participation_price',
        'description',
        'reason',
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
        'status',
        'floor_covering_id',
        'cabinets_id',
        'wall_plugs_id',
        'building_facades_id',
        'heating_system_id',
        'cooling_system_id',
        'document_type_id',
    ];

    public function floorCovering()
    {
        return $this->hasMany(EstateRequestFloorCoveringOption::class, 'id', 'floor_covering_id');
    }

    public function cabinets()
    {
        return $this->hasMany(EstateRequestCabinetsOption::class, 'id', 'cabinets_id');
    }

    public function wallPlugs()
    {
        return $this->hasMany(EstateRequestWallPlugsOption::class, 'id', 'wall_plugs_id');
    }

    public function buildingFacades()
    {
        return $this->hasMany(EstateRequestBuildingFacadesOption::class, 'id', 'building_facades_id');
    }

    public function heatingSystem()
    {
        return $this->hasMany(EstateRequestHeatingSystemOption::class, 'id', 'heating_system_id');
    }

    public function coolingSystem()
    {
        return $this->hasMany(EstateRequestCoolingSystemOption::class, 'id', 'cooling_system_id');
    }

    public function documentType()
    {
        return $this->hasMany(EstateRequestDocumentTypeOption::class, 'id', 'document_type_id');
    }

    public function direction()
    {
        return $this->hasMany(Direction::class, 'id', 'direction_id');
    }

    public function transfer()
    {
        return $this->hasMany(Transfer::class, 'id', 'transfer_id');
    }

    public function areas()
    {
        return $this->hasMany(Area::class, 'id', 'area_id');
    }

    public function estateType()
    {
        return $this->hasMany(Estate::class, 'id', 'estate_id');
    }

    public function bookmark()
    {
        return $this->hasOne(Bookmarks::class, 'estate_request_id', 'id')->where('user_id', auth()->id());
        //return $this->belongsToMany(EstateRequest::class, 'users', 'id', 'estate_request_id');
    }

    public function book()
    {
        return $this->belongsToMany(EstateRequest::class, 'bookmarks', 'estate_request_id')->wherePivot('user_id', auth()->id());
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    /*public function files()
    {
        return $this->belongsToMany(EstateRequest::class, 'zoonkan_file', 'zoonkan_id', 'estate_request_id');
    }*/
}
