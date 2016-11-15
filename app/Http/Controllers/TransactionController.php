<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\ActiveDonation ;
use App\Models\ScheduledDonation ;
use App\Models\User ;
use App\Models\Referral ;

use App\Classes\Helper ;

use Auth ;

use Carbon\Carbon ;

use App\Jobs\DonationHasBeenAcceptedByReceiver ;


class TransactionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('verify');
    }
    
    public function index() {
    	
    	$transactions 					= ActiveDonation::where( 'receiver', Auth::user()->id )->where('donation_status',1)->get() ;
    	$data 							= [	
            'transactions'	            => $transactions,
            'name'                      => Helper::userDetails( Auth::user()->id ),
            'avatar'                    => Helper::userAvatar( Auth::user()->id ), 
            'title'                     => 'Transactions',
        ] ;

    	return view('admin.transactions',$data) ;
    }

    public function withdrawal( Request $request ) {
        $withdrawal                     = $request->withdrawal ;

        if ( $withdrawal == "bonuses" ) {

            if ( Referral::where('referrer_id', Auth::user()->id)->count() > 0 ) {
                $referral_bonuses       = Referral::where('referrer_id', Auth::user()->id)->sum( "amount" ) ; 

                if ( $referral_bonuses < 1000 ) {
                    return [
                        'message'           => 'Your referral bonuses have not yet matured',  
                    ] ;                    
                }

                //
                Referral::where('referrer_id', Auth::user()->id)->update([
                    'amount'            => 0.00,
                ]) ;
                return [
                    'message'           => 'found',  
                ] ; 
            } else {
                 return [
                    'message'           => 'Your referral bonuses have not yet matured',  
                ] ;                
            } 

        } else if ( $withdrawal == "funds" ) {
            if ( ScheduledDonation::where('user_id', Auth::user()->id)->count() > 0 ) {
                $scheduled_donation         = ScheduledDonation::where('user_id', Auth::user()->id)->sum( "amount" ) ;
                return [
                    'message'           => 'found',  
                    'amount'            => $scheduled_donation,  
                ] ;
            } else {
                return [
                    'message'           => 'Ops, Nothing to withdraw, create a fund first and wait for its maturity.',   
                ] ;                
            }

        }

    }
    public function approve_order( Request $request ) {

    	$id 							= $request->id ;
    	
    	$active_donation 				= ActiveDonation::where('id',$id)->first() ;

        $expiry_hours                   = Helper::expiry_hours() ;
    	//echo $id ;
    	$donation_percentage 			= $active_donation->donation_percentage ;
    	$donation_days 					= $active_donation->donation_days ;
    	$sender 						= $active_donation->sender ;
    	$amount 						= $active_donation->amount ;

    	$user 							= User::find($sender) ;

    	$update 						= ActiveDonation::where('id',$id)->update(['donation_status' => 2]) ;

    	if ( $update ) {
    		$insert 					= ScheduledDonation::create([
		    	"user_id"				=> $sender,
		    	"schedule_percentage"	=> $donation_percentage,
		    	"schedule_at"			=> Carbon::now(),
		    	"schedule_for"			=> Carbon::now()->addDays($donation_days),
		    	"schedule_days"			=> $donation_days,
		    	"amount"				=> ( $amount * ($donation_percentage / 100) ) + $amount,
    		]) ;

    		if ( $insert ) {

                if ( Helper::getForRefferedFirstDonation($sender) != false ) {
                    $paid_referral      = Helper::updateRefferedPaid($sender, ( $amount * 0.05 ) ) ;
                }

    			$scheduled_at 			= Carbon::now()->addDays($expiry_hours)->setToStringFormat('jS \o\f F, Y g:i a') ;
    			$scheduled_amount 		= ( $amount * $donation_percentage / 100 ) + $amount ;
    			//$user 					= User::find(Auth::user()->id) ;
    			$scheduled_for 			= Carbon::now()->addDays($donation_days) ;
		    	$message 				= "<br />
		    								<p>Your donation has been approved, your funds will be withdraw-able as from: $scheduled_for<br/>:
		    								<br />
		    								<table border=0 cellpadding=5 cellspacing=0>
		    								<tr>
		    									<td align=right bgcolor=#E0FFFF>Amount</td>
		    									<td align=right> : R $scheduled_amount</td>
		    								</tr>
		    								</table>

		    								<br /><br />
		    								Warm Regards,<br />
		    								HoldingHandsDonations.com" ;

                $sms_message            = "Your donation has been approved you are scheduled for: $scheduled_for:  
                                            Amount: R $scheduled_amount" ;

		    	$user_reserved_info 	= [
		    		'to_email'			=> $user->email,
		    		'subject'			=> "Donation has been approved",
		    		'to_name'			=> $user->first_name ." ". $user->last_name,
		    		'message'			=> $message,
                    'cell_phone'        => $user->cell_phone,
                    'sms_message'       => $sms_message,
		    	] ;

                Helper::send_mail( 
                    $user->email, 
                    "Donation has been approved", 
                    $user->first_name ." ". $user->last_name, 
                    $message, 
                    'emails.confirm' 
                ) ;

/*				$job = (new DonationHasBeenAcceptedByReceiver($user_reserved_info))->onQueue('DonationHasBeenAcceptedByReceiver') ;
		        $this->dispatch($job) ;*/
    			return "success" ;
    		} else {
    			return "Something went wrong, please try again later, if this problem persists, please contact support." ;
    		}
    	} else {
    		return "Something went wrong, please try again later, if this problem persists, please contact support." ;
    	}
    }
}
