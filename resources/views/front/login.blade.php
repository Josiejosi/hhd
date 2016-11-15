@extends('layouts.front')

@section ('content')


    <div id="fh5co-cut">
        <div class="container">
            <div class="row row-bottom-padded-lg">
                <div class="col-md-12 section-heading text-center">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 to-animate"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <section id="content">
        <div class="content-wrap">

            <div class="container clearfix w-3xl">

                <div class="faqHeader"><i class="fa fa-unlock"></i> Login to your account</div>

                @if (Session::has('account_not_found'))
                    <div class="alert alert-warning">
                        <strong>{{ Session::get('account_not_found') }}</strong>
                    </div>
                @endif

                <form action="{{url('/signin')}}" method="post">

                    {!! csrf_field() !!}
                    
                    <div class="row">

                        <div class="col-md-6 col-md-offset-3">

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
                                <button type="submit" class="btn btn-md btn-success">Login</button>
                                <a href="{{url('/forgot')}}" class="pull-right">Forgot Password?</a>
                            </div>

                        </div>

                    </div>
                </form>

                <div class="header-line mt-40">
                    <h4><a href="{{url('/signup')}}">Or Create new account</a></h4>
                </div>


            </div>

        </div>
    </section>

@endsection