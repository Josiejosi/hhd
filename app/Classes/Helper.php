<?php 

	namespace App\Classes ;

	use Auth ;
	use Carbon\Carbon ;
	use Mail ;

	use App\Models\User ;
	use App\Models\Account ;
	use App\Models\ActiveDonation ;
	use App\Models\SystemSetting ;


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

		public static function reached_max_donations ($id) {
			$active_donation 		= ActiveDonation::where('sender',$id)->where('is_processed',1)->count() ;
			
			if ( $active_donation >= self::max_reserves() ) 
				return 'stop' ;
			else 
				return 'add' ;
		}

		public static function max_reserves() {
			$settings = SystemSetting::where('is_active',1)->first() ;

			return (int)$settings->daily_reserves ;
		}

		public static function expiry_hours() {
			$settings = SystemSetting::where('is_active',1)->first() ;

			return (int)$settings->daily_reserves ;
		}

		public static function has_pending_timers($user_id) {
			return  ActiveDonation::where('sender',$user_id)
									->where('donation_status', 1)
									->where('is_processed', 1)
									->count() ;
		}

		public static function pending_timers($user_id) {
			$active_donations 		= ActiveDonation::where('sender',$user_id)
										->where('donation_status', 1)
										->where('is_processed', 1)
										->get() ;

			$expires_in 			= self::expiry_hours() ;
			$expiry_time 			= Carbon::now()->addHour($expires_in)->toDateTimeString() ;

			$i 						= 1 ;

			$string 				= "<div class='row widget-row'>" ;

			foreach ($active_donations as $active_donation) {

				$receiver 			= User::where('id',$active_donation->receiver)->first() ;
				$booked_at 			= $active_donation->booked_at->addHour($expires_in)->toDateTimeString() ;
				//separate the jquery function from html, use blade to add build timers.
				$string  			.= "
				    <div class='col-md-3'>
				        <div class='widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered'>
				            <h4 class='widget-thumb-heading'>Payment to <br/>
				            " . $receiver->first_name . " " . $receiver->last_name ."
				             Expires @ 
				             <br/>:
				             ".$booked_at."
				             </h4>
				            <div class='widget-thumb-wrap'>
				                <div class='widget-thumb-body'>
				                    <span class='widget-thumb-body-stat'>
				                    	<div id='payment$i'></div>
				                    </span>
				                </div>
				            </div>
				        </div>
				    </div>
									   " ;
					//echo $receiver->first_name . " " . $receiver->last_name ." ".$expiry_time ;
				$string 			.= "<script>
					var countdown$i = new Date(); 
					//countdown$i     = countdown$i;
					$('#payment$i').countdown({until: countdown$i}); 
									   </script>" ;
					$i++ ;
			}	

			$string  				.= "</div>" ;

			echo $string ;
		}

		public static function is_help_time() {
			//help_time
			$settings = SystemSetting::where('start_help_time','>=',Carbon::now()->toTimeString())
									 ->where('end_help_time','<=',Carbon::now()->toTimeString())
									 ->where('is_active',1)
									 ->count() ;

			if ( $settings > 1 ) return false ;
			else return true ;
		}
		public static function help_time() {
			$settings = SystemSetting::where('is_active',1)
									 ->first() ;

			return $settings->start_help_time . " - " . $settings->end_help_time ;
		}

		public static function send_mail( $email, $subject, $name, $message, $blade ) {

			$info 			= [

				'email' 	=> $email,
				'subject'	=> $subject,
				'name'		=> $name,
				'message'	=> $message

			] ;

	        Mail::send( $blade, ['info' => $info], function ($m) use ($info) {
	            $m->from( 'info@prestigewallet.com', 'PrestigeWallet' );

	            $m->to( $info['email'], $info['name'] )->subject( $info['subject'] );
	        });				

	        return true ;

		}

		public static function add_notification( $message, $user_id ) {
			
		}

	}