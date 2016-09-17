@extends('layouts.elite')

@section ('css')

@section ('title', 'Scheduled')

@endsection

@section ('content')
    <div class="m-heading-1 border-green m-bordered">
        <h3>Scheduled Donations</h3>
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
                                    <th> Donee </th>
                                    <th> Donar </th>
                                    <th> Percentage </th>
                                    <th> Waiting Period </th>
                                    <th> Amount </th>
                                    <th> Status </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ( !empty($donations) )
                                    <?php $i=1 ; ?>
                                    @foreach ( $donations as $donation )
                                     <tr>
                                        <td> 
                                            <?php
                                                $receiver = $donation->receiver ;

                                                $user       = App\Models\User::where('id', $receiver)->first() ;

                                                echo  $user->first_name . " " . $user->last_name ;
                                            ?>
                                        </td>
                                        <td> 
                                            <?php
                                                $sender = $donation->sender ;
                                                if ( App\Models\User::where('id', $sender)->count() > 0 ) {
                                                    $user       = App\Models\User::where('id', $sender)->first() ;
                                                    echo  $user->first_name . " " . $user->last_name ;
                                                } else {
                                                    echo "Not assigned a member yet." ;
                                                }
                                            ?>
                                        </td>
                                        <td> {{$donation->donation_percentage}} % </td>
                                        <td> {{$donation->donation_days}} % </td>
                                        <td> R {{ $donation->amount }} </td>
                                        <td> 
                                            @if ( $donation->donation_status == 0 )
                                                Not Assigned
                                            @endif 
                                            @if ( $donation->donation_status == 1 )
                                                Pending for payment
                                            @endif
                                            @if ( $donation->donation_status == 2 )
                                                Donar moved to schedule
                                            @endif
                                        </td>
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