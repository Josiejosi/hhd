@extends('layouts.front')

@section ('content')

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="row">

                    <div class="col-md-6 text-center">
                        <h1 class="text-mega text-default lter">404</h1>
                    </div>
                    <div class="col-md-6">
                        <h2 class="mb-0">Something is not right here</h2>
                        <p class="text-default lt lead">The page you are looking for cannot be found</p>

                        <div class="mt-40">
                            <a href="{{url('/')}}" class="myBtn myBtn-sm myBtn-3d myBtn-dark">
                                <i class="fa fa-home"></i> Return to home
                            </a>
                            <a 
                                href="{{url('/contactus')}}" 
                                class="myBtn myBtn-sm myBtn-3d myBtn-lightred">
                                <i class="fa fa-envelope-o"></i> Contact support
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- /page 404 -->

        </div>
    </section>

@endsection
