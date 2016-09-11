@extends('layouts.backend')

@section ('css')

@section ('title', 'Scheduled')

@endsection

@section ('content')
    <div class="m-heading-1 border-green m-bordered">
        <h3>My Scheduled Donations</h3>
        <p> PLEASE NOTE: Once a member has approved your payment, your scheduled donations will be in here, and moved to active donations once they reached maturity.</p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-calender-plus-o font-dark"></i>
                        <span class="caption-subject bold uppercase">Scheduled</span>
                    </div>
                </div>
                <div class="portlet-body">
                    
            	
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
                                    <td colspan="3">Nothing approved yet.</td>
                                </tr>                        
                                @endif
                            </tbody>
                        </table>
               </div>
            </div>
        </div>
    </div>


@endsection

@section ('js')



@endsection