@extends('layouts.front')

@section ('content')
	@include('includes.slide')
    <section id="content">
        <div class="content-wrap">
		    <!-- ============ Features ============ -->
		    <div class="container clearfix">

		        <div class="center-block less-width text-center clearfix">
		            <img class="mb-40" src="{{asset('imgs/logo-lg.png')}}" alt="">
		            <h1>Hello! Ready to try <span class="text-greensea">PrestigeWallet</span>?</h1>
		            <a href="{{url('/signin')}}" class="myBtn myBtn-3d myBtn-dark myBtn-lg ">Login</a>
		            <a href="{{url('/signup')}}" class="myBtn myBtn-3d myBtn-lg">Register</a>
		        </div>

		        <div class="line"></div>

		    </div><!-- /features -->

		    <!-- ============ Parallax box ============ -->
		    <div class="parallax-box parallax-1 dark" data-stellar-background-ratio="0.3">

		        <div class="container clearfix">

		            <div class="row">

		                <div class="col-md-6">
		                    <h1 class="text-white text-light text-uppercase mb-0">Prestige</h1>
		                    <h1 class="text-white text-xxl text-uppercase" style="line-height: 60px">Wallet</h1>

		                    <p class="lead text-ondark mb-60">
		                        We tried to make our system clean, and easy to use.<br />
		                        <q><em>Like all magnificent things, it's very simple.</em></q><br />
		                        &#45;Natalie Babbitt, Tuck Everlasting
		                        <br /><br />
		                        <q><em>If you can't explain it to a six year old, you don't understand it yourself.</em></q><br />
		                        &#45;Albert Einstein
		                        <br />Our gift to you.
		                    </p>

		                    <a href="{{url('/register')}}" class="myBtn myBtn-border myBtn-light myBtn-rounded myBtn-lg">Try US</a>
		                </div>

		                <div class="col-md-6">
		                    <img src="{{asset('imgs/gift.png')}}"  data-animate="fadeInUp" alt="" class="mt-40 pull-right img-responsive">
		                </div>

		            </div>

		        </div>

		    </div><!-- /parallax box -->

		    <!-- ============ heading section ============ -->
		    <div class="section m-0 pt-0">
		        <div class="container clearfix">
		            <div class="heading-block center">
		                <h1 class="text-uppercase">What we did to get here?</h1>
		                <p class="lead">Studied current similar Apps and found weaknesses and fixed them</p>
		            </div>
		        </div>
		    </div><!-- /heading section -->

		    <!-- ============ see more section ============ -->
		    <a href="#" class="myBtn myBtn-block myBtn-dark text-center">
		        <div class="container clearfix">
		            Is that all? Yes. <strong>Just That!</strong>
		        </div>
		    </a><!-- /see more section -->
        </div>
    </section><!-- #content end -->

@endsection