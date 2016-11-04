<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HHD - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="HHD, holding hands donations" />
    <meta name="keywords" content="HHD, holding hands donations" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">



    <style>
        #colour-variations {
            padding: 10px;
            -webkit-transition: 0.5s;
            -o-transition: 0.5s;
            transition: 0.5s;
            width: 140px;
            position: fixed;
            left: 0;
            top: 100px;
            z-index: 999999;
            background: #fff;
            /*border-radius: 4px;*/
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
            -webkit-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
            -moz-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
            -ms-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
            box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
        }
        #colour-variations.sleep {
            margin-left: -140px;
        }
        #colour-variations h3 {
            text-align: center;;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #777;
            margin: 0 0 10px 0;
            padding: 0;;
        }
        #colour-variations ul,
        #colour-variations ul li {
            padding: 0;
            margin: 0;
        }
        #colour-variations li {
            list-style: none;
            display: inline;
        }
        #colour-variations li a {
            width: 20px;
            height: 20px;
            position: relative;
            float: left;
            margin: 5px;
        }
        #colour-variations li a[data-theme="style"] {
            background: #6173f4;
        }
        #colour-variations li a[data-theme="pink"] {
            background: #f64662;
        }
        #colour-variations li a[data-theme="blue"] {
            background: #2185d5;
        }
        #colour-variations li a[data-theme="turquoise"] {
            background: #00b8a9;
        }
        #colour-variations li a[data-theme="orange"] {
            background: #ff6600;
        }
        #colour-variations li a[data-theme="lightblue"] {
            background: #5585b5;
        }
        #colour-variations li a[data-theme="brown"] {
            background: #a03232;
        }
        #colour-variations li a[data-theme="green"] {
            background: #65d269;
        }

        .option-toggle {
            position: absolute;
            right: 0;
            top: 0;
            margin-top: 5px;
            margin-right: -30px;
            width: 30px;
            height: 30px;
            background: #f64662;
            text-align: center;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
            color: #fff;
            cursor: pointer;
            -webkit-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
            -moz-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
            -ms-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
            box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
        }
        .option-toggle i {
            top: 2px;
            position: relative;
        }
        .option-toggle:hover, .option-toggle:focus, .option-toggle:active {
            color:  #fff;
            text-decoration: none;
            outline: none;
        }

        /** NEW STYLING **/



        #fh5co-about-us, #fh5co-testimonials {
            padding: 7em 0;
            background: #c7eac9;
            color: #fff;
        }

        #footer {
            color: #307379 ;
            background: #c7eac9;
        }

        #fh5co-about-us {
            background-image: url('imgs/bg-front.png') ;
        }

        #fh5co-cut {
            background-image: url('imgs/cut-bg-front.png') ;
        }

        @media screen and (max-width: 768px)
        #fh5co-header .navbar-brand {
            color: #c7eac9 !important;
        }


        .section-heading h3 {
            font-weight: 300;
            line-height: 1.5;
            color: #eeeeee;
            font-size: 20px ;
        }

        #fh5co-testimonials .section-heading .subtext h3,
        #fh5co-testimonials .section-heading h2,
        #fh5co-testimonials .section-heading p,
        #fh5co-testimonials .box-testimony .author,
        #fh5co-testimonials .box-testimony a,
        #fh5co-testimonials .box-testimony .author .subtext,
        #fh5co-testimonials .box-testimony blockquote p,
        #fh5co-features .fh5co-service .fh5co-desc h3,
        #fh5co-features .fh5co-service .fh5co-desc h3,
        .section-heading h2 {
            color: #307379 ;
        }

        #fh5co-accounts {
            background-color: #307379 ;
        }

        #fh5co-features .fh5co-service .fh5co-icon i {
            font-size: 36px;
            color: #386466;
        }

        .faqHeader {
            font-size: 27px;
            margin: 20px;
        }

        .panel-heading [data-toggle="collapse"]:after {
            content: "\f061" ;
            font-family: FontAwesome;
            float: right;
            color: #F58723;
            font-size: 18px;
            line-height: 22px;
            /* rotate "play" icon from > (right arrow) to down arrow */
            -webkit-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
            -ms-transform: rotate(-90deg);
            -o-transform: rotate(-90deg);
            transform: rotate(-90deg);
        }

        .panel-heading [data-toggle="collapse"].collapsed:after {
            /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            transform: rotate(90deg);
            color: #454444;
        }

        .error-message {
            font-size: 12px ;
            color: #f29191 ;
            font-style: italic; 
        }

        #fh5co-header {
            position: absolute;
            z-index: 99;
            width: 100%;
            opacity: 1;
            top: 0;
            margin-top: 0px ;
            background-color: #fff;
        }

        #fh5co-header #navbar li a span {
            position: relative;
            display: block;
            padding-bottom: 2px;
            color: #307379;
        }

        .navbar-brand {
            float: left;
            padding: 15px 15px;
            font-size: 18px;
            line-height: 20px;
            height: 70px;
        }

    /** END OF NEW STYLING **/
    </style>
    <!-- End demo purposes only -->


    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    </head>
    <body>
    <header role="banner" id="fh5co-header">
            <div class="container">
                <!-- <div class="row"> -->
                <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <!-- Mobile Toggle Menu Button -->
                    <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('imgs/logo.png') }}">
                    </a> 
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="{{ url('/') }}"><span>Home</span></a></li>
                    <li><a href="{{ url('/philosophy') }}"><span>Philosophy</span></a></li>
                    <li><a href="{{ url('/how_it_works') }}"><span>How it works</span></a></li>
                    <li><a href="{{ url('/legality') }}"><span>Legality</span></a></li>
                    <li><a href="{{ url('/support') }}"><span>Support</span></a></li>
                    <li><a href="{{ url('/FAQs') }}"><span>FAQs</span></a></li>
                    <li><a href="{{ url('/news') }}"><span>News</span></a></li>
                    <li><a href="{{ url('/signin') }}"><span>Login</span></a></li>
                    <li><a href="{{ url('/signup') }}"><span>Register</span></a></li>
                  </ul>
                </div>
                </nav>
              <!-- </div> -->
          </div>
    </header>

    @yield('content')

    <footer id="footer" role="contentinfo">
        <div class="container">
            <div class="row row-bottom-padded-sm">
                <div class="col-md-12">
                    <p class="copyright text-center">&copy; 2016 <a href="http://holdinghandsdonations.com">HHD</a>. All Rights Reserved. </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="social social-circle">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#"><i class="icon-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    @yield('js')
    </body>
</html>
