<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $table 		= 'system_settings' ;
    public $timestamps 		= false;
    protected $fillable 	= [
    	"percentage",
    	"days",
    	"daily_reserves",
        "expiry_hours",
        "start_help_time",
        "end_help_time",
    	"count_down_hours",
    	"is_active",
    ];
}
