@extends('layouts.elite')

@section ('css')

@section ('title', 'Elite Members')

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
                                    <th> Member Since </th>
                                    <th> <span><i class='fa fa-cogs'></i></span> </th>
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
        	                            <td> {{ $member->created_at }} </td>
                                        <td> 

                                            <button class="btn btn-xs btn-danger" onclick="trash_account('{{ $member->id }}')">
                                                <i class="fa fa-trash"></i>
                                            </button>  

                                        </td>
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

    <script type="text/javascript">

        function trash_account(id) {
            if ( confirm("Remove account from the system?") ) {
                $.get("/admin/remove/member/"+id, function(data) {
                    alert(data) ;
                    location.reload() ;
                }) ;
            }
        }

    </script>

@endsection