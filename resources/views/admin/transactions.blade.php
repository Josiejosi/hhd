@extends('layouts.backend')

@section ('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.bootstrap.css') }}">
@endsection

@section ('title', 'Transcations')

@section ('content')

	<div class="invoice">
        <div class="row invoice-logo">
            <div class="col-xs-6 invoice-logo-space">
            </div>
            <div class="col-xs-6">
                <h3> Transcation History </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
            	<div id="Inform"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 table-responsive">
            	
                <table class="table table-striped table-hover" id="active_transactions">
                    <thead>
                        <tr>
                            <th> Name </th>
                            <th> Amount </th>
                            <th> <i class="fa fa-gear"></i> </th>
                        </tr>
                    </thead>
                    <tbody>
                    	@if ( count($transactions) > 0)
                    		<?php $i=1 ; ?>
                    		@foreach ( $transactions as $transaction )
	                         <tr>
	                         	<?php
	                         		$user_count = \App\Models\User::where('id',$transaction->sender)->count() ;
	                         		$name = '' ;
	                         		if ( $user_count == 1 ) {
	                         			$user = \App\Models\User::where('id',$transaction->sender)->first() ;
	                         			$name = $user->first_name . " " . $user->last_name ;
	                         		}
	                         	?>
	                            <td> {{$name}} </td>
	                            <td> R {{ $transaction->amount }} </td>
	                            <td> 
		                            <button 
		                            	class="btn btn-xs btn-success" 
		                            	id="approve{{$i}}" 
		                            	onclick="approve( {{$i}}, {{ $transaction->id }})">
		                            	<i class="fa fa-check-square"></i> Approve
		                            </button>
	                            </td>
	                        </tr>
	                        <?php $i++ ; ?>
                        	@endforeach
                        @else
						<tr>
                            <td colspan="3">Nothing to approve here</td>
                        </tr>                        
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section ('js')
	<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/datatables.bootstrap.js') }}"></script>
	<script type="text/javascript">
		
/*		$("#active_transactions").dataTable(

			{

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No Transcations",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No Transcations found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search for transcations:",
                "zeroRecords": "No matching records found"
            }
         }

		) ;*/
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
			            toast_notification( "info", message ) ;		        		
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