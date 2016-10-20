@extends('layouts.front')

@section ('content')

    <section id="content">
        <div class="content-wrap">

            <div class="container clearfix w-3xl">

                <h3><i class="fa fa-unlock"></i> Login to your account</h3>

                @if (Session::has('account_not_found'))
                    <div class="alert alert-warning">
                        <strong>{{ Session::get('account_not_found') }}</strong>
                    </div>
                @endif

                <form action="{{url('/signin')}}" method="post">

                    {!! csrf_field() !!}
                    
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label for="username">Email Address</label>
                            <input 
                                name="username" 
                                type="text" 
                                class="form-control myInput" 
                                value="{{ old('username') }}"
                                id="username" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control myInput" id="password" required>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="myBtn myBtn-rounded myBtn-dark m-0 mt-10">Login</button>
                            <a href="{{url('/forgot')}}" class="pull-right">Forgot Password?</a>
                        </div>

                    </div>
                </form>

                <div class="header-line mt-40">
                    <h4><a href="{{url('/join')}}">Or Create new account</a></h4>
                </div>


            </div>

        </div>
    </section>

@endsection