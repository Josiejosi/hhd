@extends('layouts.backend')

@section ('title', 'Home')

@section ('css')

	<link rel="stylesheet" type="text/css" href="{{asset('css/ion.rangeSlider.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/ion.rangeSlider.skinNice.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('css/profile.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/loader.css')}}">

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
	</style>

@endsection

@section ('content')

	<div class="row">
		
		<div class="col-md-8 col-sm-8">

			@if ( $max_reserves_allowed == false)
				<div class="note note-info">
					<h5 class="block"><strong>You have reached your max Dream limit, thank you.</strong></h5>
				</div>
			@endif


			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#small" data-toggle="tab" aria-expanded="false"> Small Donations </a>
				</li>
				<li class="">
					<a href="#big" data-toggle="tab" aria-expanded="true"> Big Donations </a>
				</li>
			</ul>

			<div class="tab-content">

				@if ($is_help_time == true )

				<div class="tab-pane fade active in" id="small">
					<div class="note note-info">
						<p> Please select amount from ZAR 1000 - ZAR 20 000</p>
					</div>
		            <div class="form-group">
		                <div class="col-md-10 col-md-offset-1">
		                    <input id="small_investment" type="text" value="" />
							<p class="text-center">	Between R 
								<span id="lower-value"></span> and R 
								<span id="upper-value"></span>
								<br />
							</p>
		                </div>
		            </div>

				</div>

				<div class="tab-pane fade in" id="big">
					<div class="note note-info">
						<p> Please select help amount ZAR 20 000 - ZAR 50 000</p>
					</div>

		            <div class="form-group">
		                <div class="col-md-10 col-md-offset-1">
		                    <input id="big_investment" type="text" value="" />
							<p class="text-center">	Between R 
								<span id="lower-value2"></span> and R 
								<span id="upper-value2"></span>
								<br />
							</p>
		                </div>
		            </div>
					
				</div>

				@else
				<div class="tab-pane fade active in" id="small">

					<div class="note note-info">
						<h4 class="block">DONATION TIME IS BETWEEN</h4>
						<p> <strong>{{ $help_time }}</strong></p>
					</div>

				</div>
				@endif

			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div id="assignment_div_big" style="text-align:center; font-weight: bold;"></div>
				</div>
			</div>			

		</div>

		<div class="col-md-4 col-sm-4">
		<div class="col-md-12 col-sm-12">
			
			<div class="portlet light bordered">
			    <div class="portlet-title tabbable-line">
			        <div class="caption">
			            <i class="icon-globe font-dark hide"></i>
			            <span class="caption-subject font-dark bold uppercase">Updates</span>
			        </div>
			        <ul class="nav nav-tabs">
			            <li class="active">
			                <a href="#tab_1_1" class="active" data-toggle="tab" aria-expanded="true"> Donations </a>
			            </li>
			        </ul>
			    </div>
			    <div class="portlet-body">
			        <!--BEGIN TABS-->
			        <div class="tab-content">
			            <div class="tab-pane active" id="tab_1_1">
			                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 239px;"><div class="scroller" style="height: 339px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible="0" data-initialized="1">

			                    <ul class="feeds" id="divFeeds">

			                    	@if ( count($transactions) > 0 )
			                    	<?php $i=1 ; ?>
			                    	@foreach ( $transactions as $transaction )

		                         	<?php
		                         		$user_count = \App\Models\User::where('id',$transaction->sender)->count() ;
		                         		$name = '' ;
		                         		if ( $user_count == 1 ) {
		                         			$user = \App\Models\User::where('id',$transaction->sender)->first() ;
		                         			$name = $user->first_name . " " . $user->last_name ;
		                         		}
		                         	?>
			                        <li>
			                            <div class="col1">
			                                <div class="cont">
			                                    <div class="cont-col2">
			                                        <div class="desc"> 
			                                        	{{$name}}, R {{$transaction->amount}}
			                                        </div>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="col2">
			                                <button 
			                                	class="btn btn-sx btn-success"
			                                	id="approve{{$i}}"
			                                	onclick="approve( {{$i}}, {{ $transaction->id }})">
			                                Approve</button>
			                            </div>
			                        </li>
			                        <?php $i++ ; ?>
			                        @endforeach

			                        @else

			                        <li>
			                            <div class="col1">
	                                        <div class="desc"> 
	                                        	No donations to approve.
	                                        </div>
	                                    </div>
			                        </li>

			                        @endif
			                    </ul>
			                </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 173.859px; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
			            </div>
			        </div>
			        <!--END TABS-->
			    </div>
			</div>
			
		</div>

		<div class="col-md-12 col-sm-12">
		    <div class="portlet light bordered">
		        <div class="portlet-title">
		            <div class="caption">
		                <i class="icon-cursor font-dark hide"></i>
		                <span class="caption-subject font-dark bold uppercase">REFERAL BONUS</span>
		            </div>
		        </div>
		        <div class="portlet-body">
		            <div class="row">
		                <div class="col-md-4">
		                    <div class="easy-pie-chart">
		                        <div class="number transactions" data-percent="55">
		                            <span sylte='text-align:center;'>0.00</span>% <canvas height="75" width="75"></canvas></div>
		                        <a class="title" href="javascript:;"> Members
		                            <i class="icon-arrow-right"></i>
		                        </a>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		</div>
	</div>
	

@endsection

@section ('js')

	<script src="{{asset('js/ion.rangeSlider.min.js')}}" type="text/javascript"></script>
	<script type="text/javascript">

		$(function(){
/*			var countdown1 = new Date(); 
			var countdown2 = new Date(); 
			//var countdown2 = new Date(2016, 08, 18, 12, 45, 00, 00);
			//countdown = new Date(countdown.getFullYear() + 1, 1 - 1, 1); 
			$('#payment1').countdown({until: countdown1.addHours(3)}); 
			$('#payment2').countdown({until: countdown2}); */
		});
	

        $("#small_investment").ionRangeSlider({
            type: "double",
            grid: true,
            min: 1000,
            max: 20000,
            from: 1,
            to: 5,
            step: 100,
            /*values: [0, 10, 100, 1000, 10000, 100000, 1000000],*/
		    onStart: function (data) {
		        
		    },
		    onChange: function (data) {
		        $("#lower-value").html(data.from) ;
		        $("#upper-value").html(data.to) ;
		    },
		    onFinish: function (data) {
		        $("#lower-value").html(data.from) ;
		        $("#upper-value").html(data.to) ;

				//event.preventDefault() 

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
			        	min 	 : data.from,
			        	max 	: data.to,
			        }, success: function( data ) {

			            $("#assignment_div_big").html(data) ;

			        }, error: function( data ) {
			        	var message = 'No member\'s for the selected range, please try a different range.' ;
			        	$("#assignment_div_big").html(message) ;
			            toast_notification('danger', message) ;
			        }
			    });
		    },
		    onUpdate: function (data) {
		        
		        $("#lower-value").html(data.from) ;
		        $("#upper-value").html(data.to) ;
		    }
        });

        $("#big_investment").ionRangeSlider({
            type: "double",
            grid: true,
            min: 20000,
            max: 50000,
            from: 1,
            to: 20,
            step: 500,
            /*values: [0, 10, 100, 1000, 10000, 100000, 1000000],*/
		    onStart: function (data) {
		        
		    },
		    onChange: function (data) {
		        $("#lower-value").html(data.from) ;
		        $("#upper-value").html(data.to) ;		        
		    },
		    onFinish: function (data) {
		        $("#lower-value").html(data.from) ;
		        $("#upper-value").html(data.to) ;

				//event.preventDefault() 

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
			        	min 	 : data.from,
			        	max 	: data.to,
			        }, success: function( data ) {

			            $("#assignment_div_big").html(data) ;

			        }, error: function( data ) {
			        	var message = 'No member\'s for the selected range, please try a different range.' ;
			        	$("#assignment_div_big").html(message) ;
			            //toast_notification('danger', message) ;
			        }
			    });		        
		    },
		    onUpdate: function (data) {
		        
		    }
        });


        var assign_me = function(id) {
        	var remaining_hours = new Date(); 
        	remaining_hours = remaining_hours.addHours(4) ;

        	$('#reserve_order').button('loading');


		    $.ajax({
		        url: "/assign_donar",
		        type:"POST",
		        beforeSend: function (xhr) {
		            var token 	= $('meta[name="csrf_token"]').attr('content') ;
		            if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
		        }, data: { 
		        	id:id
		        }, success: function( data ) {
		        	console.log(data) ;
		        	if ( data == "success" ) {
			            $( "#assignment_div_big" ).html( 
							"Successfully reserved" +
        				  	" Help, Please make a payment before "+
        				  	remaining_hours.getHours()+":"+
        				  	remaining_hours.getMinutes()+":"+
        				  	remaining_hours.getSeconds()+
        				  	" and await their approval"
			             ) ;
			            //toast_notification( "info", message ) ;		        		
		        	} else if( data == 'failed') {
		        		var message = "This message might be because a donation was reserved before you, please try a different range" ;
			            $( "#assignment_div_big" ).html( message ) ;
			            //toast_notification( "warning", message ) ;
		        	} else {
		        		$( "#assignment_div_big" ).html( data ) ;
		        	}
		        	$('#reserve_order').button('reset') ;
		        }, error: function( data ) {
		        	var message = "Technical error, please try again a different range, if the error persists, contact support" ;
		        	$("#assignment_div_big").html(data) ;
		            //toast_notification( "danger", message ) ;
		            $('#reserve_order').button('reset') ;
		        }
		    });
        };


		var secondary_level_token 	= $('meta[name="secondary_level_token"]').attr('content') ;
		var fallback_url 			= $('meta[name="fallback_url"]').attr('content') ;
		var individual_channel 		= "user"+secondary_level_token ;

/*		var socket = io.connect("http://192.168.10.10:8000") ;

		socket.on(individual_channel+":App\\Events\\YouHaveBeenReserved", function(message) {

			console.log('Client can get this:') ;
			console.log('--------------------') ;
			console.log(message) ;
		});*/

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
		        	updateFeeds = setInterval( feedUpdate, 30000 ) ;
		        }, error: function( data ) {
		        	console.log("Error") ;
		        }
		    });
		}

		var updateFeeds = setInterval( feedUpdate, 30000 ) ;

		var approve = function( num, id) {
        	$('#approve'+num).button('loading');


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
			            toast_notification( "info", "Successfully approved." ) ;		        		
		        	} else {
			            $( "#Inform" ).html("<div class='alert alert-success>"+data+"</div>") ;
			            toast_notification( "warning", data ) ;
		        	}
		        	$('#approve'+num).button('reset') ;
		        }, error: function( data ) {
		        	$( "#Inform" ).html("<div class='alert alert-success>"+data+"</div>") ;
		            $('#approve'+num).button('reset') ;
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
			            toast_notification( "info", "Successfully approved." ) ;		        		
		        	} else {
			            $( "#Inform" ).html("<div class='alert alert-success>"+data+"</div>") ;
			            toast_notification( "warning", data ) ;
		        	}
		        	$('#approve'+num).button('reset') ;
		        }, error: function( data ) {
		        	$( "#Inform" ).html("<div class='alert alert-success>"+data+"</div>") ;
		            $('#approve'+num).button('reset') ;
		        }
		    });
		};

	</script>

@endsection