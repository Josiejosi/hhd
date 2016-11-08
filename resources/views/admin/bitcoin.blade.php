@extends('layouts.backend')

@section ('css')

@section ('title', 'Bitcoins addresses')

@endsection

@section ('content')

    <div class="m-heading-1 border-green m-bordered">
        <h3>Manage bitcoin addresses</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-credit-card font-dark"></i>
                        <span class="caption-subject bold uppercase">Addresses</span>
                    </div>
                    <div class="tools"> 
                        <a class="btn btn-primary btn-xs" data-toggle="modal" href="#draggable"> Add New </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th> Label </th>
                                <th> Addresses </th>
                                <th align="center"> <i class="icon-settings"></i> Settings </th>
                            </tr>
                        </thead>
                        <tbody id='bitcoins_addresses'>
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td> 
                                    <button class="btn btn-xs btn-success">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <button class="btn btn-xs btn-danger">
                                        <i class="fa fa-trash"></i>
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


                    <form action="{{url('/add_bitcoin_account')}}" method="post">

                            <div class="form-group col-md-12">
                                <h5><i class="fa fa-money"></i> New bitcoin address</h5>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="bitcoin_label">Label <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input 
                                    name="bitcoin_label" 
                                    id="bitcoin_label" 
                                    value="{{ old('bitcoin_label') }}"
                                    type="text" class="form-control myInput">
                            </div>





                            <div class="form-group col-md-12">
                                <label for="bitcoin_address">Address <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input 
                                    name="bitcoin_address"
                                     value="{{ old('bitcoin_address') }}" 
                                    type="text" 
                                    class="form-control myInput" 
                                    id="bitcoin_address">

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
            $("#bitcoins_addresses").html(
                        "<tr><td colspan='4'>" +
                        "Please be patient as we try and find your accounts.<br />" +
                        "@include ('includes.loader')" +
                        "</td><tr>"
            ) ;

            $.ajax({
                url: "/get_bitcoin_accounts",
                type:"POST",
                beforeSend: function (xhr) {
                    var token   = $('meta[name="csrf_token"]').attr('content') ;
                    if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
                }, success: function( data ) {

                    $("#bitcoins_addresses").html(data) ;
                    console.log(data) ;
                }, error: function( data ) {
                    var message = 'No member\'s for the selected range, please try a different range.' ;
                    $("#bitcoins_addresses").html(data) ;
                }
            });
            
        };
        $("#add_account").on('click',function(){
            $.ajax({
                url: "/add_bitcoin_account",
                type:"POST",
                beforeSend: function (xhr) {
                    var token   = $('meta[name="csrf_token"]').attr('content') ;
                    if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
                }, data: { 
                    bitcoin_address : $("#bitcoin_address").val(),
                    bitcoin_label   : $("#bitcoin_label").val()
                }, success: function( data ) {

                    if ( data == 'success' ) {
                        alert("New account successfully added") ;
                        get_account() ;
                        $("#bitcoin_address").val("") ;
                        $("#bitcoin_label").val("") ;
                        $("#draggable").hide() ;
                    } else {
                        alert(data) ;
                    }
                }, error: function( data ) {
                    var message = 'Failed to add a new address please try again later.' ;
                    alert(message) ;
                }
            }); 
        }) ;

        var delete_account = function(id) {
            if ( confirm( "Are you sure, you want to trash this address?" ) ) {
                //if ( result == true ) {

                $.ajax({
                    url: "/delete_bitcoin_account",
                    type:"POST",
                    beforeSend: function (xhr) {
                        var token   = $('meta[name="csrf_token"]').attr('content') ;
                        if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
                    }, data: { 
                        id      : id,
                    }, success: function( data ) {

                        if (data == 'success') {
                            //toast_notification( 'success', 'Account successfully trashed' ) ;
                            alert('Account successfully trashed') ;
                            get_account() ;
                        } else {
                            alert(data) ;
                        }

                    }, error: function( data ) {
                        //toast_notification('danger', 'Failed to trash account, please try again later.') ;
                        alert('Failed to trash account, please try again later.') ;
                    }
                });              
                //}
            }
        } ;

        var activate_account = function(id) {
            if ( confirm("Are you sure, you want to make this your primary address?" ) ) {
                //if ( result == true ) {

                $.ajax({
                    url: "/activate_account",
                    type:"POST",
                    beforeSend: function (xhr) {
                        var token   = $('meta[name="csrf_token"]').attr('content') ;
                        if (token) return xhr.setRequestHeader('X-CSRF-TOKEN', token) ;
                    }, data: { 
                        id      : id,
                    }, success: function( data ) {

                        if (data == 'success') {
                            alert('Primary account changed' ) ;
                            get_account() ;
                        } else {
                            alert(data ) ;

                        }

                    }, error: function( data ) {
                        alert('Failed to make this account primary, please try again later.') ;
                    }
                });              
                //}
            }
        };
        
        get_account() ;
    </script>

@endsection