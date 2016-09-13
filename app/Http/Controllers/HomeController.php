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
    	$pending_donations 				= Helper::getPendingTime(Auth::user()->id);
    	$alltransactions 				= Helper::getAllMyTransctions(Auth::user()->id) ;
    	$now							= Carbon::now() ;

    	$transactions 					= ActiveDonation::where( 'receiver', Auth::user()->id )->where('donation_status',1)->get() ;

    	$data 							= [
    		'is_help_time'				=> $is_help_time,
    		'help_time'					=> $help_time,
    		'max_reserves_limit'		=> $max_reserves_limit,
    		'max_reserves_allowed'		=> $max_reserves_allowed,
    		'transactions'				=> $transactions,
    		'alltransactions'			=> $alltransactions,
    		'now'						=> $now,
    	] ;

    	return view( 'admin.home', $data ) ;
    }

    public function get_donar( Request $request ) {
    	$active_donation_count 			= ActiveDonation::where( 'is_processed', 0 )
    										->where('receiver','!=', Auth::user()->id)
    										->whereBetween('amount', [$request->min, $request->max])
    										->orderBy('id')
    										->count() ; 
    	$active_donation 				= [] ; 

    	$max_reserves_allowed 			= Helper::reached_max_donations(Auth::user()->id) ;
    	$max_reserves_limit 			= Helper::max_reserves() ;
    	
    	if ( $max_reserves_allowed == 'add' ) {
    		
	    	if ( $active_donation_count > 1 ) {
	    		$active_donation 		= ActiveDonation::where( 'is_processed', 0 )
	    									->where('receiver','!=', Auth::user()->id)
	    									->whereBetween('amount', [$request->min, $request->max])
	    									->orderBy('id')
	    									->get()->random(1) ;

		    	$account 				= Helper::get_user_active_account( $active_donation->receiver ) ;

		    	$user 					= User::find($active_donation->receiver) ;

		    	$user_data 				= "" ;

		    	$donation_id 			= $active_donation->id ;

		    	if ( count($user) == 1 ) {

		    		return [
		    			'message' 		=> 'found',
		    			'min'			=> $request->min,
		    			'max'			=> $request->max,
		    			'user_id'		=> $user->id
		    		] ;
		    	}
	    	} 

		} else {
    		return [
		    	'message' 		=>  "Sorry you already have $max_reserves_limit donations made today, please wait for approval from assigned members to create a new one." 
		    ] ;
    	}

    	return [
		    'message' 		=>  "No results found between ( R ".$request->min." and R ".$request->max.")" 
		] ;
    }
    //change to confirm
    public function assign_donar( Request $request ) {
    	$min 							= $request->min ;
    	$max 							= $request->max ;
    	$user_id 						= $request->user_id ;

    	$max_reserves_allowed 			= Helper::reached_max_donations(Auth::user()->id) ;
    	$max_reserves_limit 			= Helper::max_reserves() ;

    	if ( $max_reserves_allowed == "add" ) {

			Helper::assignMember( Auth::user()->id, $min, $max ) ;

			$account 					= Helper::get_user_active_account( $user_id ) ;
			
			return [
				'message'				=> 'success', 
				'bank'					=> $account->bank, 
				'account'				=> $account->account_number, 
				'branch'				=> $account->branch_code, 
			] ;  

    	} else {
    		return [
    			'message'=>"Sorry you already have reached your daily donation limit of $max_reserves_limit, please wait for approval from assigned members to create a new one." 
    		];
    	}

    }

    public function get_latest_feed( Request $request ) {
		$transactions 					= ActiveDonation::where( 'receiver', $request->id )->where('donation_status',1)->get() ; 

		$string_transactions 			= "<li><div class='col1'><div class='desc'>No donations to approve.</div></div></li>" ;

		$i 								= 1 ;

		if ( ActiveDonation::where( 'receiver', $request->id )->where('donation_status',1)->count() > 0 ) {

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
						                                	class='btn btn-sx btn-success'
						                                	id='approve$i'
						                                	onclick=\"approve( '$i', '$id' )\"
						                                	>Approve</button>
						                            </div>
						                        </li>
											   " ;

				$i++ ;
			}

		}

		return $string_transactions ;
		
    }

    public function get_reffered_users_count() {

    }
}
