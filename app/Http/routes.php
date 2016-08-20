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
Route::get(  '/', 				'FrontController@home' ) ;
Route::get(  '/signin', 		'FrontController@signin' );
Route::post( '/signin', 		'AuthenticationController@signin' );
Route::get(  '/signup', 		'FrontController@signup' );
Route::post( '/signup', 		'AuthenticationController@signup' );
Route::get(  '/forgot', 		'FrontController@forgot' );
Route::post( '/forgot', 		'AuthenticationController@forgot' );
Route::get(	 '/contactus', 		'FrontController@contactus');
Route::post( '/contactus', 		'FrontController@post_contactus');
Route::get(	 '/warning', 		'FrontController@warning');
Route::get(  '/logout', 		'AuthenticationController@logout' );
/**
	End Frond Pages
	============================================================
	Start Of Back Controllers
 */
Route::get(	 '/home', 			'HomeController@index') ;
Route::post( '/get_donar', 		'HomeController@get_donar' );
Route::post( '/assign_donar',	'HomeController@assign_donar' );
Route::get(	 '/profile', 		'ProfileController@index') ;
Route::get(	 '/schedules', 		'ScheduledController@index') ;
Route::get(	 '/transactions', 	'TransactionController@index') ;
/**
	End Back Controllers
	============================================================
 */

