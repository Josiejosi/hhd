<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledDonation extends Model
{
    protected $table 		= 'scheduled_donations' ;
    public $timestamps 		= false;
    protected $dates 		= ['schedule_at', 'schedule_for'];
    protected $fillable 	= [
    	"user_id",
    	"schedule_percentage",
    	"schedule_at",
    	"schedule_for",
    	"schedule_days",
    	"amount",
    ];
}
