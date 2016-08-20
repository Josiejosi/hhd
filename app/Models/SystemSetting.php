<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $table 		= 'system_settings' ;
    public $timestamps 		= false;
    //protected $dates 		= ['schedule_at', 'schedule_for'];
    protected $fillable 	= [
    	"percentage",
    	"days",
    	"is_active",
    ];
}
