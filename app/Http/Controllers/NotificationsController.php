<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Classes\Helper ;

use Auth ;

class NotificationsController extends Controller
{

    public function get_notifications() {
    	return Helper::list_notifications( Auth::user()->id ) ;
    }

    public function add_notification(Request $request) {

    }

    public function hide_notification(Request $request) {
    	Helper::notification_read( $request->noti_id ) ;
    }
}
