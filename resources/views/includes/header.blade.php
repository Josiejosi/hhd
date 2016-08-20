    <!--  Header  -->

    <header id="header" class="transparent-header light"><!-- class .sticky-mobile makes header sticky on small devices -->

        <div id="header-wrap">

            <div class="container clearfix">

                <div id="main-navbar-toggle"><i class="fa fa-bars"></i></div>
                <div id="branding">
                    <a href="#" class="brand-normal" data-light-logo="{{asset('imgs/logo-sm.png')}}">
                        <img src="{{asset('imgs/logo-sm.png')}}" alt="PrestigeWallet">
                    </a>
                    <a href="#" class="brand-retina" data-light-logo="{{asset('imgs/logo-lg.png')}}">
                        <img src="{{asset('imgs/logo-lg.png')}}" alt="PrestigeWallet">
                    </a>
                </div>
                <nav id="main-navbar">
                    <ul>
                        <li class="active"><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/signin')}}">Sign In</a></li>
                        <li><a href="{{url('/signup')}}">Sign Up</a></li>
                        <li><a href="{{url('/contactus')}}">Contact Us</a></li>

                    </ul>
                </nav>
            </div>
        </div>
    </header>