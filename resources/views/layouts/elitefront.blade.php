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

    <title>Elite Login</title>

    <style type="text/css">
        
    </style>

</head>

<body>

    <div id="wrapper" class="clearfix animsition"> <!-- Page Wrapper -->

        @yield('content')

    </div>

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


    @yield('js')

</body>
</html>