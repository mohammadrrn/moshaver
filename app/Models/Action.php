<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'request_id',
        'request_model',
        'action_type',
        'description',
    ];

    public function writer()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
