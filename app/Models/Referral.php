<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $table 		= 'referrals' ;
    public $timestamps 		= false;
    protected $dates 		= ['join_at'];
    protected $fillable 	= [
    	"referrer_id",
    	"referred_id",
    	"join_at",
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
