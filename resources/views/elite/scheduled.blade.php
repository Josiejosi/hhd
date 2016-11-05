@extends('layouts.elite')

@section ('css')

@section ('title', 'Cash-in Funds Status')

@endsection

@section ('content')
    <div class="m-heading-1 border-green m-bordered">
        <h3>Cash-in Funds Status</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-calender-plus-o font-dark"></i>
                        <span class="caption-subject bold uppercase">Cash-in Funds Status</span>
                    </div>
                </div>
                <div class="portlet-body">
                    
                
                        <table class="table table-striped table-hover" id="active_transactions">
                            <thead>
                                <tr>
                                    <th> User </th>
                                    <th> Percentage </th>
                                    <th> Available </th>
                                    <th> Amount </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ( !empty($scheduled) )
                                    <?php $i=1 ; ?>
                                    @foreach ( $scheduled as $schedule )
                                     <tr>
                                        <td> 
                                            <?php
                                                $user_id = $schedule->user_id ;

                                                $user       = App\Models\User::where('id', $user_id)->first() ;

                                                echo  $user->first_name . " " . $user->last_name ;
                                            ?>
                                        </td>
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