<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstateRequestDensityOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'text'
    ];
    protected $table = 'estate_request_density_option';
}
