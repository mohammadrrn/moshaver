<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cession extends Model
{
    use HasFactory;

    protected $fillable = [
        'estate_request_id'
    ];
}
