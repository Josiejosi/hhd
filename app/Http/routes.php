<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.

git remote add origin https://github.com/Josiejosi/wallet.git
git push -u origin master
|
*/


/**
	Frond Pages
 */
Route::get(  '/', 						'FrontController@home' ) ;
Route::get(  '/signin', 				'FrontController@signin' );
Route::post( '/signin', 				'AuthenticationController@signin' );
Route::get(  '/signup', 				'FrontController@signup' );
Route::get(  '/signup/{referral_key}', 	'FrontController@signup_referral' );
Route::post( '/signup', 				'AuthenticationController@signup' );
Route::get(  '/forgot', 				'FrontController@forgot' );
Route::post( '/forgot', 				'AuthenticationController@forgot' );
Route::get(	 '/contactus', 				'FrontController@contactus');
Route::post( '/contactus', 				'FrontController@post_contactus');
Route::get(	 '/warning', 				'FrontController@warning');
Route::get(  '/logout', 				'AuthenticationController@logout' );
/**
	End Frond Pages
	============================================================
	Start Of Back Controllers
 */
Route::get(	 '/home', 					'HomeController@index') ;
Route::post( '/get_donar', 				'HomeController@get_donar' );
Route::post( '/assign_donar',			'HomeController@assign_donar' );
Route::post( '/get_latest_feed',		'HomeController@get_latest_feed' );
Route::get(	 '/profile', 				'ProfileController@index') ;
Route::get(	 '/schedules', 				'ScheduledController@index') ;
Route::get(	 '/transactions', 			'TransactionController@index') ;
Route::post( '/approve_order', 			'TransactionController@approve_order') ;

Route::get( '/accounts', 				'AccountsController@index' ) ;
Route::post( '/get_account', 			'AccountsController@get_account' ) ;
Route::post( '/add_account', 			'AccountsController@addAccount' ) ;
Route::post( '/delete_account', 		'AccountsController@deleteAccount' ) ;
Route::post( '/activate_account', 		'AccountsController@updateAccount' ) ;
Route::get(	 '/bridge', 	 	function() {
	$user = App\Models\User::find(17);
	$info = [ 'message' => 'This is a test message to a user' ] ;
    event( new App\Events\YouHaveBeenReserved($user, $info)) ;

    dump($user) ;
    dump($info) ;
    echo "event has been made successfully - broadcasts" ;

});
/**
	End Back Controllers
	============================================================
 */

