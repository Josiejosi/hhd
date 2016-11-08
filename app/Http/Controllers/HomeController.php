<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth ;
use App\Models\User ;
use App\Models\Account ;
use App\Models\ActiveDonation ;

use App\Classes\Helper ;

use Session ;
use Validator ;

use Carbon\Carbon ;

use App\Jobs\SendDonationDetails ;
use App\Jobs\UserMadeDonation ;

class HomeController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('verify');
    }

    public function index() {
    	$is_help_time 					= Helper::is_help_time() ;
    	$help_time 						= Helper::help_time() ;
    	$max_reserves_allowed 			= Helper::reached_max_donations(Auth::user()->id) ;
    	$max_reserves_limit 			= Helper::max_reserves() ;
    	
    	$alltransactions 				= Helper::getAllMyTransctions(Auth::user()->id) ;
    	$expiry_hour 					= Helper::expiryHour() ;
    	$now							= Carbon::now() ;

        $transactions                   = ActiveDonation::where( 'receiver', Auth::user()->id )->where('donation_status',1)->get() ;
        $paid                           = 0.00 ;

        if (ActiveDonation::where( 'sender', Auth::user()->id )->where('donation_status',2)->count() > 0 )
    	   $paid 					    = ActiveDonation::where( 'sender', Auth::user()->id )->where('donation_status',2)->sum( "amount" ) ;

    	$data 							= [
    		'is_help_time'				=> $is_help_time,
    		'help_time'					=> $help_time,
    		'max_reserves_limit'		=> $max_reserves_limit,
    		'max_reserves_allowed'		=> $max_reserves_allowed,
            'transactions'              => $transactions,
    		'paid'				        => $paid,
    		'alltransactions'			=> $alltransactions,
    		'now'						=> $now,
    		'expiry_hour'				=> $expiry_hour,
            'name'                      => Helper::userDetails( Auth::user()->id ),
            'avatar'                    => Helper::userAvatar( Auth::user()->id ),
            'title'                     => 'Dashboard',
    	] ;

    	return view( 'admin.home', $data ) ;
    }

    public function get_donar( Request $request ) {

    	$max_reserves_allowed 			= Helper::reached_max_donations(Auth::user()->id) ;
    	$max_reserves_limit 			= Helper::max_reserves() ;
    	
    	if ( $max_reserves_allowed == 'add' ) {
			$donations 					= Helper::getActiveDoneeUnderSameAccount( 
											Auth::user()->id, 
											$request->requested_amount 
			) ;
			return $donations ;
		} else {
    		return [
		    	'message' 				=>  "Sorry you already have $max_reserves_limit funds made, Pleas note you can only fund 2 memebers a month ." 
		    ] ;
    	}
    }
    //change to confirm
    public function assign_donar( Request $request ) {
    	$order_id 						= $request->tid ;
    	$donee_id 						= $request->user_id ;
    	$amount 						= $request->amount ;

    	$max_reserves_allowed 			= Helper::reached_max_donations(Auth::user()->id) ;
    	$max_reserves_limit 			= Helper::max_reserves() ;

    	if ( $max_reserves_allowed == "add" ) {

			Helper::assignMember( Auth::user()->id, $order_id, $donee_id, $amount ) ;

			$account 					= Helper::get_user_active_account( $donee_id ) ;
			
			return [
				'message'				=> 'success', 
				'bank'					=> "Netbank", 
				'account'				=> rand(11111111, 9999999), 
				'branch'				=> rand(11111, 99999), 
			] ;  

    	} else {
    		return [
    			'message'=>"Sorry you already have reached your daily funds limit of $max_reserves_limit, Pleas note you can only fund 2 memebers a month." 
    		];
    	}

    }

    public function get_latest_feed( Request $request ) {
		$transactions 					= ActiveDonation::where( 'receiver', $request->id )->where('donation_status',1)->get() ; 

		$string_transactions 			= "<ol><li><div class='col1'><div class='desc'>No donations to approve.</div></div></li></ol>" ;

		$i 								= 1 ;

		if ( ActiveDonation::where( 'receiver', $request->id )->where('donation_status',1)->count() > 0 ) {
            $string_transactions            = "<ol>" ;
			foreach ( $transactions as $transaction ) {
				$sender 					= $transaction->sender ;
				$amount 					= $transaction->amount ;
				$user 						= User::find( $sender ) ;

				$name 						= $user->first_name . " " . $user->last_name ;

				$id 						= $transaction->id ;

				//approve

				$string_transactions 		.= "
												<li>
						                            <div class='col1'>
						                                <div class='cont'>
						                                    <div class='cont-col2'>
						                                        <div class='desc'> 
						                                        	$name, R $amount
						                                        </div>
						                                    </div>
						                                </div>
						                            </div>
						                            <div class='col2'>
						                                <button 
						                                	class='btn btn-xs btn-success'
						                                	id='approve$i'
						                                	onclick=\"approve( '$i', '$id' )\"
						                                	>Approve</button>
						                            </div>
						                        </li>
											   " ;

				$i++ ;
			}
            $string_transactions            .= "</ol>" ;
		}

		return $string_transactions ;
		
    }

    public function get_reffered_users_count() {

    }

    public function pending_times() {
		return Helper::getPendingTime(Auth::user()->id) ;
    }
}
