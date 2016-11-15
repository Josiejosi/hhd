<?php

	Route::get(  '/', 						'FrontController@home' ) ;
	Route::get(  '/signin', 				'FrontController@signin' );
	Route::post( '/signin', 				'AuthenticationController@signin' );
	Route::get(  '/signup', 				'FrontController@signup' );
	Route::get(  '/signup/{referral_key}', 	'FrontController@signup_referral' );
	Route::post( '/signup', 				'AuthenticationController@signup' );
	Route::get(  '/forgot', 				'FrontController@forgot' );
	Route::post( '/forgot', 				'AuthenticationController@forgot' );
	Route::get(	 '/support', 				'FrontController@contactus');
	Route::post( '/contactus', 				'FrontController@post_contactus');
	Route::get(	 '/warning', 				'FrontController@warning');
	Route::get(	 '/verify_account', 		'FrontController@verify_account');
	Route::post( '/verify_account', 		'FrontController@verify_process');

	Route::get( '/philosophy', 				'FrontController@philosophy');
	Route::get( '/how_it_works', 			'FrontController@key_rule');
	Route::get( '/legality', 				'FrontController@legality');
	Route::get( '/FAQs', 					'FrontController@FAQs');
	Route::get( '/news', 					'FrontController@news');

	Route::get(  '/logout', 				'AuthenticationController@logout' );



	Route::get(	 '/home', 					'HomeController@index') ;
	Route::post( '/get_donar', 				'HomeController@get_donar' );
	Route::post( '/assign_donar',			'HomeController@assign_donar' );
	Route::post( '/get_latest_feed',		'HomeController@get_latest_feed' );
	Route::get( '/pending_times',			'HomeController@pending_times' );
	Route::get(	 '/profile', 				'ProfileController@index') ;
	Route::get(	 '/schedules', 				'ScheduledController@index') ;
	Route::get(	 '/transactions', 			'TransactionController@index') ;
	Route::post( '/approve_order', 			'TransactionController@approve_order') ;
	Route::post( '/withdrawal', 			'TransactionController@withdrawal') ;

	Route::get( '/accounts', 				'AccountsController@index' ) ;
	Route::post( '/get_account', 			'AccountsController@get_account' ) ;
	Route::post( '/add_account', 			'AccountsController@addAccount' ) ;
	Route::post( '/delete_account', 		'AccountsController@deleteAccount' ) ;
	Route::post( '/activate_account', 		'AccountsController@updateAccount' ) ;

	Route::get( '/bitcoin', 				'BitcoinController@index' ) ;
	Route::post( '/get_bitcoin_accounts', 	'BitcoinController@get_bitcoin_accounts' ) ;
	Route::post( '/add_bitcoin_account', 	'BitcoinController@add_bitcoin_account' ) ;
	Route::post( '/delete_bitcoin_account', 'BitcoinController@delete_bitcoin_account' ) ;
	Route::post( '/activate_account', 		'BitcoinController@activate_account' ) ;


	Route::post( '/update_profile', 		'ProfileController@update_profile' ) ;	
	Route::post( '/change_password', 		'ProfileController@change_password' ) ;	
	Route::post( '/update_avatar', 			'ProfileController@update_avatar' ) ;	

	Route::get( '/list_notifications', 		'NotificationsController@get_notifications' ) ;
	Route::post( '/add_notifications', 		'NotificationsController@add_notification' ) ;
	Route::post( '/read_notifications', 	'NotificationsController@hide_notification' ) ;

	Route::get( '/admin/login', 			'FrontController@admin' ) ;
	Route::post( '/admin/login', 			'FrontController@postLogin' ) ;
	Route::get( '/admin/dashboard', 		'AdminController@index' ) ;
	Route::get( '/admin/members', 			'AdminController@users' ) ;
	Route::get( '/admin/elite', 			'AdminController@elite' ) ;
	Route::get( '/admin/scheduled', 		'AdminController@scheduled' ) ;
	Route::get( '/admin/donations', 		'AdminController@donations' ) ;
	Route::get( '/admin/settings', 			'AdminController@settings' ) ;
	Route::post( '/admin/create/elite', 	'AdminController@postElite' ) ;
	Route::post( '/admin/create/donation/elite', 	'AdminController@postEliteDonation' ) ;
	Route::get( '/admin/create/elite', 		'AdminController@create_elite' ) ;

	Route::post( '/admin/edit/settings', 	'AdminController@postSettings' ) ;
