@extends('layouts.backend')

@section ('css')

@section ('title', 'Scheduled')

@endsection

@section ('content')

    <div class="m-heading-1 border-green m-bordered">
        <h3>Manage my accounts</h3>
        <p> PLEASE NOTE: Only one account can be the active account per donation, and you can only add 3 account</p>
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
                                <td> Standard </td>
                                <td> 10023698 </td>
                                <td> 12566 </td>
                                <td> 
                                    <button class="btn btn-xs btn-success">
                                        <i class="icon-check"></i>
                                    </button>
                                    <button class="btn btn-xs btn-info">
                                        <i class="icon-pencil"></i>
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
                                    <option value="alBaraka Bank" @if ( old('account_name') == "alBaraka Bank" ) selected="selected" @endif >alBaraka Bank</option>
                                    <option value="Bank of Baroda" @if ( old('account_name') == "Bank of Baroda" ) selected="selected" @endif >Bank of Baroda</option>
                                    <option value="Bank of China" @if ( old('account_name') == "Bank of China" ) selected="selected" @endif >Bank of China</option>
                                    <option value="Bank of Taiwan" @if ( old('account_name') == "Bank of Taiwan" ) selected="selected" @endif >Bank of Taiwan</option>
                                    <option value="Bitvest Bank" @if ( old('account_name') == "Bitvest Bank" ) selected="selected" @endif >Bitvest Bank</option>
                                    <option value="BNP Paribas" @if ( old('account_name') == "BNP Paribas" ) selected="selected" @endif >BNP Paribas</option>
                                    <option value="Capitec Bank" @if ( old('account_name') == "Capitec Bank" ) selected="selected" @endif >Capitec Bank</option>
                                    <option value="China Construction Bank" @if ( old('account_name') == "China Construction Bank" ) selected="selected" @endif >China Construction Bank</option>
                                    <option value="Citibank N.A" @if ( old('account_name') == "Citibank N.A" ) selected="selected" @endif >Citibank N.A</option>
                                    <option value="Deutsche Bank AG" @if ( old('account_name') == "Deutsche Bank AG" ) selected="selected" @endif >Deutsche Bank AG</option>
                                    <option value="FinBond Mutual Bank" @if ( old('account_name') == "FinBond Mutual Bank" ) selected="selected" @endif >FinBond Mutual Bank</option>
                                    <option value="First National Bank" @if ( old('account_name') == "First National Bank" ) selected="selected" @endif >First National Bank</option>
                                    <option value="FirstRand Bank" @if ( old('account_name') == "FirstRand Bank" ) selected="selected" @endif >FirstRand Bank</option>
                                    <option value="GBS Mutual Bank" @if ( old('account_name') == "GBS Mutual Bank" ) selected="selected" @endif >GBS Mutual Bank</option>
                                    <option value="Grindrod Bank" @if ( old('account_name') == "Grindrod Bank" ) selected="selected" @endif >Grindrod Bank</option>
                                    <option value="Habib Overseas Bank" @if ( old('account_name') == "Habib Overseas Bank" ) selected="selected" @endif >Habib Overseas Bank</option>
                                    <option value="HBZ Bank" @if ( old('account_name') == "HBZ Bank" ) selected="selected" @endif >HBZ Bank</option>
                                    <option value="HSBC Bank" @if ( old('account_name') == "HSBC Bank" ) selected="selected" @endif >HSBC Bank</option>
                                    <option value="Investec Bank" @if ( old('account_name') == "Investec Bank" ) selected="selected" @endif >Investec Bank</option>
                                    <option value="Habib Overseas Bank" @if ( old('account_name') == "Habib Overseas Bank" ) selected="selected" @endif >Habib Overseas Bank</option>
                                    <option value="HBZ Bank" @if ( old('account_name') == "HBZ Bank" ) selected="selected" @endif >HBZ Bank</option>
                                    <option value="HSBC Bank" @if ( old('account_name') == "HSBC Bank" ) selected="selected" @endif >HSBC Bank</option>
                                    <option value="Investec Bank" @if ( old('account_name') == "Investec Bank" ) selected="selected" @endif >Investec Bank</option>
                                    <option value="Ithala" @if ( old('account_name') == "Ithala" ) selected="selected" @endif >Ithala </option>
                                    <option value="JP Morgan Chase" @if ( old('account_name') == "JP Morgan Chase" ) selected="selected" @endif >JP Morgan Chase</option>
                                    <option value="Mercantile Bank" @if ( old('account_name') == "Mercantile Bank" ) selected="selected" @endif >Mercantile Bank</option>
                                    <option value="Nedbank" @if ( old('account_name') == "Nedbank" ) selected="selected" @endif >Nedbank</option>
                                    <option value="Sasfin Bank" @if ( old('account_name') == "Sasfin Bank" ) selected="selected" @endif >Sasfin Bank</option>
                                    <option value="Societe Generale JHB" @if ( old('account_name') == "Societe Generale JHB" ) selected="selected" @endif >Societe Generale JHB</option>
                                    <option value="Standard Chartered Bank" @if ( old('account_name') == "Standard Chartered Bank" ) selected="selected" @endif >Standard Chartered Bank</option>
                                    <option value="State Bank of India" @if ( old('account_name') == "State Bank of India" ) selected="selected" @endif >State Bank of India</option>
                                    <option value="SA Bank of Athens" @if ( old('account_name') == "SA Bank of Athens" ) selected="selected" @endif >SA Bank of Athens</option>
                                    <option value="Standard Bank" @if ( old('account_name') == "Standard Bank" ) selected="selected" @endif >Standard Bank</option>
                                    <option value="UBank" @if ( old('account_name') == "UBank" ) selected="selected" @endif >UBank</option>
                                    <option value="VBS Mutual Bank" @if ( old('account_name') == "VBS Mutual Bank" ) selected="selected" @endif >VBS Mutual Bank</option>

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
            bootbox.confirm("Are you sure, you want make this your primary account?", function(result) {
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