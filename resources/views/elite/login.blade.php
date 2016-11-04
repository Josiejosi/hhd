@extends('layouts.elitefront')

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

                <h3><i class="fa fa-unlock"></i> Login to Admin account</h3>

                @if ( session('account_not_found') )
                    <span class="alert alert-warning">
                        <strong>{{ session('account_not_found') }}</strong>
                    </span>
                @endif

                <form action="{{url('/admin/login')}}" method="post">

                    {!! csrf_field() !!}
                    
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label for="username">Email Address</label>
                            <input 
                                name="email" 
                                type="text" 
                                class="form-control myInput" 
                                value="{{ old('email') }}"
                                id="username" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control myInput" id="password" required>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="myBtn myBtn-rounded myBtn-dark m-0 mt-10">Login</button>
                        </div>

                    </div>
                </form>


            </div><!-- /login -->

        </div>
    </section>

@endsection