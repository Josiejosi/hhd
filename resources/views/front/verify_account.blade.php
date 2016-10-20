@extends('layouts.front')

@section ('content')

    <section id="content">
        <div class="content-wrap">

            <div class="container clearfix w-3xl">

                <div class="row">

                    <div class="col-md-8">

                        <div class="heading-block mb-60">
                            <h2 class="text-uppercase"><span class="text-theme">Verify Account</h2>

                        </div>

                        <form id="contactForm"  action="{{url('/verify_account')}}" method="post">

                            {!! csrf_field() !!}


                            <div class="row">
                                @if (!Session::has('account_not_found'))
                                <div class="alert alert-info">An SMS was send to your phone, please provide the verification code to continue using the app</div>
                                @endif
                                @if (Session::has('account_not_found'))
                                    <div class="alert alert-warning">
                                        <strong>{{ Session::get('account_not_found') }}</strong>
                                    </div>
                                @endif
                                <div class="form-group col-sm-12">
                                    <label for="verification_code">Enter Verification code <span class="text-lightred" style="font-size: 15px">*</span></label>
                                    <input name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}">                                    

                                    <input name="verification_code" type="text" class="form-control myInput" id="verification_code"
                                    value="{{ old('verification_code') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block error-message">
                                            <strong>{{ $errors->first('verification_code') }}</strong>
                                        </span>
                                    @endif 
                                </div>

                                <button type="submit" class="myBtn myBtn-rounded myBtn-lg myBtn-3d m-0 mt-12">
                                    Verify Account
                                </button>
                                
                            </div>
                        </form>
                    </div>
                </div>                

            </div>

        </div>
    </section>

@endsection