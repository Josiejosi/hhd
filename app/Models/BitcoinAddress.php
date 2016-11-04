<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BitcoinAddress extends Model
{
    protected $table 		= 'bitcoin_addresses' ;
    public $timestamps 		= false;
    protected $fillable 	= [
    	"user_id",
    	"label",
    	"address",
    ];
}
