<!doctype html>
<html class="no-js" lang="en">

    @include('layout/head')

<body>
    <div class="main-page">
        @include('layout/switcher')
        <!-- Start Header -->
        @include('layout/nav')
        <!-- Start Breadcrump Area  -->
        <div class="rn-page-title-area pt--120 pb--190 bg_image " data-black-overlay="5" style="background-image: url({{$record->banner}})">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rn-page-title text-center pt--100">
                            <h2 class="title theme-gradient">{{$record->title}}</h2>
                            <p>{{$record->sub_title}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrump Area  -->
        <!-- Start Page Wrapper  -->
        <main class="page-wrapper">
            <!-- Start Portfolio Details Area  -->
            <div class="rn-portfolio-details ptb--120 bg_color--1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="portfolio-details">
                                <div class="inner">

                                    {!! $record->content !!}

                                    <div class="portfolio-view-list d-flex flex-wrap">
                                        <div class="port-view"><span>Tag</span>
                                            <h4>{{$record->tag}}</h4>
                                        </div>
                                    </div>
                                    <div class="portfolio-share-link mt--20 pb--70 pb_sm--40">
                                        <ul class="social-share rn-lg-size d-flex justify-content-start liststyle mt--15">
                                            <li><a href="#"><i data-feather="facebook"></i></a></li>
                                            <li><a href="#"><i data-feather="linkedin"></i></a></li>
                                            <li><a href="#"><i data-feather="instagram"></i></a></li>
                                            <li><a href="#"><i data-feather="twitter"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Portfolio Details Area  -->
           {{--  <!-- Start Related Work  -->
            <div class="portfolio-related-work pb--120 bg_color--1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-center">
                                <span class="theme-color font--18 fontWeight600">Related Work</span>
                                <h2>Our More Projects</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row mt--10">

                        <!-- Start Single Work  -->
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="related-work text-center mt--30">
                                <div class="thumb">
                                    <a href="portfolio-details.html">
                                        <img src="{{ asset('site/images/related-image-02.jpg') }}" alt="Portfolio-images">
                                    </a>
                                </div>
                                <div class="inner">
                                    <h4><a href="portfolio-details.html">Digital Analysis</a></h4>
                                    <span class="category">Technique</span>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Work  -->

                        <!-- Start Single Work  -->
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="related-work text-center mt--30">
                                <div class="thumb">
                                    <a href="portfolio-details.html">
                                        <img src="{{ asset('site/images/related-image-02.jpg') }}" alt="Portfolio-images">
                                    </a>
                                </div>
                                <div class="inner">
                                    <h4><a href="portfolio-details.html">Plan Management</a></h4>
                                    <span class="category">PLANNING</span>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Work  -->
                    </div>
                </div>
            </div>
            <!-- End Related Work  --> --}}
        </main>
        <!-- End Page Wrapper  -->
        @include('layout/footer')
    </div>

    @include('layout/script')


</body>

</html>

