
<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('uploads\frontEnd\logo\Finder.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
       <div class="header-area header-transparrent">
           <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-3 col-md-2">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="index.html"><img style="width: 150px" src="{{ asset('uploads\frontEnd\logo\Finder.png') }}" alt=""></a>
                            </div>  

                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="menu-wrapper">
                                <!-- Main-menu -->
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="{{ route('home') }}">Home</a></li>
                                            <li><a href="{{ route('data') }}">View Request</a></li>
                                            <li><a href="{{ route('donor_list_view') }}">Search Donor</a></li>
                                            <li><a href="{{ route('blood_req_form') }}" class="btn text-white head-btn1" style="padding: 15px 20px">Request Donation</a></li>
                                            <li><a>Account</a>
                                                <ul class="submenu">
                                                    @guest
                                                        <li><a href="{{ route('register') }}" >Register</a></li>
                                                        <li><a href="{{ route('login') }}">Login</a></li>
                                                    @endguest
                                                    @auth
                                                    <li><a href="{{ route('profile_view',Auth::id()) }}">Profile</a></li>
                                                        <li>
                                                            <a href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                                document.getElementById('logout-form').submit();">
                                                                    {{ __('Logout') }}
                                                                </a>
                                                                
                                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                    @csrf
                                                                </form>                                                            
                                                        </li>
                                                    
                                                    @endauth
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>   
                                
                            <!-- Header-btn -->
                            

                            @include('front_end.app.alert_front')
                            
                            
                        </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
           </div>
       </div>
        <!-- Header End -->
    </header>