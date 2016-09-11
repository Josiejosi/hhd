<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth ;
use App\Models\ScheduledDonation ;

class ScheduledController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('verify');
    }

    public function index() {
    	$data = [
    		'scheduled'=>ScheduledDonation::where('user_id',Auth::user()->id)->get()
    	] ;
    	return view('admin.schedules',$data) ;
    }
}
