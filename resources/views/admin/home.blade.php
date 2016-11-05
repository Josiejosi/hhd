@extends('layouts.backend')

@section ('title', 'Home')

@section ('css')

	<style type="text/css">
		
		.icon-btn {
    		min-width: 150px;
		}

		.widget-thumb {
		    padding: 3px;
		    border-radius: 4px;
		}
		.hasCountdown {
		    border:  none ; 
		    background-color: none ;
		}

		.widget-thumb .widget-thumb-body .widget-thumb-body-stat {
		    display: block;
		    font-size: 14px;
		    font-weight: none;
		    color: red;
		}
		.widget-thumb .widget-thumb-heading {
		    font-size: 10px;
		}

		.dashboard-stat .details .desc {
		    font-size: 12px;
		}

		.box1 {
			border-bottom: none ;
			border: 1px soild #307379 ;
			border-radius: 5px ;
			padding: 5px ;
			font-size: 16px ;
		} 
	</style>

@endsection

@section ('content')

	<div class="row">
		<div class="col-md-12">
			<h2 class="page-header text-center">Welcome to HHD Dashboard</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
  			<div class="box1">
	  			<i class="fa fa-cash"></i>
	  			<h3>Funds Send</h3>
	  			<h3>R 0.00</h3>
  			</div>
  		</div>
		<div class="col-md-6">
  			<div class="box1">
	  			<i class="fa fa-cash"></i>
	  			<h3>Funds to cash-in</h3>
	  			<h3>R 0.00</h3>
  			</div>
  		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<p class="alert alert-info"><i class="fa fa-info-circle" aria-hidden="true">&nbsp;</i><strong>PLEASE NOTE:</strong> HHD only allows <span class="badge badge-danger">2</span> funds to be created by 1 individual user per month.</p>
		</div>
	</div>

	<div class="row">

		<div class="col-md-12" id="assignment_div_big">
		</div>
		<div class="col-md-6">

			<h5 class="page-header">FUND A MEMBER</h5>
            <form role="form" action="{{url('/update_profile')}}" method="post">

                {!! csrf_field() !!}
                <div class="form-group input-group-sm">
                    <label class="control-label">Label Fund</label>
                    <input type="text" value="" id='label' name='label' placeholder="Label" class="form-control"> 
                </div>
                <div class="form-group input-group-sm">
                    <label class="control-label">Amount</label>
                    <select id='amount' name='amount' placeholder="Amount" class="form-control">
                    	
                    	@for( $i=1; $i<41; $i++ )

                    		<option>{{$i*500}}</option>
                    	@endfor
                    </select>
                </div>
                <div class="margiv-top-10">
                    <button class="btn btn-sm btn-success" id="create_fund"> Create Fund </button>
                </div>
            </form>
		</div>

		<div class="col-md-6">
			<h5 class="page-header">Recent Donations</h5>
			<div id="donations">
				<div id="divFeeds"></div>
			</div>
		</div>
		
	</div>
	

@endsection

@section ('js')

	<script type="text/javascript">

		var expiry_hour 			= {{ $expiry_hour }} ;


		var secondary_level_token 	= $('meta[name="secondary_level_token"]').attr('content') ;

		$("#create_fund").on("click", function() {
			event.preventDefault() 

			 $("#assignment_div_big").html(
			 	"<div style='padding:50px; text-align:center'>" +
				"Please be patient as we try and find a suitable match for you to donate to.<br />" +
				"@include ('includes.loader')" +
				"</div>"
			 ) ;

		    $.ajax({
		        url: "/get_donar",
		        type:"POST",
		        beforeSend: function (xhr) {
		            var token 	= $('meta[name="csrf_token"]').attr('content') ;
		            if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
		        }, data: { 
		        	requested_amount 	 : $("#amount").val(),
		        }, success: function( data ) {

		            $("#assignment_div_big").html(data.message) ;

		            if ( data.message == "found") {
		            	var tid 		= data.tid ;
		            	var user_id 	= data.user_id ;
		            	var amount 		= data.amount ;

		            	$("#assignment_div_big").html( "<div class='alert alert-info' style='padding: 10px; text-align center;'><h4 class='text-center'>We found a suitable donee to match your amount range for: " ) ;
		            	$("#assignment_div_big").append( "<br/>R " + amount ) ;
		            	$("#assignment_div_big").append(
		            		"<br /><button id='reserve_order' class='btn btn-sm btn-info' onclick=\"assign_me('"+tid+"','"+user_id+"','"+amount+"')\"><i class='fa fa-cash'></i> Cash Reserve</button><span style='padding-left:30px ;'></span><button class='btn btn-sm btn-success' onclick=\"assign_me('"+tid+"','"+user_id+"','"+amount+"')\"><i class='fa fa-btc'></i>Bitcoin Recerve</button></h4><br /><br /></div>"
		            	) ;
		            } else {
		            	$("#assignment_div_big").html(data.message) ;
		            }

		        }, error: function( data ) {
		        	var message = 'No member\'s for the selected range, please try a different range.' ;
		        	$("#assignment_div_big").html(message) ;
		            //toast_notification('danger', message) ;
		        }
		    });
		}) ;
		

		var count_countdowns = 1 ;


        var assign_me 				= function( tid, user_id, amount ) {
        	//var remaining_hours 	= new Date(); 
        	//remaining_hours 		= remaining_hours + 30 ;
        	//$('#reserve_order').button('loading');

		    $.ajax({
		        url: "/assign_donar",
		        type:"POST",
		        beforeSend: function (xhr) {
		            var token 	= $('meta[name="csrf_token"]').attr('content') ;
		            if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
		        }, data: { 
		        	tid:tid,
		        	amount:amount,
		        	user_id:user_id
		        }, success: function( data ) {
		        	console.log(data.message) ;
		        	if ( data.message == "success" ) {
			            $( "#assignment_div_big" ).html(  
							"<div class='alert alert-success'><p class='text-center'>Successfully reserved, an Email will be send to you shortly with member's details," +
        				  	" Please make a payment and send proof of payment to both user and support team" +
        				  	" and await their approval</p></div>"
			             ) ;
			            //create_countdown_timer( data.bank, data.account, data.branch, 60*parseInt(expiry_hour), count_countdowns, "red" ) ;
			            //count_countdowns++ ;
			            //toast_notification( "info", message ) ;		        		
		        	} else if( data == 'failed') {
		        		var message = "This message might be because a fund was reserved before you, please try a different range" ;
			            $( "#assignment_div_big" ).html( "<h4 class='text-center'>" + message + "</h4>" ) ;
			            //toast_notification( "warning", message ) ;
		        	} else {
		        		$( "#assignment_div_big" ).html( "<h4 class='text-center'>" + data + "</h4>" ) ;
		        	}
		        	//$('#reserve_order').button('reset') ;
		        }, error: function( data ) {
		        	var message = "<h4 class='text-center'>Technical error, please try again a different range, if the error persists, contact support</h4>" ;
		        	$("#assignment_div_big").html(data) ;
		            //toast_notification( "danger", message ) ;
		            //$('#reserve_order').button('reset') ;
		        }
		    });
        };

		var feedUpdate = function() {
			clearInterval(updateFeeds) ;
			var id = secondary_level_token ;
		    $.ajax({
		        url: "/get_latest_feed",
		        type:"POST",
		        beforeSend: function (xhr) {
		            var token 	= $('meta[name="csrf_token"]').attr('content') ;
		            if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
		        }, data: { 
		        	id:id
		        }, success: function( data ) {
		        	$("#divFeeds").html(data) ;
		        	updateFeeds = setInterval( feedUpdate, 5000 ) ;
		        }, error: function( data ) {
		        	console.log("Error") ;
		        }
		    });
		    //load_countdowns() ;
		}

		var updateFeeds = setInterval( feedUpdate, 2000 ) ;

		var approve = function( num, id) {
        	//$('#approve'+num).button('loading');


		    $.ajax({
		        url: "/approve_order",
		        type:"POST",
		        beforeSend: function (xhr) {
		            var token 	= $('meta[name="csrf_token"]').attr('content') ;
		            if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
		        }, data: { 
		        	id:id
		        }, success: function( data ) {
		        	console.log(data) ;
		        	if ( data == "success" ) {
			            $( "#Inform" ).html("<div class='alert alert-success'>Successfully approved.</div>") ;
			            $('#approve'+num).hide() ;
			            alert("Successfully approved." ) ;		        		
		        	} else {
			            $( "#Inform" ).html("<div class='alert alert-success>"+data+"</div>") ;
			            alert( data ) ;
		        	}
		        	//$('#approve'+num).button('reset') ;
		        }, error: function( data ) {
		        	$( "#Inform" ).html("<div class='alert alert-success>"+data+"</div>") ;
		            //$('#approve'+num).button('reset') ;
		        }
		    });
		};

		var update_notifications = function() {
		    $.ajax({
		        url: "/notifications",
		        type:"POST",
		        beforeSend: function (xhr) {
		            var token 	= $('meta[name="csrf_token"]').attr('content') ;
		            if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
		        }, data: { 
		        	id:id
		        }, success: function( data ) {
		        	console.log(data) ;
		        	if ( data == "success" ) {
			            $( "#Inform" ).html("<div class='alert alert-success'>Successfully approved.</div>") ;
			            $('#approve'+num).hide() ;
			            alert("Successfully approved." ) ;		        		
		        	} else {
			            $( "#Inform" ).html("<div class='alert alert-success>"+data+"</div>") ;
			            alert(data ) ;
		        	}
		        	//$('#approve'+num).button('reset') ;
		        }, error: function( data ) {
		        	$( "#Inform" ).html("<div class='alert alert-success>"+data+"</div>") ;
		            //$('#approve'+num).button('reset') ;
		        }
		    });
		};

		var add_stop_minute = function( minutes ) {
			var now         = new Date() ;
			now.setMinutes(now.getMinutes() + minutes) ;
			var days        = now.getDate() ;

			if ( days.lenght == 1 )
			  days        = "0" + days ;

			var months      = ( parseInt(now.getMonth()) + 1 ) ;
			if ( months.lenght == 1 )
			  months      = "0" + minutes ;

			var hours       = now.getHours() ;
			if ( hours.lenght == 1 )
			  hours       = "0" + hours ;

			var minutes     = now.getMinutes() ;
			if ( minutes.lenght == 1 )
			  minutes     = "0" + minutes ;

			var seconds     = now.getSeconds() ;
			if ( seconds.lenght == 1 )
			  seconds     = "0" + seconds ;

			return now.getFullYear() + "-" + months + "-" + days + " " + hours + ":" + minutes + ":" + seconds ;
		} ;

		var create_countdown_timer = function(bank, account, branch, minutes, number, color) {
			var string_timer 	   = "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>" +
									 "<a class='dashboard-stat dashboard-stat-v2 "+color+"' href='#'>" +
									 "<div class='visual'>" +
									 "<i class='fa fa-clock-o'></i>" +
									 "</div>" +
									 "<div class='details'>" +
									 "<div class='number'>" +
									 "<span data-counter='counterup'>" +
									 "<div class='countdown"+number+"'></div>" +
									 "</span>" +
									 "</div>" +
									 "<div class='desc'>"+bank+"</div>"+
									 "<div class='desc'>"+account+"</div>"+
									 "<div class='desc'>"+branch+"</div>"+
									 "</div>" +
									 "</a>" +
									 "</div>" ;

			$("#count_down").append(string_timer) ;

			var now             = add_stop_minute( minutes ) ;

			$( ".countdown"+number ).countdown( now, function(event) {
			     $(this).text(event.strftime('%D:%H:%M:%S'));
			});

		} ;

		var clear_countdown 		= function(div_countdown) {

		} ;

		var colors 					= ['red', 'blue', 'green', 'yellow', 'orange'] ;

		var load_countdowns 		= function() {

			$.getJSON('/pending_times', function( response ) {
				
				if ( response.message == "found" ) {
					var number = 1 ;
					$("#count_down").html("") ;
					$.each( response.data, function(i, value) {
						var minutes = value.remaining_time ;
						var bank 	= value.bank ;
						var account = value.account_number ;
						var branch 	= value.branch_code ;
						var color 	= colors[Math.floor((Math.random() * 4) + 0)] ; 
						create_countdown_timer(bank, account, branch, minutes, number, color) ;
						number++ ;
						console.log(value) ;
					}) ;
				}
			}) ;
		}

		//load_countdowns() ;
	</script>

@endsection