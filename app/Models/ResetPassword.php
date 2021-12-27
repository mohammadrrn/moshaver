<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;

    protected $table = 'password_resets';

    protected $fillable = [
        'mobile_number',
        'code',
        'try',
    ];
}
