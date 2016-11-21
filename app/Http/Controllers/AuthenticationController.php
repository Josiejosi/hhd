<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth ;
use App\Models\User ;
use App\Models\Account ;
use App\Models\BitcoinAddress ;
use App\Models\Referral ;

use Validator ;
use Session ;

use App\Classes\Helper ;
use App\Jobs\UserHasRegistered ;

use Carbon\Carbon ;

class AuthenticationController extends Controller
{
    public function signup( Request $request ) {

        $validator 						= Validator::make($request->all(), [
            'first_name' 				=> 'required',
            'last_name'		 			=> 'required',
            'email' 					=> 'required|unique:users|max:255|email',
            'cell_phone' 				=> 'required|unique:users|digits_between:10,15',
            'password' 					=> 'required|confirmed|max:15|min:6',
            'password_confirmation' 	=> 'required',
            'account_number' 			=> 'required|unique:accounts|digits_between:5,20',
            'account_name' 				=> 'required',
            'branch_code' 				=> 'required',
            'dob'                       => 'required',
            'country'                   => 'required', 
        ]);


        if ($validator->fails()) {
            return redirect('signup')
                        ->withErrors($validator)
                        ->withInput();
        }

        $verification_code                  = mt_rand( 111111, 999999 ) ;
        $refferal_key    				    = mt_rand( 111111, 999999 ) ;

        $user  							    = User::create([

	        'first_name'				    => $request->first_name, 
	        'last_name'					    => $request->last_name, 
	        'email'						    => $request->email, 
	        'cell_phone'				    => $request->cell_phone, 
	        'avatar'					    => "avatar.png", 
	        'timezone'					    => "Africa/Johannesburg", 
	        'is_special_user'			    => 0, 
	        'is_verified'				    => 0, 
            'branch_code'                   => $request->branch_code,
            'dob'                           => $request->dob,
            'country'                       => $request->country, 
            'verification_code'             => $verification_code, 
	        'refferal_key'			        => $refferal_key, 
            'ip_address'                    => $request->ip(), 
            'user_agent'                    => $request->header('User-Agent'), 
	        'password'					    => bcrypt($request->password),
            'is_active'                     => 1,

        ]) ;						

        if ( $user ) {
        	$account 					     = Account::create([
		   		"branch_code"			     => $request->branch_code,
		    	"bank"					     => $request->account_name,
		    	"account_number"		     => $request->account_number,
		    	"active_account"		     => 1,
		    	"user_id"				     => $user->id,
        	]) ;

            $bitcoin_Address                = BitcoinAddress::create([
                "user_id"                   => $user->id,
                "label"                     => "Default Address",
                "address"                   => $request->bitcoin_address,
            ]) ;

            if ( isset( $request->referral_key ) ) {

                if ( User::where('refferal_key', $request->referral_key)->count() == 1 ) {
                    $referred_user          = User::where('refferal_key', $request->referral_key)->first() ;
                    $key                    = $referred_user->refferal_key ;
                    $new_user_from_referred = $referred_user->id ;

                    if ( Referral::where('referrer_id', $user->id)->where('referred_id', $new_user_from_referred)->count() == 0 ) {
                        Referral::create([
                            "referrer_id"   => $new_user_from_referred,
                            "referred_id"   => $user->id,
                            "paid"          => 0,
                            "amount"        => 0.00,
                            "join_at"       => Carbon::now(),
                        ]) ;
                    }
                }
            }

		    if ( Auth::attempt(['email' => $request->email, 'password' => $request->password]) ) {

                $url                     = url( '/signup/' . $refferal_key ) ;
                $job = (new UserHasRegistered($user, $verification_code, $refferal_key, $request->password))->onQueue('hhdRegister');
                $this->dispatch($job);

		    	return redirect()->intended( 'home' ) ;
	        }

	        return redirect()->back()->withInput() ;
        }
    	
    }

    public function signin(Request $request) {

	    if ( Auth::attempt(['email' => $request->username, 'password' => $request->password]) ) {
            
            if ( Auth::user()->is_active == 0 ) {
                Session::flash('account_not_found', 'Your account has been blocked, please contact support for more info.') ;
                return redirect()->back()->withInput() ;
            }

	    	return redirect()->intended( 'home' ) ;

        } else {
        	Session::flash('account_not_found', 'Wrong login credentials, please try again') ;
        	return redirect()->back()->withInput() ;
        }
    }


    public function forgot(Request $request) {

        $validator 						= Validator::make($request->all(), [
            'email' 					=> 'required|email',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    	if ( User::where('email',$request->email)->count() == 1 ) {

    		$password 					= rand( 111111, 666666 ) ;

            $user                       = User::where('email',$request->email)->first() ;

	        $user_affected  			= User::where( 'email', $request->email )->update([
		        'password'				=> bcrypt($password)
	        ]) ;

		    if ( $user_affected ) {
	    	Helper::send_mail( 
	    		$request->email, 
	    		"Password Changed", 
	    		$user->first_name . " " . $user->last_name , 
	    		"We have noticed you change your password:<br />Username: " . $request->email . "<br />New Password: " . $password, 
	    		"emails.confirm",
	    		true 
	    	) ;
	    	Session::flash('account_not_found', 'Please check your emails for a new pasword') ;
	    	return redirect()->back() ;
	        } else {
	        	Session::flash('account_not_found', 'Not a valid email you provided') ;
	        	return redirect()->back();
	        }

    	} else {
            Session::flash('account_not_found', 'Sorry we dont have this account on our system, please try to register with it.') ;
            return redirect()->back() ;           
        }

    }

    public function logout() {
    	Auth::logout() ;
    	return redirect('/') ;
    }
}
