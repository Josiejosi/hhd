<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth ;
use Validator ;

use App\Models\User ;

use App\Classes\Helper ;

class ProfileController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('verify');
    }
    
    public function index() {

        $data                           = [
            'name'                      => Helper::userDetails( Auth::user()->id ),
            'avatar'                    => Helper::userAvatar( Auth::user()->id ),
        ] ;

        //'avatar'                    => Helper::userAvatar( Auth::user()->id ) ;

    	return view('admin.profile', $data) ;
    }

    public function update_profile(Request $request) {
    	$user = User::where('id', Auth::user()->id)->update([
	        'first_name'=>$request->name, 
	        'last_name'=>$request->surname, 
    	]) ;
    	return redirect()->back()->with('status', 'Profile updated!') ;

    }

    public function change_password(Request $request) {

        $validator 					= Validator::make($request->all(), [
            'current_password' 		=> 'required|min:6|max:12',
            'password' 				=> 'required|confirmed|min:6|max:12',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('profile#tab_1_3')
                        ->withErrors($validator)
                        ->withInput();
        }

	    if ( !Auth::attempt(['email' => Auth::user()->email, 'password' => $request->current_password]) ) {
	    	return redirect()->back()->with('error', 'Wrong current password.') ;
        }

     	$user = User::where('id',Auth::user()->id)->update([
	        'password'=>bcrypt($request->password), 
    	]) ;

    	if ( $user )       
    		return redirect('profile#tab_1_3')->with('status', 'Password updated!') ;
    	else
    		return redirect('profile#tab_1_3')->with('error', 'Failed to upload password!') ;
    }

    public function update_avatar(Request $request) {

        $file                           = $request->file('avatar') ;
        $destination_path               = public_path() . '/imgs/avatar/' ;
        $extension                      = $file->getClientOriginalExtension() ;
        $file_name                      = "user_" . Auth::user()->id . "_pro_pic." . $extension ;

        $move = $request->file('avatar')->move($destination_path, $file_name ) ;

        if ( $move ) {
        	//$image = \Image::make(sprintf('imgs/avatar/%s', $image_name))->resize(150, 150)->save();
	     	$user = User::where('id',Auth::user()->id)->update([
		        'avatar'=>$file_name, 
	    	]) ;
            return redirect('profile#tab_1_2')->with('status', 'Avatar updated!') ;
        }

        return redirect('profile#tab_1_2')->with('error', 'Failed to updoad avatar.') ;
    }
}
