<!doctype html>
<html class="no-js" lang="en">

    @include('layout/head')

<body>
    <div class="main-page">
        @include('layout/switcher')
        <!-- Start Header -->
        @include('layout/nav')

        <!-- Start Page Wrapper  -->
        <main class="page-wrapper">
            <!-- Start 404 Page  -->
            <div class="error-page-inner bg_color--4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="inner">
                                <h1 class="title theme-gradient">404!</h1>
                                <h3 class="sub-title">Page not found</h3><span>The page you were looking for could not
                                    be found.</span>
                                <div class="error-button">
                                    <a class="rn-button-style--2 btn_solid" href="/">Back To Homepage</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End 404 Page  -->
        </main>
        <!-- End Page Wrapper  -->
        <!-- Start Footer Style Two  -->
        <div class="footer-style-2 ptb--30 bg_image bg_image--1" data-black-overlay="6">
            <div class="wrapper plr--50 plr_sm--20">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="inner">
                            <div class="logo text-center text-sm-left mb_sm--20">
                                <a href="#">
                                    <img src="{{ asset('site/images/logo/logo.png') }}" alt="Logo images" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="inner text-center">
                            <ul class="social-share rn-lg-size d-flex justify-content-center liststyle">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-skype"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="inner text-lg-right text-center mt_md--20 mt_sm--20">
                            <div class="text">
                                <p>Copyright © 2021 Rainbow-Themes. All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Style Two  -->
    </div>

    @include('layout/script')


</body>

</html>

