<?php 

	namespace App\Classes ;

	use Auth ;
	use Carbon\Carbon ;
	use Mail ;

	use App\Models\User ;
	use App\Models\Account ;
	use App\Models\ActiveDonation ;
	use App\Models\SystemSetting ;
	use App\Models\ScheduledDonation ;

	use App\Jobs\DonationReachedCountDown ;
	use App\Jobs\BlockedUser ;
	use App\Jobs\SendDonationDetails ;
	use App\Jobs\UserMadeDonation ;


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

			$active_donation 		= ActiveDonation::where('sender',$id)
									                ->where('is_processed',1)->count() ;
			
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

		public static function getPendingTime($user_id) {
			return  ActiveDonation::where('sender',$user_id)
									->where('donation_status', 1)
									->where('is_processed', 1)
									->get() ;			
		}

		public static function removeUsersNotDonated48hour() {
			$now 				= Carbon::now("Africa/Johannesburg") ;
			
			$donations 			= ActiveDonation::where('donation_status', 1)
												->where('is_processed', 1)
												->get() ;

			if ( count($donations) ) {
				foreach ($donations as $donation) {
					$booked_at 		= $donation->booked_at ;
					$sender 		= $donation->sender ;

					if ( $booked_at->diffInHours($now, false) >= 48 ) {
						$update_count = ActiveDonation::where('donation_status', 1)
									    ->where('is_processed', 1)
									    ->where('sender', $sender)
									    ->update(['donation_status'=>0,'is_processed'=>0,'booked_at'=>'0000-00-00 00:00:00','sender'=>0]) ;
						if ( $update_count > 0 ) {
							$user 	  = User::where('id',$sender)->first() ;


							$user_id 		= $user->id ;
							$created_at 	= $user->created_at ;
							$email 			= $user->email ;
							$first_name 	= $user->first_name ;
							$last_name 		= $user->last_name ;

							$info 			= [
								'to_email'	=> $email,
								'subject'	=> "PrestigeWallet User unassigned",
								'to_name'	=> $first_name . " " . $last_name,
								'message'	=> "Hi $first_name $last_name,
												<br/>
												We have unassigned the last user you reserved.
												<br/>
												<br/>
												Warm Regards<br />PrestigeWallet.com
											   "
							] ;

							//notify user their account has been
							$job = (new DonationReachedCountDown($info))->onQueue('DonationReachedCountDown');
					        dispatch($job);
						}
					}
				}
			}
			//\Log::info("Moved non donor users") ;
		}

		public static function inactivateNonDonor48hours() {

			$now 					= Carbon::now("Africa/Johannesburg") ;
			
			$donations_count 		= ActiveDonation::distinct()->select('sender')->count() ;

			$user_ids 				= [] ;

			if ( $donations_count > 0 )	{
				$i  				= 0 ;
				$donations 	 		= ActiveDonation::distinct()->select('sender')->get() ;

				foreach( $donations as $donation) {
					if ( $donation->sender != 0 )
						$user_ids[$i] = $donation->sender ;
					$i++ ;	
				}
			}
	
			$user_count 			= User::whereNotBetween('id', $user_ids)->where('is_special_user',0)->count() ;

			if ( $user_count > 0 ) {
				$users  			= User::whereNotBetween('id', $user_ids)->where('is_special_user',0)->get() ;
				foreach ($users as $user ) {

					$user_id 		= $user->id ;
					$created_at 	= $user->created_at ;
					$email 			= $user->email ;
					$first_name 	= $user->first_name ;
					$last_name 		= $user->last_name ;

					$usr_affacted 	= User::where('id',$user_id)->update(['is_active'=>0]) ;

					if ( $usr_affacted > 0 ) {

						$info 			= [
							'to_email'	=> $email,
							'subject'	=> "PrestigeWallet Blocked Account",
							'to_name'	=> $first_name . " " . $last_name,
							'message'	=> "Hi $first_name $last_name,
											<br/>
											We have blocked your account for not being part of donation process for 48 hours.
											<br/>
											<br/>
											Warm Regards<br />PrestigeWallet.com
										   "
						] ;

						//notify user their account has been
						$job = (new BlockedUser($info))->onQueue('BlockedUser') ;
				        dispatch($job) ;						
					}

				} 
			}	
			//\Log::info("Blocked users") ;
		}

		public static function moveScheduledDonationsToActiveDonations() {
			$now 									= Carbon::now("Africa/Johannesburg") ;
			$scheduled_donations 					= ScheduledDonation::all() ;

			if ( count( $scheduled_donations ) > 0 ) {
				$active_setting 					= self::getActiveSetting() ;
				foreach ( $scheduled_donations as $scheduled_donation ) {

					$schedule_for 					= $scheduled_donation->schedule_for ;
					$amount 						= $scheduled_donation->amount ;
					$user_id 						= $scheduled_donation->user_id ;

					if ( $schedule_for->gte( $now ) ) {
						$list 						= ActiveDonation::create([
							'receiver'				=> $user_id,
							'sender'				=> 0,
							'amount'				=> $amount,
							'created_at'			=> $now,
					    	"booked_at"          	=> "",
					    	"donation_percentage"	=> $active_setting->percentage,
					    	"donation_days"      	=> $active_setting->days,
					    	"donation_status"    	=> 0,
					    	"is_processed"       	=> 0,
						]) ;
					}

				}
			}
			//\Log::info("Moved Schedules to active") ;
		}

		public static function getActiveSetting() {
			return SystemSetting::where('is_active',1)->first() ;
		}

		public static function addEliteToDonationList() {

		}

		public static function assignMember( $user_id, $min_amount, $max_amount ) {

			$now 						= Carbon::now("Africa/Johannesburg") ;

			$account 					= self::get_user_active_account( $user_id ) ;

			$bank 						= $account->bank ;

			$account_users_count 		= Account::where( 'bank', $bank )->distinct()->select('user_id')->count() ;
			\Log::info( "account found: " . $account_users_count ) ;
			\Log::info( "bank: " . $bank ) ;
			//i need 1 user.
			if ( $account_users_count > 0 ) {

				$account_users 			= Account::where( 'bank',$bank )->distinct()->select('user_id')->get() ;
				$user_ids 				= [] ;
				$i 						= 0 ;

				foreach( $account_users as $account_user) {
					
					$user_ids[$i] = $account_user->user_id ;
					$i++ ;	

				}

				$active_count 				= ActiveDonation::whereBetween('amount',[$min_amount,$max_amount])
														->whereBetween('receiver', [$user_ids[0],$user_ids[count($user_ids)-1]])
														->where('is_processed',0)
														->count() ;
				
				if ( $active_count > 0 ) {
					$active_donations 		= ActiveDonation::whereBetween('amount',[$min_amount,$max_amount])
														->whereBetween('receiver', [$user_ids[0],$user_ids[count($user_ids)-1]])
														->where('is_processed',0)
														->get()
														->random(1) ;

					$id 					= $active_donations->id ;
					$receiver_id 			= $active_donations->receiver ;
					
					ActiveDonation::where('id', $id)->update([
						'is_processed'		=>1,
						'donation_status'	=>1, 
						'sender'			=>$user_id
					]) ;
					
					//check if user has not made donation to this user before.
		    		$account 				= Account::where( 'user_id', $active_donations->receiver )->where('active_account',1)->first() ;
		    		$user 					= User::find($active_donations->receiver) ;
		    		\Log::info( "receiver ID" . $active_donations->receiver) ;
		    		\Log::info( "accounts: " . $account) ;
		    		\Log::info( "found accounts: " . count($active_donations) ) ;
		    		$name 					= $user->first_name . " " . $user->last_name ;
		    		$email 					= $user->email ;
		    		$cell_phone 			= $user->cell_phone ;
		    		$account_number 		= $account->account_number ;
		    		$bank 					= $account->bank ;
		    		$branch_code 			= $account->branch_code ;
		    		$amount 				= $active_donations->amount ;

			    	$message 				= "
			    								<br />
			    								You have successfully being assigned to donate, details are as follows:<br/><br/>
			    								<br />
			    								<table border=0 cellpadding=5 cellspacing=0>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Account Holder</td>
			    									<td align=right> : $name</td>
			    								</tr>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Holder' Email</td>
			    									<td align=right> : $email</td>
			    								</tr>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Holder's Cell Phone</td>
			    									<td align=right> : $cell_phone</td>
			    								</tr>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Bank</td>
			    									<td align=right> : $bank</td>
			    								</tr>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Account Number</td>
			    									<td align=right> : $account_number</td>
			    								</tr>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Branch Code</td>
			    									<td align=right> : $branch_code</td>
			    								</tr>
			    								<tr>
			    									<td align=right bgcolor=#E0FFFF>Amount</td>
			    									<td align=right> : R $amount</td>
			    								</tr>
			    								</table>
			    								<strong>NOTE: Failure to make payment before, This member will be unassigned to you and failure to make payment to 2 assigned members will result in your account blocked for 3 months</strong>
			    								<br /><br />
			    								Warm Regards,<br />
			    								PrestigeWallet.com

			    							  " ;

			    	$sms_message 			= "You have successfully being assigned to donate," ;
			    	$sms_message 			.= " details are as follows, Account Holder: $name," ;
			    	$sms_message 			.= " Cell Phone: $cell_phone, Bank: $bank," ;
			    	$sms_message 			.= " Account Number: $account_number," ;
			    	$sms_message 			.= " Branch Code: $branch_code, Amount: R $amount" ;

			    	$user_details 			= User::where('id', $user_id)->first() ;
			    	$user_reserved_info 	= [
			    		'to_email'			=> $user_details->email,
			    		'subject'			=> "PrestigeWallet.com Donations",
			    		'to_name'			=> $user_details->first_name . " " . $user_details->last_name,
			    		'message'			=> $message,
			    		'cell_phone'		=> $user_details->cell_phone,
			    		'sms_message'		=> $sms_message,
			    	] ;

					$job = (new SendDonationDetails($user_reserved_info))->onQueue('SendDonationDetails') ;
			        dispatch($job) ;

			        self::alertReceiver( 
			        	$name, 
			        	$email, 
			        	$cell_phone, 
			        	$user_details->first_name . " " . $user_details->last_name, 
			        	$amount 
			        ) ;
			        \Log::info($user_reserved_info) ;
				} else {
					\Log::info("Could not reserve user.") ;
				}

			}

		}

		public static function alertReceiver( $receiver_name, $receiver_email, $receiver_cell, $sender_name, $amount ) {

	    	$message 				= "Hi $receiver_name
	    								<br /><br />
	    								$sender_name was assigned to you for an amount of R $amount, 
	    								Please ensure you go to the On-line App to accept their Donation once the 
	    								money reflects on your account.
	    								<strong>NOTE: Failure to accept payments will result in your account 
	    								blocked for 3 months, if the Donor reports you for delaying 
	    								acknowledgment of receiving payments</strong>
	    								<br /><br />
	    								Warm Regards,<br />
	    								PrestigeWallet.com
	    							  " ;

	    	$sms_message 			= "Hi $receiver_name," ;
	    	$sms_message 			.= "$sender_name was assigned to you for an amount of R $amount, " ;
	    	$sms_message 			.= "Please ensure you go to the On-line App to accept their Donation once the money reflects on your account." ;

	    	$user_reserved_info 	= [
	    		'to_email'			=> $receiver_email,
	    		'subject'			=> "You have been assigned a member",
	    		'to_name'			=> $receiver_name,
	    		'message'			=> $message,
	    		'cell_phone'		=> $receiver_cell,
	    		'sms_message'		=> $sms_message,
	    	] ;
			$job = (new UserMadeDonation($user_reserved_info))->onQueue('UserMadeDonation') ;
	        dispatch($job) ;
		}

		public static function maxDonationsPayBig($user_id) {

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
			
			$settings 		= SystemSetting::where('is_active',1)->first() ;	

			$settings_count = SystemSetting::where('is_active',1)->count() ;

			$now_date 		= Carbon::now('Africa/Johannesburg') ;
			$start_date 	= $settings->start_help_time ;
			$end_date 		= $settings->end_help_time ;

			$start_hour 	= substr($start_date, 0,2) ;
			$start_min 		= substr($start_date, 3,2) ;
			$start_sec 		= substr($start_date, 6,2) ;

			$start_time 	= Carbon::create(
								$now_date->year, 
								$now_date->month, 
								$now_date->day, 
								$start_hour, 
								$start_min, 
								$start_sec,'Africa/Johannesburg'
							) ;		

			$end_hour 		= substr($end_date, 0,2) ;
			$end_min 		= substr($end_date, 3,2) ;
			$end_sec 		= substr($end_date, 6,2) ;

			$end_time 		= Carbon::create(
								$now_date->year, 
								$now_date->month, 
								$now_date->day, 
								$end_hour, 
								$end_min, 
								$end_sec,'Africa/Johannesburg'
							) ;

			if ( $now_date->gte($start_time) == true && $end_time->lte($now_date) == false ) {
				return true ;
			} else {
				return false ;
			}

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

		public static function send_sms($msg, $cellphone) {
			$url 		= "https://www.winsms.co.za/api/batchmessage.asp?";
			$userp 		= "user=josiejosi@ymail.com";
			$passwordp 	= "&password=450411@tjS";
			$messagep 	= "&message=" . urlencode($msg);
			$numbersp 	= "&Numbers=$cellphone";

			$sms_url = $url.$userp.$passwordp.$messagep.$numbersp ;

			$ch = curl_init() ;
			curl_setopt( $ch, CURLOPT_URL, $sms_url ) ;
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ) ;
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false ) ;
			$result = curl_exec( $ch ) ;
			curl_close($ch) ;

		    return true ;
		}

	}