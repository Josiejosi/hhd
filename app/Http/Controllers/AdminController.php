<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\User ;
use App\Models\BitcoinAddress ;
use App\Models\ActiveDonation ;
use App\Models\ScheduledDonation ;
use App\Models\SystemSetting ;
use App\Models\Account ;

use App\Jobs\BlockedUser ;

use App\Jobs\UserHasRegistered ;

use Validator ;

use App\Classes\Helper ;
use Carbon\Carbon ;

use Auth ;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth') ;
    }

    public function index() {
        $data = [
            'elite'                 => User::where('is_special_user',1)->count(),
            'elite_members'         => User::where('is_special_user',1)->get(),
            'members'               => User::where('is_special_user',0)->count(),
            'scheduled'             => ScheduledDonation::count(),
            'donation'              => ActiveDonation::count(),
            'admin_name'            => Auth::user()->first_name,
        ] ;

        return view( 'elite.dashboard', $data ) ;
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


    public function scheduled() {
        $data = [
            'scheduled'             => ScheduledDonation::all(),
            'admin_name'            => Auth::user()->first_name
        ] ;

    	return view( 'elite.scheduled', $data ) ;
    }

    public function settings() {
        $data = [
            'settings'             => SystemSetting::where('is_active', 1)->first(),
            'admin_name'            => Auth::user()->first_name
        ] ;

    	return view( 'elite.system', $data ) ;
    }

    public function donations() {
        $data = [
            'donations'             => ActiveDonation::all(),
            'admin_name'            => Auth::user()->first_name
        ] ;

        return view( 'elite.transactions', $data ) ;
    }

    public function create_elite() {
        $data = [
            'admin_name'            => Auth::user()->first_name
        ] ;

        return view( 'elite.add_elitemember', $data ) ;        
    }

    public function postElite( Request $request ) {

        $validator                      = Validator::make($request->all(), [
            'first_name'                => 'required',
            'last_name'                 => 'required',
            'email'                     => 'required|unique:users|max:255|email',
            'cell_phone'                => 'required|unique:users|digits_between:10,15',
            'password'                  => 'required|confirmed|max:15|min:6',
            'password_confirmation'     => 'required',
            'account_number'            => 'required|unique:accounts|digits_between:5,20',
            'account_name'              => 'required',
            'branch_code'               => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $verification_code                  = mt_rand( 111111, 999999 ) ;
        $refferal_key                       = mt_rand( 111111, 999999 ) ;

        $user                               = User::create([

            'first_name'                    => $request->first_name, 
            'last_name'                     => $request->last_name, 
            'email'                         => $request->email, 
            'cell_phone'                    => $request->cell_phone, 
            'avatar'                        => "avatar.png", 
            'timezone'                      => "Africa/Johannesburg", 
            'is_special_user'               => 1, 
            'is_verified'                   => 1, 
            'verification_code'             => $verification_code, 
            'refferal_key'                  => $refferal_key, 
            'ip_address'                    => $request->ip(), 
            'user_agent'                    => $request->header('User-Agent'), 
            'password'                      => bcrypt($request->password),
            'is_active'                     => 1,
                'dob'               => "1988-02-02",
                'country'           => "ZAR",

        ]) ;                            

        if ( $user ) {
            $account                         = Account::create([
                "branch_code"                => $request->branch_code,
                "bank"                       => $request->account_name,
                "account_number"             => $request->account_number,
                "active_account"             => 1,
                "user_id"                    => $user->id,
            ]) ;

            $bitcoin_Address                = BitcoinAddress::create([
                "user_id"                   => $user->id,
                "label"                     => "Default Address",
                "address"                   => $request->bitcoin_address,
            ]) ;


            if ( Auth::attempt(['email' => $request->email, 'password' => $request->password]) ) {
                Helper::add_notification( "You have successfully been added as an elite member", $user->id, 0 ) ;
                $job = (new UserHasRegistered($user, $verification_code, $refferal_key, $request->password))->onQueue('UserHasRegistered');
                $this->dispatch($job);
                return redirect()->back()->with('message', 'Successfully added!') ;
            }

            return redirect()->back()->withInput() ;
        }

    }

    public function postEliteDonation( Request $request ) {

        $validator                      = Validator::make($request->all(), [
            'email'                     => 'required',
            'amount'                    => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput() ;
        }

        if ( $request->has('email') || $request->has('amount') ) {
            $donation                =  ActiveDonation::create([
                "receiver"           => $request->email,
                "sender"             => 0,
                "amount"             => $request->amount,
                "created_at"         => Carbon::now(),
                "booked_at"          => "",
                "donation_percentage"=> Helper::getActiveSetting()->percentage,
                "donation_days"      => Helper::getActiveSetting()->days,
                "donation_status"    => 0,
                "is_processed"       => 0,
            ]);

            if ( $donation ) {
                return redirect()->back()->with('message', 'Successfully added!') ;
            } else {
                return redirect()->back()->withInput()->with('message', 'Failed!') ;
            }

        } else {
          return redirect()->back()->withInput()->with('error', 'Please select a member and assign an amount to member.') ; 
        }
    }

    public function postSettings( Request $request ) {
        $settings                =  SystemSetting::where('is_active',1)->update([
            "percentage"        => $request->percentage,
            "days"              => $request->days,
            "daily_reserves"    => $request->daily_reserves,
            "expiry_hours"      => $request->expiry_hours,
            "start_help_time"   => $request->start_help_time,
            "end_help_time"     => $request->end_help_time,
            "count_down_hours"  => $request->count_down_hours,
        ]);

        if ( $settings ) return redirect()->back()->with('message', 'Successfully updated!') ;
        else return redirect()->back()->withInput()->with('message', 'Failed!') ;
    }

    public function block_member( $id ) {
        if ($user = User::findOrFail($id)) {
            $user->is_active = false ;
            $user->save() ;
            $info           = [
                'to_email'  => $user->email,
                'subject'   => "HHD Blocked Account",
                'to_name'   => $user->first_name . " " . $user->last_name,
                'message'   => "Hi " .$user->first_name . " " . $user->last_name . "
                                <br/>
                                We have blocked your account for not being part of donation process for 48 hours.
                                <br/>
                                <br/>
                                Warm Regards<br />holdinghandsdonations.com
                               "
            ] ;

            //notify user their account has been
            $job = (new BlockedUser($info))->onQueue('BlockedUser') ;
            dispatch($job) ;
            return "Account blocked an email will be send to the account holder shortly." ; 
        } else {
            return "Unable to remove user from the system - please try again later." ;
        }
    }

    public function unblock_member( $id ) {
        if ($user = User::findOrFail($id)) {
            $user->is_active = true ;
            $user->save() ;
            return "Account unblocked successfully." ; 
        } else {
            return "Unable to unblock - please try again later." ;
        }
    }
}
