<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstateRequestFloorCoveringOption extends Model
{
    use HasFactory;

    protected $table = 'estate_request_floor_covering_option';
    protected $fillable = [
        'text'
    ];
}
