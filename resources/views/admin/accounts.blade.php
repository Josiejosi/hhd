@extends('layouts.backend')

@section ('css')

@section ('title', 'Scheduled')

@endsection

@section ('content')

    <div class="m-heading-1 border-green m-bordered">
        <h3>Manage my accounts</h3>
        <p> PLEASE NOTE: Only one account can be the active account per donation, and you can only add 3 accounts</p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-credit-card font-dark"></i>
                        <span class="caption-subject bold uppercase">Accounts</span>
                    </div>
                    <div class="tools"> 
                        <a class="btn btn-primary btn-xs" data-toggle="modal" href="#draggable"> Add New </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th> Bank </th>
                                <th> Account Number </th>
                                <th> Branch Code </th>
                                <th align="center"> <i class="icon-settings"></i> Settings </th>
                            </tr>
                        </thead>
                        <tbody id='accounts'>
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> 
                                    <button class="btn btn-xs btn-success">
                                        <i class="icon-check"></i>
                                    </button>
                                    <button class="btn btn-xs btn-danger">
                                        <i class="icon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add new bank account</h4>
                </div>
                <div class="modal-body"> 


                    <form action="{{url('/add_account')}}" method="post">

                            <div class="form-group col-md-12">
                                <h5><i class="fa fa-money"></i> Banking Details</h5>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="account_number">Account Number <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input 
                                    name="account_number" 
                                    id="account_number" 
                                    value="{{ old('account_number') }}"
                                    type="text" class="form-control myInput" id="account_number">
                            </div>


                            <div class="form-group col-md-12">
                                <label for="account_name">Bank <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <select id="account_name" name="account_name" placeholder="Bank" class="form-control myInput">
                                    <option>Please select</option>
                                    <option value="Absa Bank" @if ( old('account_name') == "Absa Bank" ) selected="selected" @endif >Absa Bank</option>
                                    <option value="African Bank" @if ( old('account_name') == "African Bank" ) selected="selected" @endif >African Bank</option> 
                                    <option value="Bitvest Bank" @if ( old('account_name') == "Bitvest Bank" ) selected="selected" @endif >Bitvest Bank</option>
                                    <option value="Capitec Bank" @if ( old('account_name') == "Capitec Bank" ) selected="selected" @endif >Capitec Bank</option>
                                    <option value="First National Bank" @if ( old('account_name') == "First National Bank" ) selected="selected" @endif >First National Bank</option>
                                    <option value="FirstRand Bank" @if ( old('account_name') == "FirstRand Bank" ) selected="selected" @endif >FirstRand Bank</option>
                                    <option value="Investec Bank" @if ( old('account_name') == "Investec Bank" ) selected="selected" @endif >Investec Bank</option>
                                    <option value="Nedbank" @if ( old('account_name') == "Nedbank" ) selected="selected" @endif >Nedbank</option>
                                    <option value="Standard Bank" @if ( old('account_name') == "Standard Bank" ) selected="selected" @endif >Standard Bank</option>
                                    <option value="UBank" @if ( old('account_name') == "UBank" ) selected="selected" @endif >UBank</option>
                                </select>
                            </div>



                            <div class="form-group col-md-12">
                                <label for="branch_code">Branch Code <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input 
                                    name="branch_code"
                                     value="{{ old('branch_code') }}" 
                                    type="text" 
                                    class="form-control myInput" 
                                    id="branch_code">

                            </div>
                        </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="submit" id="add_account" class="btn green">Add</button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section ('js')

    <script type="text/javascript">
        var get_account = function () {
            //accounts
            $("#accounts").html(
                        "<tr><td colspan='4'>" +
                        "Please be patient as we try and find your accounts.<br />" +
                        "@include ('includes.loader')" +
                        "</td><tr>"
            ) ;

            $.ajax({
                url: "/get_account",
                type:"POST",
                beforeSend: function (xhr) {
                    var token   = $('meta[name="csrf_token"]').attr('content') ;
                    if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
                }, success: function( data ) {

                    $("#accounts").html(data) ;

                }, error: function( data ) {
                    var message = 'No member\'s for the selected range, please try a different range.' ;
                    toast_notification('danger', message) ;
                }
            });
        };
        $("#add_account").on('click',function(){
            $.ajax({
                url: "/add_account",
                type:"POST",
                beforeSend: function (xhr) {
                    var token   = $('meta[name="csrf_token"]').attr('content') ;
                    if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
                }, data: { 
                    account_number : $("#account_number").val(),
                    account_name   : $("#account_name").val(),
                    branch_code    : $("#branch_code").val()
                }, success: function( data ) {

                    if ( data == 'success' ) {
                        toast_notification('success', "New account successfully added") ;
                        get_account() ;
                        $("#account_number").val("") ;
                        $("#account_name").val("") ;
                        $("#branch_code").val("") ;
                        $("#draggable").hide() ;
                    } else {
                        toast_notification('info', data) ;
                    }
                }, error: function( data ) {
                    var message = 'Failed to add a new account please try again later.' ;
                    toast_notification('danger', message) ;
                }
            }); 
        }) ;

        var delete_account = function(account_id) {
            bootbox.confirm("Are you sure, you want to trash this account?", function(result) {
                if ( result == true ) {

                    $.ajax({
                        url: "/delete_account",
                        type:"POST",
                        beforeSend: function (xhr) {
                            var token   = $('meta[name="csrf_token"]').attr('content') ;
                            if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
                        }, data: { 
                            account_id      : account_id,
                        }, success: function( data ) {

                            if (data == 'success') {
                                toast_notification( 'success', 'Account successfully trashed' ) ;
                                get_account() ;
                            } else {
                                toast_notification( 'info', data ) ;
                            }

                        }, error: function( data ) {
                            toast_notification('danger', 'Failed to trash account, please try again later.') ;
                        }
                    });              
                }
            });
        } ;

        var activate_account = function(account_id) {
            bootbox.confirm("Are you sure, you want to make this your primary account?", function(result) {
                if ( result == true ) {

                    $.ajax({
                        url: "/activate_account",
                        type:"POST",
                        beforeSend: function (xhr) {
                            var token   = $('meta[name="csrf_token"]').attr('content') ;
                            if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
                        }, data: { 
                            account_id      : account_id,
                        }, success: function( data ) {

                            if (data == 'success') {
                                toast_notification( 'success', 'Primary account changed' ) ;
                                get_account() ;
                            } else {
                                toast_notification( 'info', data ) ;
                            }

                        }, error: function( data ) {
                            toast_notification('danger', 'Failed to make this account primary, please try again later.') ;
                        }
                    });              
                }
            });
        };

        get_account() ;
    </script>

@endsection