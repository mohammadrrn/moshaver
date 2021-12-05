<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'item_id',
        'amount',
        'code',
        'ref_id',
        'card_pan',
        'description',
        'status',
    ];

    public function item()
    {
        return $this->hasOne(SubscriptionPlansItem::class, 'id', 'item_id');
    }
}
