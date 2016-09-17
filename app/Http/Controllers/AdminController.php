<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\User ;
use App\Models\ActiveDonation ;
use App\Models\ScheduledDonation ;
use App\Models\SystemSetting ;

use Auth ;

class AdminController extends Controller
{
    public function index() {
    	$data = [
            'elite'                 => User::where('is_special_user',1)->count(),
            'members'               => User::where('is_special_user',0)->count(),
            'scheduled'             => ScheduledDonation::count(),
            'donation'             => ActiveDonation::count(),
            'admin_name'            => Auth::user()->first_name
    	] ;

    	return view( 'elite.dashboard', $data ) ;
    }

    public function login() {
        return view( 'elite.login' ) ;
    }

    public function postLogin( Request $request ) {

    	if ( Auth::attempt(['email' => $request->email, 'password' => $request->password]) ) {

            if ( Auth::user()->is_active == 0 ) {
                return redirect()->back()->withInput()->with('account_not_found', 'Your account has been blocked, please contact support for more info.') ;
            }
            if ( Auth::user()->is_special_user != 1 ) {
                return redirect()->back()->withInput()->with('account_not_found', 'Your account is not autherized fot this view, sorry dude.') ;
            }

    		return redirect()->intended('admin/dashboard') ;
    	} else {
            return redirect()->back()->withInput()->with('account_not_found', 'Invalid Credentials') ;
        }
    }

    public function users() {
        $data = [
            'members'               => User::where('is_special_user',0)->get(),
            'admin_name'            => Auth::user()->first_name
        ] ;

    	return view( 'elite.members', $data ) ;
    }

    public function elite() {
        $data = [
            'members'               => User::where('is_special_user',1)->get(),
            'admin_name'            => Auth::user()->first_name
        ] ;

    	return view( 'elite.elitemembers', $data ) ;
    }

    public function create_elite( Request $request ) {

    }

    public function scheduled() {
        $data = [
            'scheduled'             => ScheduledDonation::all(),
            'admin_name'            => Auth::user()->first_name
        ] ;

    	return view( 'elite.scheduled', $data ) ;
    }

    public function donations() {
        $data = [
            'donations'             => ActiveDonation::all(),
            'admin_name'            => Auth::user()->first_name
        ] ;

    	return view( 'elite.transactions', $data ) ;
    }
}
