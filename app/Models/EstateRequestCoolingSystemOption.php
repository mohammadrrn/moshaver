<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstateRequestCoolingSystemOption extends Model
{
    use HasFactory;

    protected $table = 'estate_request_cooling_system_option';
    protected $fillable = [
        'text'
    ];
}
