@extends('layouts.elite')

@section ('css')

@section ('title', 'Scheduled')

@endsection

@section ('content')
    <div class="m-heading-1 border-green m-bordered">
        <h3>New Elite Members</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-calender-plus-o font-dark"></i>
                        <span class="caption-subject bold uppercase">Add Member</span>
                    </div>
                </div>
                <div class="portlet-body">

	                @if (Session::has('message'))
	                    <span class="alert alert-warning">
	                        <strong>{{ Session::get('message') }}</strong>
	                    </span>
	                @endif
                    <form action="{{url('/signup')}}" method="post">

                        {!! csrf_field() !!}

                        <div class="row">

                            <div class="form-group col-md-12">
                                <label for="first_name">First Name <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input name="first_name" 
                                        type="text" 
                                        class="form-control myInput" 
                                        id="first_name"
                                        value="{{ old('first_name') }}">
                                @if ($errors->has('first_name'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif 
                            </div>                           

                            <div class="form-group col-md-12">
                                <label for="last_name">Last Name <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input name="last_name" 
                                        value="{{ old('last_name') }}" 
                                        type="text" class="form-control myInput" 
                                        id="last_name">
                                    @if ($errors->has('last_name'))
                                        <span class="help-block error-message">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                            </div> 

                            <div class="form-group col-md-12">
                                <label for="email">Email <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input 
                                        name="email" 
                                        value="{{ old('email') }}"
                                        type="email" class="form-control myInput" id="email">

                                @if ($errors->has('email'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label for="cell_phone">Phone <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input 
                                        name="cell_phone" 
                                        value="{{ old('cell_phone') }}"
                                        type="text" 
                                        class="form-control myInput" 
                                        id="cell_phone">

                                        @if ($errors->has('cell_phone'))
                                            <span class="help-block error-message">
                                                <strong>{{ $errors->first('cell_phone') }}</strong>
                                            </span>
                                        @endif 
                            </div>



                            <div class="form-group col-md-12">
                                <label for="password">Password <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input 
                                    name="password" 
                                    type="password" 
                                    class="form-control myInput" 
                                    id="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block error-message">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>

 

                            <div class="form-group col-md-12">
                                <label for="password_confirmation">Password Confirm <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input 
                                    name="password_confirmation" 
                                    type="password" 
                                    
                                    class="form-control myInput" 
                                    id="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block error-message">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif 
                            </div>


                            <div class="form-group col-md-12">
                                <h5><i class="fa fa-money"></i> Banking Details</h5>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="account_number">Account Number <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input name="account_number" 
                                    value="{{ old('account_number') }}"
                                    type="text" class="form-control myInput" id="account_number">
                                @if ($errors->has('account_number'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('account_number') }}</strong>
                                    </span>
                                @endif 
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
                                    <option value="Societe Generale JHB" @if ( old('account_name') == "Societe Generale JHB" ) selected="selected" @endif >Societe Generale JHB</option>
                                    <option value="SA Bank of Athens" @if ( old('account_name') == "SA Bank of Athens" ) selected="selected" @endif >SA Bank of Athens</option>
                                    <option value="Standard Bank" @if ( old('account_name') == "Standard Bank" ) selected="selected" @endif >Standard Bank</option>
                                    <option value="UBank" @if ( old('account_name') == "UBank" ) selected="selected" @endif >UBank</option>
                                    

                                </select>
                                @if ($errors->has('account_name'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('account_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label for="branch_code">Branch Code <span class="text-lightred" style="font-size: 15px">*</span></label>
                                <input 
                                    name="branch_code"
                                     value="{{ old('branch_code') }}" 
                                    type="text" 
                                    class="form-control myInput" 
                                    id="branch_code">

                                @if ($errors->has('branch_code'))
                                    <span class="help-block error-message">
                                        <strong>{{ $errors->first('branch_code') }}</strong>
                                    </span>
                                @endif
                            </div>



                            <div class="col-md-12">
                                <button type="submit" id="submit_btn" class="btn btn-success">Register Now</button>
                            </div>

                        </div>
                    </form>

               </div>
            </div>
        </div>
    </div>


@endsection

@section ('js')



@endsection
