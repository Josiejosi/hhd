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

class HomeController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
    	return view('admin.home') ;
    }

    public function get_donar( Request $request ) {
    	$active_donation 		= ActiveDonation::where( 'is_processed', 0 )
    								->where('receiver','!=', Auth::user()->id)
    								->where('is_processed', 0)
    								->whereBetween('amount', [$request->min, $request->max])
    								->orderBy('id')
    								->get()->random(1) ;


    	if ( count($active_donation) == 1 ) {
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
					                        <td> Account Type </td>
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
					<button type='button' onclick='assign_me($donation_id)' id='reserve_order' class='btn green-meadow'>Reserve</button>
				</div>
			   " ;
	    	}
    	}

    	return "No results found between ( R ".$request->min." and R ".$request->max.")" ;
    }

    public function assign_donar( Request $request ) {
    	$id 						= $request->id ;
    	$active 					= ActiveDonation::find($id) ;

    	if ( 
    			$active->donation_status == 0 && 
    			$active->is_processed == 0 &&
    			 $active->receiver != Auth::user()->id 
    		) {
	    	$active->is_processed 		= 1 ;
	    	$active->sender 			= Auth::user()->id ;
	    	$active->donation_status 	= 1 ;
	    	$active->save() ;
	    	//$active  = ActiveDonation::where('id',$id)
    		echo "success" ;    		
    	} else {
    		echo "failed" ;
    	}
    }
}
