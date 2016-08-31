<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic|Raleway:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/settings.css')}}" media="screen" />

    <link rel="stylesheet" href="{{asset('css/animsition.css')}}">
    <script type="text/javascript" src="{{asset('js/jquery-1.11.2.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/custom.min.css')}}" type="text/css" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--[if lt IE 9]>
    	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <title>PrestigeWallet | Home</title>

    <style type="text/css">
        
        #header.transparent-header.light #main-navbar ul li a, 
        .tp-caption.white_heavy_70, 
        .white_heavy_70,
        .tp-caption.light_medium_20, 
        .light_medium_20, 
        .text-white, 
        .text-greensea {
            color: #449090;
        }

        .myBtn.myBtn-light {
            background-color: #0f494c;
            color: #0f494c;
            text-shadow: none !important;
        }

        .parallax-1 {
            background: url({{asset('imgs/para.jpg')}}) 0% -150px;
        }
    </style>

</head>

<body>

    <div id="wrapper" class="clearfix animsition"> <!-- Page Wrapper -->


        @include('includes.header')

        @yield('content')

        <!--  Footer  -->
        <footer id="footer">

            <div class="footer-main">
                <div class="container">
                    <div class="row">

                        <div class="col-md-4">

                            <div class="widget widget-about">
                                <h2>PrestigeWallet</h2>
                                <p>
                                    IT cant get simpler that this
                                </p>
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="widget widget-contact mt-20-md">
                                <h4><strong>Contact</strong> Us</h4>
                                <address>
                                    <strong>Email:</strong> <a href="info@prestigewallet.com">info@prestigewallet.com</a><br>
                                </address>
                            </div>


                        </div>


                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-md-4 copyright">
                            <p class="mb-0">
                                &copy; Copyright 2016 by <a href="#">PrestigeWallet</a>. All Rights Reserved.
                            </p>
                        </div>

                        <div class="col-md-8 text-right text-center-md">

                            <a class="social-icon social-facebook" href="#">
                                 <div class="front">
                                    <i class="fa fa-facebook"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-facebook"></i>
                                 </div>
                            </a>

                            <a class="social-icon social-twitter" href="#">
                                 <div class="front">
                                    <i class="fa fa-twitter"></i>
                                 </div>
                                 <div class="back">
                                    <i class="fa fa-twitter"></i>
                                 </div>
                            </a>

                        </div>

                    </div>
                </div>
            </div>

        </footer><!-- #footer end -->

    </div><!-- #wrapper end -->

    <div id="gotoTop" class="fa fa-angle-up hidden-md"></div>


    <script type="text/javascript" src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/superfish.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jRespond.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/SmoothScroll.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.appear.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.stellar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.flexslider-min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.countTo.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/jquery.themepunch.tools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.themepunch.revolution.min.js')}}"></script>

    <script src="{{asset('js/jquery.animsition.min.js')}}"></script>


    <script type="text/javascript" src="{{asset('js/global.js')}}"></script>


</body>
</html>