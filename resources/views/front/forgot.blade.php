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

            <!-- ============ login ============ -->
            <div class="container clearfix w-3xl">

                <h3><i class="fa fa-unlock"></i> Login to your account</h3>

                @if (Session::has('account_creation_error'))
                    <div class="alert alert-warning">
                        <strong>{{ Session::get('account_not_found') }}</strong>
                    </div>
                @endif

                <form action="{{url('/forgot')}}" method="post">

                    {!! csrf_field() !!}
                    
                    <div class="row">

                        <div class="col-md-6 col-md-offset-3">

                            <div class="form-group col-md-12">
                                <label for="email">Email Address</label>
                                <input 
                                    name="email" 
                                    type="text" 
                                    class="form-control myInput" 
                                    value="{{ old('email') }}"
                                    id="email">
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-md btn-success">Reset</button>
                            </div>

                        </div>

                        <div class="header-line mt-40">
                            <h4><a href="{{url('/signin')}}">Or Login</a></h4>
                        </div>

                    </div>
                </form>




            </div><!-- /login -->

        </div>
    </section>

@endsection