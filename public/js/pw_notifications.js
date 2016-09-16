var Notifications 					= new function() {

	this.user 						= 0 ;

	this.list_notifications 		= function( user_id ) {
		$.getJSON('/list_notifications', function(response) {

			$("#notification_count").html(response.noti_count) ;
			$("#notification_big_count").html(response.noti_count) ;

			var list_notifications 	= $("#list_notifications") ;

			var messages 			= "" ;

			if ( response.noti_count > 0 ) {
				$.each( response.messages, function(i, value) {
					messages += "<li><a href='#' onclick='hide_noti("+value.id+")'><span class='details'><span class='label label-sm label-icon label-success md-skip'></span><i class='fa fa-eye-slash'></i></span>"+value.msg+"</span></span></a></li>"
				}) ;
				list_notifications.html(messages) ;
			}
		}) ;
	} ;

	this.add_notifications 			= function( user_id, message, type ) {

	} ;

	this.hide_notifications			= function( noti_id ) {
        $.ajax({
            url: "/read_notifications",
            type:"POST",
            beforeSend: function (xhr) {
                var token   = $('meta[name="csrf_token"]').attr('content') ;
                if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
            }, data: { 
                noti_id : noti_id 
            }, success: function( response ) {                
            	$("#list_notifications").html("") ;
            }, error: function( data ) {
            }
        });
	} ;
	
} ;

var secondary_level_token 			= $('meta[name="secondary_level_token"]').attr('content') ;
Notifications.list_notifications(secondary_level_token) ;

var hide_noti 						=function (id) {
	console.log("Notification id: " + id ) ;
	Notifications.hide_notifications( id ) ;
	Notifications.list_notifications( secondary_level_token ) ;
};