<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth ;
use App\Models\ScheduledDonation ;

use App\Classes\Helper ;

class ScheduledController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('verify');
    }

    public function index() {
        $avatar                         = Helper::userAvatar( Auth::user()->id ) ;
    	$data = [
    		'scheduled'                 => ScheduledDonation::where('user_id',Auth::user()->id)->get(),
            'avatar'                    => $avatar,
    	] ;
    	return view('admin.schedules',$data) ;
    }
}
