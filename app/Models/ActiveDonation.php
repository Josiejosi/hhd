<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveDonation extends Model
{
    protected $table 		= 'active_donations' ;
    public $timestamps 		= false;
    protected $dates 		= ['created_at'];
    protected $fillable 	= [
    	"receiver",
    	"sender",
    	"amount",
    	"created_at",
    	"donation_percentage",
    	"donation_days",
    	"donation_status",
    	"is_processed",
    ];
}
