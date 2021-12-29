<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstateRequestWallPlugsOption extends Model
{
    use HasFactory;

    protected $table = 'estate_request_wall_plugs_option';
    protected $fillable = [
        'text'
    ];
}
