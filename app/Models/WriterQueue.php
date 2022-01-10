<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WriterQueue extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'last_writer_id'
    ];
}
