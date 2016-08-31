@extends('layouts.backend')

@section ('css')

@section ('title', 'Scheduled')

@endsection

@section ('content')
	<div class="invoice">
        <div class="row invoice-logo">
            <div class="col-xs-6 invoice-logo-space">
            </div>
            <div class="col-xs-6">
                <h3> Scheduled Dreams </h3>
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
                            <th> Percentage </th>
                            <th> Scheduled For </th>
                            <th> Amount </th>
                        </tr>
                    </thead>
                    <tbody>
                    	@if ( count($scheduled) > 0)
                    		<?php $i=1 ; ?>
                    		@foreach ( $scheduled as $schedule )
	                         <tr>
	                            <td> {{$schedule->schedule_percentage}} % </td>
	                            <td> {{ $schedule->schedule_for->diffForHumans() }} </td>
	                            <td> R {{ $schedule->amount }} </td>
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



@endsection