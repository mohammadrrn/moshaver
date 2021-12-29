<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstateRequestCabinetsOption extends Model
{
    use HasFactory;

    protected $table = 'estate_request_cabinets_option';
    protected $fillable = [
        'text'
    ];
}
