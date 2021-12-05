<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmarks extends Model
{
    use HasFactory;

    protected $fillable = [
        'estate_request_id',
        'user_id'
    ];

    public function estate()
    {
        return $this->belongsToMany(EstateRequest::class, 'bookmarks', 'id', 'estate_request_id');
    }
}
