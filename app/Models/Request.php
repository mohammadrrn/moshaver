<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
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
}
