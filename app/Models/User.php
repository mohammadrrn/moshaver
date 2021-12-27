<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'real_estate_name',
        'full_name',
        'mobile_number',
        'mac_address',
        'national_code',
        'email',
        'password',
        'status',
        'address',
        'score',
        'area_id',
        'trusted_office'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function plan()
    {
        return $this->belongsToMany(SubscriptionPlans::class, 'subscriptions', 'user_id', 'plan_id');
    }

    public function item()
    {
        return $this->belongsToMany(SubscriptionPlansItem::class, 'subscriptions', 'user_id', 'item_id');
    }

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    public function estateRequest()
    {
        return $this->hasMany(EstateRequest::class, 'user_id', 'id');
    }
}
