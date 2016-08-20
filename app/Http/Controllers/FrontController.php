<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator ;

use Session ;

use App\Classes\Helper ;

class FrontController extends Controller
{
    public function signin() {
    	return view('front.login') ;
    }

    public function signup() {
    	return view('front.register') ;
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
            'name'                      => 'required|alpha',
            'email'                     => 'required|email',
            'subject'                   => 'required',
            'message'                   => 'required',
        ]); 

        if ($validator->fails()) {
            return redirect('contactus')
                        ->withErrors($validator)
                        ->withInput();
        } 

        if ( Helper::send_mail( 
                'nathitut@gmail.com', 
                "Feedback Message", 
                "Hi Team Prestige" , 
                "Sender's Details<br /> Email: " . $request->email . "<br />Phone: " . $request->phone . "<br />Subject: " . $request->subject . "<br />Message: " . $request->message , 
                "emails.confirm",
                true 
            ) ) {
            Session::flash('account_not_found', 'Thank you for yor feedback');
            return redirect('contactus') ;
        }      
    }

    public function home() {
        return view('front.index') ;
    }    

    public function warning() {
    	return view('front.warning') ;
    }

}
