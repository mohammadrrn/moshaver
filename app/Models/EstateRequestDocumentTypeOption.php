<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstateRequestDocumentTypeOption extends Model
{
    use HasFactory;

    protected $table = 'estate_request_document_type_option';
    protected $fillable = [
        'text'
    ];
}
