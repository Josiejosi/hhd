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

    <title>HHD - Home</title>

    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
        
    <link href="{{asset('css/admin/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/style-responsive.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        .black-bg {
            background: #c7eac9;
            border-bottom: 1px solid #307477;
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
                    <li><a class="logout" href="{{url('/logout')}}">Logout</a></li>
                </ul>
            </div>
      </header>
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="profile.html"><img src="{{ $avatar }}" class="img-circle" width="60"></a></p>
                  <h5 class="centered">{{ $name }}</h5>
                    
                  <li class="mt">
                      <a href="{{ url('/home') }}">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="mt">
                      <a href="{{ url('/accounts') }}">
                          <i class="fa fa-money"></i>
                          <span>Accounts</span>
                      </a>
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
