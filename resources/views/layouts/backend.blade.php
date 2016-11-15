<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="HHD, Holding Hands Donations">
    <meta name="csrf_token" content="{{ csrf_token() }}" />

        <meta name="secondary_level_token" content="{{ Auth::user()->id }}" />
        <meta name="fallback_url" content="{{env('SOCKET_URL')}}" />

    <title>HHD - {{ $title }}</title>

    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
        
    <link href="{{asset('css/admin/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/style-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/loader.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        .black-bg {

            background: #388986; /* Old browsers */
            background: -moz-linear-gradient(top,  #388986 0%, #307477 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top,  #388986 0%,#307477 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom,  #388986 0%,#307477 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#388986', endColorstr='#307477',GradientType=0 ); /* IE6-9 */
            border-bottom: 1px solid #AEB2B7 !important;
        }

        #sidebar {
            background: #307477;
            color: #c7eac9 ;
        }

        ul.sidebar-menu li a.active, ul.sidebar-menu li a:hover, ul.sidebar-menu li a:focus {
            background: #3f8184;
        }

        ul.sidebar-menu li ul.sub li{
            background: #386466;
        }

        body {
            background-color: #fff ;
        }

        ul.top-menu > li > .logout {
            color: #f2f2f2;
            font-size: 14px;
            border-radius: 4px;
            -webkit-border-radius: 4px;
            border: 1px solid #8ab66b !important;
            padding: 5px 15px;
            margin-right: 15px;
            background: #307477;
            margin-top: 15px;
        }

        .sidebar-toggle-box .fa-bars {
            color: #fff;
        }
        .box1 h3 {

            font-size: 16px;
            font-weight: bolder;
        }

        .box1 {
          display: block;
          height: 170px ;
          border: 1px solid #386466;
          background: #C7EAC9;
          border-radius: 5px ;
          margin: 5px ;

        }

        .form-control, .btn {
            border-radius: 0px !important ;
        }


    </style>

      @yield('css')
  </head>

  <body>

  <section id="container" >

      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <a href="http://holdinghandsdonations.com" class="logo"><b>HHD</b></a>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="{{url('/logout')}}">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </a></li>
                </ul>
            </div>
      </header>
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered">
                      <a href="{{ url("/profile") }}">
                          <img src="{{ $avatar }}" class="img-circle" width="60">
                      </a>
                  </p>
                  <h5 class="centered">{{ $name }}</h5>
                    
                  <li class="mt">
                      <a href="{{ url('/home') }}">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent" href="javascript:;">
                          <i class="fa fa-expand" aria-hidden="true"></i>
                          <span>Accounts</span>
                      <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">
                          <li>
                              <a href="{{ url('/accounts') }}">
                                  <i class="fa fa-cash" aria-hidden="true"></i> Banks
                              </a>
                          </li>
                          <li>
                              <a href="{{ url('/bitcoin') }}">
                                  <i class="fa fa-cash" aria-hidden="true"></i>  Bitcoins
                              </a>
                          </li>
                      </ul>
                  </li>


                  <li class="mt">
                      <a href="{{ url("/schedules") }}">
                          <i class="fa fa-dashboard"></i>
                          <span>Transactions</span>
                      </a>
                  </li>

                  <li class="mt">
                      <a href="{{ url("/profile") }}">
                          <i class="fa fa-user"></i>
                          <span>Profile</span>
                      </a>
                  </li>
              </ul>
          </div>
      </aside>

        <section id="main-content">
            <section class="wrapper site-min-height">
                @yield('content')
            </section>
        </section>

        <footer class="site-footer">
            <div class="text-center">
                2016 - HHD
                <a href="http://holdinghandsdonations.com" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>
    </section>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery-ui-1.9.2.custom.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery.ui.touch-punch.min.js')}}"></script>
    <script class="include" type="text/javascript" src="{{asset('js/admin/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('js/admin/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/admin/common-scripts.js')}}"></script>
    @yield('js')
  </body>
</html>
