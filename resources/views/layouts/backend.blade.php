<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>PrestigeWallet | @yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <meta name="csrf_token" content="{{ csrf_token() }}" />
        <meta name="secondary_level_token" content="{{ Auth::user()->id }}" />
        <meta name="fallback_url" content="{{env('SOCKET_URL')}}" />
        
        <link href="//fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('css/jquery.countdown.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/toastr.min.css')}}" rel="stylesheet" type="text/css" />

        <style type="text/css">
            
        .mt-element-card.mt-card-round .mt-card-item .mt-card-avatar {
            border-radius: 50%!important;
            -webkit-mask-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAGXRFW…9iZSBJbWFnZVJlYWR5ccllPAAAAA5JREFUeNpiYGBgAAgwAAAEAAGbA+oJAAAAAElFTkSuQmCC);
        }
        </style>

        @yield('css')

        <link rel="shortcut icon" href="imgs/favicon.ico" /> 

        <script src="{{asset('js/jquery-1.11.2.min.js')}}" type="text/javascript"></script>
    </head>
    <!-- END HEAD -->

    <body class="">
        <!-- BEGIN HEADER -->
        <header class="page-header">
            <nav class="navbar" role="navigation">
                <div class="container-fluid">
                    <div class="havbar-header">
                        <a id="index" class="navbar-brand" href="{{url('/home')}}">
                            <img src="{{asset('imgs/logo-sm.png')}}" alt="Logo"> </a>
                        <!-- BEGIN TOPBAR ACTIONS -->
                        <div class="topbar-actions">

                            <!-- BEGIN GROUP NOTIFICATION -->
                            <div class="btn-group-notification btn-group" id="header_notification_bar">
                                <button type="button" class="btn md-skip dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="badge">0</span>
                                </button>
                                <ul class="dropdown-menu-v2">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">0 pending</span> notifications</h3>
                                        <a href="#">view all</a>
                                    </li>
                                    <li>
  <!--                                       <ul class="dropdown-menu-list scroller" style="height: 250px; padding: 0;" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success md-skip">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered. </span>
                                                    <span class="time">just now</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger md-skip">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Server #12 overloaded. </span>
                                                    <span class="time">3 mins</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning md-skip">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Server #2 not responding. </span>
                                                    <span class="time">10 mins</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-info md-skip">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> Application error. </span>
                                                    <span class="time">14 hrs</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger md-skip">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Database overloaded 68%. </span>
                                                    <span class="time">2 days</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger md-skip">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> A user IP blocked. </span>
                                                    <span class="time">3 days</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning md-skip">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Storage Server #4 not responding dfdfdfd. </span>
                                                    <span class="time">4 days</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-info md-skip">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> System Error. </span>
                                                    <span class="time">5 days</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger md-skip">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Storage server failed. </span>
                                                    <span class="time">9 days</span>
                                                </a>
                                            </li>
                                        </ul> -->
                                    </li>
                                </ul>
                            </div>
                            <!-- END GROUP NOTIFICATION -->
                            <!-- BEGIN USER PROFILE -->
                            <div class="btn-group-img btn-group">
                                <button 
                                    type="button" 
                                    class="btn btn-sm dropdown-toggle" 
                                    data-toggle="dropdown" 
                                    data-hover="dropdown" 
                                    data-close-others="true">
                                    <img src="{{asset('imgs/avatar/avatar.png')}}" alt=""> 
                                </button>
                                <ul class="dropdown-menu-v2" role="menu">
                                    <li>
                                        <a href="{{url('/profile')}}">
                                            <i class="icon-user"></i> My Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('/logout')}}">
                                            <i class="icon-key"></i> Log Out 
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <!-- END USER PROFILE -->
                        </div>
                        <!-- END TOPBAR ACTIONS -->
                    </div>
                </div>
                <!--/container-->
            </nav>
        </header>
        <!-- END HEADER -->
        <!-- BEGIN CONTAINER -->
        <div class="container-fluid">
            <div class="page-content page-content-popup">
                <div class="page-content-fixed-header">
                    <!-- BEGIN BREADCRUMBS -->
                    <ul class="page-breadcrumb">
                        <li>Home</li>
                    </ul>
                    <!-- END BREADCRUMBS -->
                    <div class="content-header-menu">
                        <!-- BEGIN MENU TOGGLER -->
                        <button type="button" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="toggle-icon">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                        </button>
                        <!-- END MENU TOGGLER -->
                    </div>
                </div>
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                            <li class="nav-item start ">
                                <a href="{{url('/home')}}" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Home</span>
                                </a>
                            </li>
                            <li class="nav-item start ">
                                <a href="{{url('/accounts')}}" class="nav-link nav-toggle">
                                    <i class="icon-credit-card"></i>
                                    <span class="title">Accounts</span>
                                </a>
                            </li> 
                            <li class="nav-item start ">
                                <a href="{{url('/schedules')}}" class="nav-link nav-toggle">
                                    <i class="icon-notebook"></i>
                                    <span class="title">Scheduled</span>
                                </a>
                            </li>                            
                            <li class="nav-item start ">
                                <a href="{{url('/profile')}}" class="nav-link nav-toggle">
                                    <i class="icon-user"></i>
                                    <span class="title">Profile</span>
                                </a>
                            </li>
                        </ul>
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <div class="page-fixed-main-content">

                    @yield('content')
                    
                </div>
                <!-- BEGIN FOOTER -->
                <p class="copyright-v2">{{date("Y")}} © Prestige Wallet.
                </p>
                <a href="#index" class="go2top">
                    <i class="icon-arrow-up"></i>
                </a>
                <!-- END FOOTER -->
            </div>
        </div>
        <!-- END CONTAINER -->
        <!--[if lt IE 9]>
        <script src="../assets/global/plugins/respond.min.js"></script>
        <script src="../assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        
        <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/jquery.uniform.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/app.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/jquery.countdown.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/toastr.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bootbox.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/modavication.js')}}" type="text/javascript"></script>
        <!--        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.8/socket.io.min.js" type="text/javascript"></script>
        <script src="{{asset('js/push-notification.js')}}" type="text/javascript"></script> 
        -->
        

        @yield('js')

    </body>

</html>