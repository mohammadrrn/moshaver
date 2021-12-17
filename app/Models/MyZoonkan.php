<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyZoonkan extends Model
{
    use HasFactory;

    protected $table = 'zoonkan_file';

    protected $fillable = [
        'zoonkan_id',
        'estate_request_id',
        'user_id',
        'evacuation_day'
    ];

    public function files()
    {
        return $this->belongsToMany(EstateRequest::class, 'zoonkan_file', 'zoonkan_id', 'estate_request_id');
    }

    public function estate()
    {
        return $this->belongsToMany(EstateRequest::class, 'zoonkan_file', 'id', 'estate_request_id');
    }
}
