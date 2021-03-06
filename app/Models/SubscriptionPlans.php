<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlans extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'level',
        'icon',
        'properties',
    ];

    public function items()
    {
        return $this->hasMany(SubscriptionPlansItem::class, 'plan_id', 'id');
    }
}
