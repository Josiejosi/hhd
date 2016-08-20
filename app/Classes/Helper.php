<?php 

	namespace App\Classes ;

	use Auth ;
	use Carbon\Carbon ;
	use Mail ;

	use App\Models\User ;
	use App\Models\Account ;


	class Helper {

		public static function user_timezone( $user_id ) {

			$user 					= User::find( $user_id ) ;
			return $user->timezone ;

		}

		public static function get_user_active_account( $user_id ) {

			$account_details = User::find( $user_id )->accounts()->where( 'active_account', 1 ) ;

			if ( $account_details->count() == 1 )
				return $account_details->first() ;
			else 
				return false ;	
							
		}

		public static function date_diff( $start_date, $end_date ) {

			return $start_date->diffInDays( $end_date ) ;

		} 

		public static function send_mail( $email, $subject, $name, $message, $blade, $should_be_queued = false ) {

			$info 					= [

						'email' 	=> $email,
						'subject'	=> $subject,
						'name'		=> $name,
						'message'	=> $message

					] ;

			if ( $should_be_queued == true ) {

		        Mail::later(5, $blade, ['info' => $info], function ($m) use ($info) {
		            $m->from( 'info@prestigewallet.com', 'PrestigeWallet' );

		            $m->to( $info['email'], $info['name'] )->subject( $info['subject'] );
		        });

			} else {
		        Mail::send( $blade, ['info' => $info], function ($m) use ($info) {
		            $m->from( 'info@prestigewallet.com', 'PrestigeWallet' );

		            $m->to( $info['email'], $info['name'] )->subject( $info['subject'] );
		        });				
			}

	        return true ;

		}

	}