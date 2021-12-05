<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrustedOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'real_estate_name',
        'full_name',
        'national_code',
        'mobile_number',
        'score',
        'email',
        'address',
    ];
}
