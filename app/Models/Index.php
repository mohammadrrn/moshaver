<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    use HasFactory;

    public function detail($id)
    {
        $estateRequest = EstateRequest::with('estateType')->with('direction')->where('status', 1)->findOrFail($id);
        $data = [
            'detail' => $estateRequest
        ];
        return view('site.detail', compact('data'));
    }
}
