<!doctype html>
<html class="no-js" lang="en">

    @include('layout/head')

<body>
    <div class="main-page">
        @include('layout/switcher')
        <!-- Start Header -->
        @include('layout/nav')
        <!-- Start Breadcrump Area  -->
        <div class="breadcrumb-area rn-bg-color ptb--120 bg_image bg_image--1" data-black-overlay="6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-inner pt--100 pt_sm--40 pt_md--50">
                            <h2 class="title">About</h2>
                            <ul class="page-list">
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li class="current-page">About</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrump Area  -->
        <!-- Start Page Wrapper  -->
        <main class="page-wrapper">

            <!-- Start About Area  -->
            <div class="about-area rn-section-gap bg_color--1">
                <div class="about-wrapper">
                    <div class="container">
                        <div class="row row--35 align-items-center">
                            <div class="col-lg-5 col-md-12">
                                <div class="thumbnail">
                                    <img class="w-100" src="{{ asset('site/images/about-3.jpg') }}" alt="About Images" />
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12">
                                <div class="about-inner inner">
                                    <div class="section-title">
                                        <h2 class="title">About</h2>
                                        <p class="description">There are many variations of passages of Lorem Ipsum
                                            available, but the majority have suffered alteration in some form, by
                                            injected humour, or randomised words which dont look even slightly
                                            believable. If you are going to use a passage of Lorem Ipsum,</p>
                                    </div>
                                    <div class="row mt--30 mt_sm--10">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                            <div class="about-us-list">
                                                <h3 class="title">Who we are</h3>
                                                <p>There are many vtions of passages of Lorem Ipsum available, but the
                                                    majority have suffered.</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                            <div class="about-us-list">
                                                <h3 class="title">Who we are</h3>
                                                <p>There are many vtions of passages of Lorem Ipsum available, but the
                                                    majority have suffered.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start About Area  -->

            <!-- Start Counterup Area  -->
            <div class="rn-counterup-area rn-section-gapBottom bg_color--1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-center">
                                <h3 class="fontWeight500">Our Fun Facts</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Start Single Counterup  -->
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="rn-counterup counterup_style--1">
                                <h5 class="counter count">992</h5>
                                <p class="description">The standard chunk of Lorem Ipsum used since the 1500s is
                                    reproduced below for those.</p>
                            </div>
                        </div>
                        <!-- Start Single Counterup  -->

                        <!-- Start Single Counterup  -->
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="rn-counterup counterup_style--1">
                                <h5 class="counter count">575</h5>
                                <p class="description">The standard chunk of Lorem Ipsum used since the 1500s is
                                    reproduced below for those.</p>
                            </div>
                        </div>
                        <!-- Start Single Counterup  -->

                        <!-- Start Single Counterup  -->
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="rn-counterup counterup_style--1">
                                <h5 class="counter count">69</h5>
                                <p class="description">The standard chunk of Lorem Ipsum used since the 1500s is
                                    reproduced below for those.</p>
                            </div>
                        </div>
                        <!-- Start Single Counterup  -->
                    </div>
                </div>
            </div>
            <!-- End Counterup Area  -->

            <!-- Start Finding us Area  -->
            <div class="rn-finding-us-area rn-finding-us bg_color--1">
                <div class="inner">
                    <div class="content-wrapper">
                        <div class="content">
                            <h4 class="theme-gradient">Find Your Work Now</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable content of
                                a page when looking at its layout. The point of using Lorem Ipsum is that.</p><a class="rn-btn btn-white" href="{{route('contact_us')}}">Get Started</a>
                        </div>
                    </div>
                    <div class="thumbnail">
                        <div class="image">
                            <img src="{{ asset('site/images/finding-us-01.png') }}" alt="Finding Images">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Finding us Area  -->

            <!-- Start team Area  -->
            {{-- team here --}}
            <!-- Start team Area  -->

            <!-- Start Testimonial Area  -->
            @include('layout/testimonial')
            <!-- Start Testimonial Area  -->

            <!-- Start Brand Area -->
            @include('layout/brand')
            <!-- End Brand Area -->


        </main>
        <!-- End Page Wrapper  -->
        @include('layout/footer')
    </div>

    @include('layout/script')


</body>

</html>

