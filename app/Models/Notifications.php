<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table 		= 'notification' ;
    public $timestamps 		= false;
    protected $fillable 	= [
    	"user_id",
    	"message",
    	"type",
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
