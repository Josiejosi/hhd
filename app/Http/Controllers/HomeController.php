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
    }

    public function index() {
    	$is_help_time 					= Helper::is_help_time() ;
    	$help_time 						= Helper::help_time() ;
    	$max_reserves_allowed 			= Helper::reached_max_donations(Auth::user()->id) ;
    	$max_reserves_limit 			= Helper::max_reserves() ;

    	$transactions 					= ActiveDonation::where( 'receiver', Auth::user()->id )->where('donation_status',1)->get() ;

    	$data 							= [
    		'is_help_time'				=> $is_help_time,
    		'help_time'					=> $help_time,
    		'max_reserves_limit'		=> $max_reserves_limit,
    		'max_reserves_allowed'		=> $max_reserves_allowed,
    		'transactions'				=> $transactions
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

		    		return "

					<div class='portlet light bordered'>
			            <div class='portlet-title'>
			                <div class='caption'>
			                    Assigned Member 
			                </div>
			            </div>
			            <div class='portlet-body'>
							<div class='row'>
								<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<table class='table'>

						                <tbody>
						                    <tr>
						                        <td> Name </td>
						                        <td> : ". $user->first_name . " " . $user->last_name ." </td>
						                    </tr>
						                    <tr>
						                        <td> Email </td>
						                        <td> : ". $user->email ." </td>
						                    </tr>
						                    <tr>
						                        <td> Cell </td>
						                        <td> : ". $user->cell_phone ." </td>
						                    </tr>
						                    <tr>
						                        <td> Account # </td>
						                        <td> : ". $account->account_number . " </td>
						                    </tr>
						                    <tr>
						                        <td> Bank </td>
						                        <td> : ". $account->bank . " </td>
						                    </tr>
						                    <tr>
						                        <td> Branch Code </td>
						                        <td> : ". $account->branch_code . " </td>
						                    </tr>
						                    <tr>
						                        <td> Amount ZAR </td>
						                        <td> : R ". $active_donation->amount . " </td>
						                    </tr>
						                </tbody>
						            </table>
						            <input type='hidden' id='ttds' value='1'>
								</div>
							</div>
						</div>
					</div>
					<div class='col-md-4 col-sm-4 col-xs-4 col-lg-4 col-xs-offset-4 col-md-offset-4 col-sm-offset-4'>
						<button type='button' onclick='assign_me($donation_id)' id='reserve_order' class='btn green-meadow'  data-loading-text=\"<i class=\'fa fa-spinner fa-spin\'></i> Please wait.....\">Reserve</button>
					</div>
				   " ;
		    	}
	    	} 

		} else {
    		return "Sorry you already have $max_reserves_limit pending transactions, please wait for approval from assigned members to create a new one." ;
    	}

    	return "No results found between ( R ".$request->min." and R ".$request->max.")" ;
    }

    public function assign_donar( Request $request ) {
    	$id 							= $request->id ;

    	$active 						= ActiveDonation::find($id) ;

    	$max_reserves_allowed 			= Helper::reached_max_donations(Auth::user()->id) ;
    	$max_reserves_limit 			= Helper::max_reserves() ;
    	$expiry_hours 					= Helper::expiry_hours() ;

    	if ( $max_reserves_allowed == "add" ) {

	    	if ( count($active) == 1 ) {
		    	if ( $active->donation_status == 0 && $active->is_processed == 0 &&  $active->receiver != Auth::user()->id ) {

			    	$activate_donation = ActiveDonation::where('id',$id)->update([
			    		'is_processed'		=> 1,
			    		'sender'			=> Auth::user()->id,
			    		'donation_status'	=> 1,
			    		'booked_at'			=> Carbon::now(),
			    	]);

			    	//queue sender's email to tel them it was successfull and how long it wil take to get it removed from reserved and donation details.
			    	$receiver_id 			= $active->receiver ;
			    	$receiver_amount		= $active->amount ;
			    	$receiver_details 		= User::where('id',$receiver_id)->first() ;
			    	$receiver_bank_details 	= Account::where('user_id', $receiver_id )->where('active_account',1)->first() ;
			    	$expiry_time 			= Carbon::now()->addHour($expiry_hours)->setToStringFormat('jS \o\f F, Y g:i a') ;

			    	$message 				= "
			    							
			    								<br />
			    								You have successfully being assigned to HELP, Details are as follows:<br/><br/>
			    								<br />
			    								<table border=0 cellpadding=5 cellspacing=0>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Account Holder</td>
			    									<td align=right> : ".$receiver_details->first_name . " " .$receiver_details->last_name."</td>
			    								</tr>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Holder' Email</td>
			    									<td align=right> : ".$receiver_details->email."</td>
			    								</tr>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Holder's Cell Phone</td>
			    									<td align=right> : ".$receiver_details->cell_phone."</td>
			    								</tr>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Bank</td>
			    									<td align=right> : ".$receiver_bank_details->bank."</td>
			    								</tr>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Account Number</td>
			    									<td align=right> : ".$receiver_bank_details->account_number."</td>
			    								</tr>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Branch Code</td>
			    									<td align=right> : ".$receiver_bank_details->branch_code."</td>
			    								</tr>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Amount</td>
			    									<td align=right> : R ".$receiver_amount."</td>
			    								</tr>
			    								</table>
			    								<strong>NOTE: Failure to make payment before $expiry_time, This member will be unassigned to you and failure to make payment to 2 assigned members will result in your account blocked for 3 months</strong>
			    								<br /><br />
			    								Warm Regards,<br />
			    								PrestigeWallet.com

			    							  " ;

			    	$user_reserved_info 	= [
			    		'to_email'			=> Auth::user()->email,
			    		'subject'			=> "PrestigeWallet HELP Request",
			    		'to_name'			=> Auth::user()->first_name ." ".Auth::user()->last_name,
			    		'message'			=> $message,
			    	] ;

					$job = (new SendDonationDetails($user_reserved_info))->onQueue('SendDonationDetails') ;
			        $this->dispatch($job) ;

			    	//send the receiver an email to inform them they have been reserved by hu
			    	$message 				= "Hi ".$receiver_details->first_name . " " .$receiver_details->last_name."
			    								<br /><br />
			    								".Auth::user()->first_name ." ".Auth::user()->last_name." was assigned to you for an amount of R ".$receiver_amount.", Please ensure you go to the online app to accept their HELP once the money reflects on your account.
			    								<strong>NOTE: Failure to accept payments will result in your account blocked for 3 months, if the HELPER reports you for delaying acknowledgment of receiving payments</strong>
			    								<br /><br />
			    								Warm Regards,<br />
			    								PrestigeWallet.com
			    							  " ;
			    	$user_reserved_info 	= [
			    		'to_email'			=> $receiver_details->email,
			    		'subject'			=> "You have been assigned to a member",
			    		'to_name'			=> $receiver_details->first_name . " " .$receiver_details->last_name,
			    		'message'			=> $message,
			    	] ;
					$job = (new UserMadeDonation($user_reserved_info))->onQueue('UserMadeDonation') ;
			        $this->dispatch($job) ;
			    	//check if any timer's pending for this user

			    	//if any timer's get all

			    	//build timer's for user to see staging period

		    		return 'success' ;   		
		    	} else {
		    		return "Sorry please try a different range as a member has already been assigned to the selected individual" ;
		    	}
	    	} else {
	    		return "failed" ;
	    	}

    	} else {
    		//return "PrestigeWallet.com only allow you a max help limit of " .$max_reserves_limit." a day." ;
    		return "Sorry you already have $max_reserves_limit pending transactions, please wait for approval from assigned members to create a new one." ;
    	}

    }

    public function get_latest_feed( Request $request ) {
		$transactions 					= ActiveDonation::where( 'receiver', $request->id )->where('donation_status',1)->get() ; 

		$string_transactions 			= "<li><div class='col1'><div class='desc'>No dreams to approve.</div></div></li>" ;

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
}
