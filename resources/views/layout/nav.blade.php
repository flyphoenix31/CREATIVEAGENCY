<header class="header-area formobile-menu header--transparent black-logo-version ">
    <div class="header-wrapper" id="header-wrapper">
        <div class="header-left">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('site/images/logo/logo.png') }}" alt="Creative Agency Logo">
                </a>
            </div>
        </div>
        <div class="header-right">
            <div class="mainmenunav d-lg-block">
                <!-- Start Mainmanu Nav -->
                <nav class="main-menu-navbar">
                    <ul class="mainmenu">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <a href="{{route('services')}}">Services</a>
                        </li>
                        <li>
                            <a href="{{route('portfolio')}}">Portfolio</a>
                        </li>
                        <li>
                            <a href="{{route('about')}}">About</a>
                        </li>
                        <li>
                            <a href="{{route('contact_us')}}">Contact</a>
                        </li>
                    </ul>
                </nav>
                <!-- End Mainmanu Nav -->

            </div>
            {{-- <div class="header-btn">
                <a class="rn-btn" href="{{route('contact_us')}}">
                    <span>Start A Project</span>
                </a>
            </div> --}}

            <div class="header-btn">
                <a class="rn-btn" href="{{route('dashboard')}}">
                    <span>Member Area</span>
                </a>
            </div>
            <!-- Start Humberger Menu  -->
            <div class="humberger-menu d-block d-lg-none pl--20">
                <span class="menutrigger text-white">
            <i data-feather="menu"></i>
        </span>
            </div>
            <!-- End Humberger Menu  -->
            <!-- Start Close Menu  -->
            <div class="close-menu d-block d-lg-none">
                <span class="closeTrigger">
            <i data-feather="x"></i>
        </span>
            </div>
            <!-- End Close Menu  -->
        </div>
    </div>
</header>
