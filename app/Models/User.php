<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'cell_phone', 
        'avatar', 
        'timezone', 
        'is_special_user', 
        'is_verified', 
        'verification_code', 
        'refferal_key', 
        'ip_address', 
        'user_agent', 
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function accounts()
    {
        return $this->hasMany('App\Models\Account');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notifications');
    }

    public function referrals()
    {
        return $this->hasMany('App\Models\Notifications');
    }
}
