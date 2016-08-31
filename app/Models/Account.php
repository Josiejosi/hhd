<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table 		= 'accounts' ;
    public $timestamps 		= false;
    protected $fillable 	= [
    	"branch_code",
    	"bank",
    	"account_number",
        "active_account",
    	"user_id",
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
