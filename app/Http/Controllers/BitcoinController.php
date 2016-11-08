<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\BitcoinAddress ;

use App\Classes\Helper ;

use Auth ;

class BitcoinController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('verify');
    }

    public function index() {

        $data                           = [
            'name'                      => Helper::userDetails( Auth::user()->id ),
            'avatar'                    => Helper::userAvatar( Auth::user()->id ),
            'title'						=> 'BitCoin'
        ] ;

    	return view( 'admin.bitcoin', $data ) ;
    }

    public function get_bitcoin_accounts() {

    	$bitcoin_addresses = BitcoinAddress::where('user_id',Auth::user()->id)->get() ;

    	$string = "" ;

    	if ( BitcoinAddress::where('user_id',Auth::user()->id)->count() > 0 ) {
	     	foreach ( $bitcoin_addresses as $bitcoin_address ) {
	    		$string .= "
	    					<tr>
		    					<td>" . $bitcoin_address->label . "</td>
		    					<td>" . $bitcoin_address->address . "</td>" ;

	    		if ( $bitcoin_address->is_processed == 1 ) {
		    		$string .= "
		    					<td>
		                            <button class='btn btn-xs btn-success'>
		                                <i class='fa fa-check'></i>
		                            </button> 
		                        </td>" ;
		                        
	            } else {
		    		$string .= "<td>
		                            <button class='btn btn-xs btn-warning' onclick=\"activate_account('".$bitcoin_address->id."')\">
		                                <i class='fa fa-check'></i>
		                            </button> " ;
		            $string .= "
		                            <button class='btn btn-xs btn-danger' onclick=\"delete_account('".$bitcoin_address->id."')\">
		                                <i class='fa fa-trash'></i>
		                            </button>
		    					</td>
		    					
		    				   " ;
	            }
	            $string 		.= "</tr>" ;
	    	}
    	} else {
    		$string .= "
    					<tr>
	    					<td colspan=3>No bitcoin addresses found.</td>
    					</tr> " ;    		
    	}


    	return $string ;
    }

    public function add_bitcoin_account(Request $request) {

    	BitcoinAddress::where('user_id', Auth::user()->id)->update(['is_processed'=>0]) ;

    	$bitcoin_address 				= BitcoinAddress::create([
	    	"user_id"					=> Auth::user()->id,
	    	"label"						=> $request->bitcoin_label,
	    	"address" 					=> $request->bitcoin_address,
	    	"is_processed" 				=> 1,
    	]) ;

    	if ( $bitcoin_address ) {
    		return "Successfully added new bitcoin address." ;
    	} else {
    		return "Failed to add a new bitcoin address." ;
    	}
    }

    public function activate_account(Request $request) {
    	
    	BitcoinAddress::where('user_id', Auth::user()->id)->update(['is_processed'=>0]) ;

    	$bitcoin_address 				= BitcoinAddress::where('id', $request->id)->update(['is_processed'=>1]) ;

    	if ( $bitcoin_address ) {
    		return "success" ;
    	} else {
    		return "Failed to update the bitcoin address." ;
    	}
    }

    public function delete_bitcoin_account(Request $request) {
    	$bitcoin_address 				= BitcoinAddress::find($request->id) ;
    	if ( $bitcoin_address->delete() ) {
    		return "success" ;
    	} else {
    		return "Failed to remove a new bitcoin address." ;
    	}
    }
}
