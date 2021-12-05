<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'mobile_number',
        'area_id',
        'transfer_id',
        'estate_id',
        'range_of_address',
        'rang_of_area',
        'buy_price',
        'mortgage_price',
        'rent_price',
        'description',
    ];

    public function areas()
    {
        return $this->hasMany(Area::class, 'id', 'area_id');
    }

    public function transfer()
    {
        return $this->hasMany(Transfer::class, 'id', 'transfer_id');
    }

    public function estateType()
    {
        return $this->hasMany(Estate::class, 'id', 'estate_id');
    }

}
