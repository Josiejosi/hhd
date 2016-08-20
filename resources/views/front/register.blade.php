@extends('layouts.front')

@section ('content')

    <section id="content">
        <div class="content-wrap">

                <!-- ============ sign up ============ -->
                <div class="container clearfix w-3xl">

                    <h3><i class="fa fa-lock"></i> Register a new account</h3>

                    @if (Session::has('account_creation_error'))
                        <span class="alert alert-warning">
                            <strong>{{ Session::get('account_creation_error') }}</strong>
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


                            <div class="form-group col-md-12">
                                <label>
                                    <div class="checker"><span><input type="checkbox"></span></div> 
                                    Having read the <a href="{{url('/warning')}}">WARNING</a> , I am well aware fully of the risks. Being in sound mind, I have decided to become a member of PrestigeWallet. 
                                </label>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="myBtn myBtn-rounded myBtn-dark m-0 mt-10">Register Now</button>
                            </div>

                        </div>
                    </form>


                </div><!-- /sign up -->

        </div>
    </section>

@endsection