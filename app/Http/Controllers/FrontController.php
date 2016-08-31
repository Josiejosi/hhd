<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator ;

use Session ;

use App\Jobs\SendContactEmail ;

class FrontController extends Controller
{
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

}
