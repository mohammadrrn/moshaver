<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'item_id',
        'expiry_date',
    ];

    public function plan()
    {
        return $this->hasOne(SubscriptionPlans::class, 'id', 'plan_id');
    }

    public function item()
    {
        return $this->hasOne(SubscriptionPlansItem::class, 'id', 'item_id');
    }
}
