<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zoonkan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'zoonkan_name',
        'zoonkan_color',
    ];

    public function files()
    {
        return $this->belongsToMany(EstateRequest::class, 'zoonkan_file', 'zoonkan_id', 'estate_request_id');
    }
}
