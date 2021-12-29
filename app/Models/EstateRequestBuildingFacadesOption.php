<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstateRequestBuildingFacadesOption extends Model
{
    use HasFactory;

    protected $table = 'estate_request_building_facades_option';
    protected $fillable = [
        'text'
    ];
}
