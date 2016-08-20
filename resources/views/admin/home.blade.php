@extends('layouts.backend')

@section ('title', 'Home')

@section ('css')

	<link rel="stylesheet" type="text/css" href="{{asset('css/ion.rangeSlider.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/ion.rangeSlider.skinFlat.css')}}">

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

	<div class="row widget-row">

	    <div class="col-md-3">
	        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
	            <h4 class="widget-thumb-heading">Payment to Tebogo Sewape Expires in :</h4>
	            <div class="widget-thumb-wrap">
	                <div class="widget-thumb-body">
	                    <span class="widget-thumb-body-stat">
	                    	<div id="payment1"></div>
	                    </span>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="col-md-3">
	        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
	            <h4 class="widget-thumb-heading">Payment to Josef Expires in :</h4>
	            <div class="widget-thumb-wrap">
	                <div class="widget-thumb-body">
	                    <span class="widget-thumb-body-stat">
	                    	<div id="payment2"></div>
	                    </span>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>


	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#small" data-toggle="tab" aria-expanded="false"> Small Investment </a>
		</li>
		<li class="">
			<a href="#big" data-toggle="tab" aria-expanded="true"> Big Investment </a>
		</li>
	</ul>

	<div class="tab-content">

		<div class="tab-pane fade active in" id="small">
			<div class="note note-info">
				<h4 class="block">Small Investment</h4>
				<p> Please select help from ZAR 500 - ZAR 20 000</p>
			</div>
            <div class="form-group">
                <div class="col-md-12">
                    <input id="small_investment" type="text" value="" />
                </div>
            </div>
			<p class="text-center">	Between R 
				<span id="lower-value"></span> and R 
				<span id="upper-value"></span>
				<br />
			</p>
		</div>

		<div class="tab-pane fade in" id="big">
			<div class="note note-info">
				<h4 class="block">Big Investment</h4>
				<p> Please select help from ZAR 20 000 - ZAR 50 000</p>
			</div>

            <div class="form-group">
                <div class="col-md-2">
                    <input id="big_investment" type="text" value="" />
                </div>
            </div>
			<p class="text-center">	Between R 
				<span id="lower-value2"></span> and R 
				<span id="upper-value2"></span>
				<br />
			</p>
			
		</div>

	</div>

	<div id="assignment_div_big"></div>
	

@endsection

@section ('js')

	<script src="{{asset('js/ion.rangeSlider.min.js')}}" type="text/javascript"></script>
	<script type="text/javascript">

		$(function(){
			var countdown1 = new Date(); 
			var countdown2 = new Date(); 
			//var countdown2 = new Date(2016, 08, 18, 12, 45, 00, 00);
			//countdown = new Date(countdown.getFullYear() + 1, 1 - 1, 1); 
			$('#payment1').countdown({until: countdown1.addHours(3)}); 
			$('#payment2').countdown({until: countdown2}); 
		});
	

        $("#small_investment").ionRangeSlider({
            type: "double",
            grid: true,
            min: 500,
            max: 20000,
            from: 1,
            to: 5,
            step: 100,
            /*values: [0, 10, 100, 1000, 10000, 100000, 1000000],*/
		    onStart: function (data) {
		        console.log('started');
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
					"Please be patient as we looker for a suitable match for your help request.<br />" +
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
			        	var message = 'Technical error, please try again a different range, if the error persists, contact support' ;
			        	$("#assignment_div_big").html(message) ;
			            toast_notification('danger', message) ;
			        }
			    });
		    },
		    onUpdate: function (data) {
		        console.log(data);
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
		        console.log("onStart");
		    },
		    onChange: function (data) {
		        console.log("onChange");
		    },
		    onFinish: function (data) {
		        console.log("onFinish");
		    },
		    onUpdate: function (data) {
		        console.log("onUpdate");
		    }
        });


        var assign_me = function(id) {
        	var remaining_hours = new Date(); 
        	remaining_hours = remaining_hours.addHours(4) ;

        	var message = 'Successfully reserved' +
        				  ' Help, Please make a payment before '+
        				  remaining_hours.getHours()+':'+
        				  remaining_hours.getMinutes()+':'+
        				  remaining_hours.getSeconds()+
        				  ' and await their approval' ;

        	$("#assignment_div_big").html("") ;
        	toast_notification('info', message) ; 
        	//success, failed

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
		        	if ( data == 'success' ) {
			            $("#assignment_div_big").html(message) ;
			            toast_notification('success', message) ;		        		
		        	} else {
		        		var message = 'This message might be because help was reserved before you, please try a different range' ;
			            $("#assignment_div_big").html(message) ;
			            toast_notification('info', message) ;
		        	}
		        }, error: function( data ) {
		        	var message = 'Technical error, please try again a different range, if the error persists, contact support' ;
		        	$("#assignment_div_big").html(message) ;
		            toast_notification('danger', message) ;
		        }
		    });
        };

	</script>

@endsection