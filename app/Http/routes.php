<?php

	Route::get(  '/', 						'FrontController@home' ) ;
	Route::get(  '/signin', 				'FrontController@signin' );
	Route::post( '/signin', 				'AuthenticationController@signin' );
	Route::get(  '/join', 					'FrontController@signup' );
	Route::get(  '/join/{referral_key}', 	'FrontController@signup_referral' );
	Route::post( '/signup', 				'AuthenticationController@signup' );
	Route::get(  '/forgot', 				'FrontController@forgot' );
	Route::post( '/forgot', 				'AuthenticationController@forgot' );
	Route::get(	 '/contactus', 				'FrontController@contactus');
	Route::post( '/contactus', 				'FrontController@post_contactus');
	Route::get(	 '/warning', 				'FrontController@warning');
	Route::get(	 '/verify_account', 		'FrontController@verify_account');
	Route::post( '/verify_account', 		'FrontController@verify_process');
	Route::get(  '/logout', 				'AuthenticationController@logout' );

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