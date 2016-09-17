@extends('layouts.elite')

@section ('css')

@section ('title', 'Scheduled')

@endsection

@section ('content')
    <div class="m-heading-1 border-green m-bordered">
        <h3>All Elite Members</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-calender-plus-o font-dark"></i>
                        <span class="caption-subject bold uppercase">Members</span>
                    </div>
                </div>
                <div class="portlet-body">
                    
            	
                        <table class="table table-striped table-hover" id="active_transactions">
                            <thead>
                                <tr>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Cell </th>
                                </tr>
                            </thead>
                            <tbody>
                            	@if ( !empty($members) )
                            		<?php $i=1 ; ?>
                            		@foreach ( $members as $member )
        	                         <tr>
        	                            <td> {{$member->first_name}} {{$member->last_name}} </td>
        	                            <td> {{ $member->email }} </td>
                                        <td> {{ $member->cell_phone }} </td>
        	                        </tr>
        	                        <?php $i++ ; ?>
                                	@endforeach
                                @else
        						<tr>
                                    <td colspan="4">No elite.</td>
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