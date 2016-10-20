@extends('layouts.front')

@section ('content')

    <div id="fh5co-about-us" data-section="about">
        <div class="container">
            <div class="row row-bottom-padded-lg" id="about-us">
                <div class="col-md-12 section-heading text-center">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 to-animate">
                            <h3>The Opportunities For Your Financial Freedom</h3>
                    <p>Holding Hands Donations, is an internetional Fund Exchange System formulated to provide financial growth with the invested funds.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="fh5co-our-services" data-section="services">
        <div class="container">
            <div class="row row-bottom-padded-sm">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="to-animate">Why invest with us</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box to-animate">
                        <div class="icon colored-1"><span><i class="icon-mustache"></i></span></div>
                        <h3>100% Return Profit</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box to-animate">
                        <div class="icon colored-4"><span><i class="icon-heart"></i></span></div>
                        <h3>15 Days To Mature</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box to-animate">
                        <div class="icon colored-2"><span><i class="icon-screen-desktop"></i></span></div>
                        <h3>5% Commission</h3>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <div id="fh5co-features" data-section="features">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="single-animate animate-features-1">How does it work</h2>
                </div>
            </div>
            <div class="row row-bottom-padded-sm">
                <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-service to-animate">
                    <div class="fh5co-icon"><i class="icon-user"></i></div>
                    <div class="fh5co-desc">
                        <h3>Create an Account</h3>
                    </div>  
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-service to-animate">
                    <div class="fh5co-icon"><i class="icon-money"></i></div>
                    <div class="fh5co-desc">
                        <h3>Create Funds</h3>
                    </div>  
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-service to-animate">
                    <div class="fh5co-icon"><i class="icon-money"></i></div>
                    <div class="fh5co-desc">
                        <h3>Transfer Funds</h3>
                    </div>
                </div>
                <div class="clearfix visible-sm-block visible-xs-block"></div>
                <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-service to-animate">
                    <div class="fh5co-icon"><i class="icon-money"></i></div>
                    <div class="fh5co-desc">
                        <h3>Make Profit</h3>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="fh5co-testimonials" data-section="testimonials">       
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="to-animate">What People Say About US</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box-testimony to-animate">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quote-left"></i></span></span>
                            <p>&ldquo;It's official - I love the app, i couldn't be without it anymore&rdquo;</p>
                        </blockquote>
                        <p class="author">Lyn Van Wyk</p>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    <div class="box-testimony to-animate">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quote-left"></i></span></span>
                            <p>&ldquo;I have used this app for 2 months and it has never disappointed. :-)&rdquo;</p>
                        </blockquote>
                        <p class="author">Samual Nkomo</p>
                    </div>
                    
                    
                </div>
                <div class="col-md-4">
                    <div class="box-testimony to-animate">
                        <blockquote>
                            <span class="quote"><span><i class="icon-quote-left"></i></span></span>
                            <p>&ldquo;It's really as simple is explained, it just works, thanx team HHD for the awesome work&rdquo;</p>
                        </blockquote>
                        <p class="author">Adam Smut</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-accounts">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="single-animate animate-features-1">
                        <a href='{{ url('/join') }}' class='btn btn-success btn-lg'>Create Account</a>
                    </h2>
                </div>
            </div>
        </div>
    </div>

@endsection