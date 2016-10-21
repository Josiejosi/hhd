<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator ;

use Session ;

use App\Jobs\SendContactEmail ;

use App\Models\User ;


use App\Classes\Helper ;

use Auth ;

class FrontController extends Controller
{

    public function admin() {
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

    public function signin() {
    	return view('front.login') ;
    }

    public function signup() {
        return view('front.register') ;
    }

    public function signup_referral( $referral_key ) {
        $data = [
            'referral_key'=>$referral_key,
        ] ;
    	return view('front.register', $data) ;
    }

    public function forgot() {
        return view('front.forgot') ;
    }

    public function calculator() {
    	return view('front.calculator') ;
    }

    public function contactus() {
        return view('front.contactus') ;
    }

    public function philosophy() {
        return view('front.philosophy') ;
    }

    public function key_rule() {
        return view('front.key_rule') ;
    }

    public function legality() {
        return view('front.legality') ;
    }

    public function support() {
        return view('front.support') ;
    }

    public function FAQs() {
        return view('front.FAQs') ;
    }

    public function news() {
        return view('front.news') ;
    }

    public function post_contactus(Request $request) {
        $validator                      = Validator::make($request->all(), [
            'name'                      => 'required',
            'email'                     => 'required|email',
            'subject'                   => 'required',
            'message'                   => 'required',
        ]); 

        if ($validator->fails()) {
            return redirect('contactus')->withErrors($validator)->withInput() ;
        } 

        $contact_info                   = [
            'to_email'                  => 'prestigewallet@gmail.com',
            'from_email'                => $request->email,
            'to_name'                   => 'PrestigeWallet',
            'message'                   => "Sender's Details<br /> Email: " . $request->email . "<br />Phone: " . $request->phone . "<br />Subject: " . $request->subject . "<br />Message: " . $request->message,
            'subject'                   => "Feedback Message",
            'balde'                     => "emails.confirm",
        ] ;

        $job = ( new SendContactEmail($contact_info))->onQueue('SendContactEmail') ;
        $this->dispatch($job);

        Session::flash( "account_not_found", "Thank you for your email we'll get back at you as soon as posible.") ;
        return redirect('contactus') ;     
    }

    public function home() {
        return view('front.index') ;
    }    

    public function warning() {
    	return view('front.warning') ;
    }

    public function verify_account() {
        return view('front.verify_account') ;
    }
    
    public function verify_process(Request $request) {
        $verification_code      = $request->verification_code ;
        $user_id                = $request->user_id ;

        $user                   = User::where('id',$user_id)->where('verification_code',$verification_code)->count() ;

        if ( $user == 1 ) {
            $affected_users     = User::where('id',$user_id)->update([
                'is_verified'   => 1,
            ]) ;

            Helper::add_notification( "Your account is verified welcome to prestigewallet.com", $user_id, 0 ) ;

            return redirect()->intended( 'home' ) ;
        } else {
            Session::flash('account_not_found', 'Wrong verification code');
            return redirect()->back()->withInput() ;
        }
        return url('/signin/' . $refferal_key) ;
    }

}
