<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth ;
use App\Models\Account ;

class AccountsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
    	return view( 'admin.accounts' ) ;
    }    

    public function get_account() {
    	$accounts = Account::where('user_id',Auth::user()->id)->get();

    	$string = "" ;

    	foreach ( $accounts as $account ) {

    		//if ( $account->active_account == 1 )activate_account


    		$string .= "
    					<tr>
	    					<td>".$account->bank."</td>
	    					<td>".$account->account_number."</td>
	    					<td>".$account->branch_code."</td>
    					<td> " ;
    		if ( $account->active_account == 1 ) {
    		$string .= "
                            <button class='btn btn-xs btn-success'>
                                <i class='icon-check'></i>
                            </button> " ;
            } else {
    		$string .= "
                            <button class='btn btn-xs btn-warning' onclick=\"activate_account('".$account->id."')\">
                                <i class='icon-check'></i>
                            </button> " ;
            $string .= "
                            <button class='btn btn-xs btn-danger' onclick=\"delete_account('".$account->id."')\">
                                <i class='icon-trash'></i>
                            </button>
    					</td>
    					</tr>
    				   " ;
                    }
    	}
    	return $string ;
    }

    public function addAccount(Request $request) {

    	$acc_num 			= $request->account_number ;
    	$acc_name 			= $request->account_name ;
    	$b_code 			= $request->branch_code ;

    	$accounts 			= Account::where('user_id',Auth::user()->id)->count() ;

    	if ( $accounts < 4 ) {
	    	if ( Account::create(['bank'=>$acc_name,'account_number'=>$acc_num,'branch_code'=>$b_code, 'user_id'=>Auth::user()->id]) ) {
	    		
	    		return "success" ;
	    	} else {
	    		return "Failed to add a new account" ;
	    	}    		
    	} else {
    		return "Sorry but you already have 3 accounts" ;
    	}
    }

    public function updateAccount(Request $request) {
    	$account_id 			= $request->account_id ;

    	if ( Account::where('user_id',Auth::user()->id)->update([
    		'active_account' => 0,
    	]) ) {

	    	if ( Account::where('user_id',Auth::user()->id)->where('id', $account_id)->update([
	    		'active_account' => 1,
	    	]) ) {
	    		return "success" ;
	    	} else {
	    		return "Failed to make this account a primary account, please try again" ;
	    	}

    	} else {
    		return "Something went wrong, please try again later." ;
    	}

    }

    public function deleteAccount(Request $request) {
    	$account_id 			= $request->account_id ;

    	$account 				= Account::find($account_id) ;

    	if ( $account->delete() )
    		return 'success' ;
    	else 
    		return "Failed to delete account." ;
    }
}
