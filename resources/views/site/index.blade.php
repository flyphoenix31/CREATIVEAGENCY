

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
            <!-- Start Slider Area  -->
            <div class="rn-slider-area">
                <!-- Start Single Slide  -->
                @include('layout/homemainslide')
                <!-- End Single Slide  -->
            </div>
            <!-- End Slider Area  -->

            <!-- Start About Area  -->
                @include('layout/homeabout')
            <!-- Start About Area  -->

            <!-- Start Service Area  -->
            <div class="rn-service-area ptb--80 bg_image bg_image--3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="section-title text-left mt--30 mt_md--5 mt_mobile--5 mb_mobile--10">
                                <h2 class="title">Services</h2>
                                <p>Your full-service marketing agency that delivers branding & design, web design, strategic marketing, digital advertising, SEO, media buying, and more!</p>
                                <div class="service-btn"><a class="btn-transparent rn-btn-dark" href="{{route('contact_us')}}"><span
                                            class="text">Request Custom Service</span></a></div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-12 mt_md--50">
                            <div class="row service-one-wrapper">

                                <!-- Start Single Service  -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="single-service service__style--4">
                                        <a href="{{route('service_detail', 'branding')}}">
                                            <div class="service">
                                                <div class="icon">
                                                    <i data-feather="cast"></i>
                                                </div>
                                                <div class="content">
                                                    <h3 class="title">Branding</h3>
                                                    <p>Branding is the language you use to connect with your target audience. Your brand needs the right visual design, messaging, and strategy across all communications to resonate, stay consistent and create brand momentum.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- End Single Service  -->

                                <!-- Start Single Service  -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="single-service service__style--4">
                                        <a href="{{route('service_detail', 'web-design')}}">
                                            <div class="service">
                                                <div class="icon">
                                                    <i data-feather="layers"></i>
                                                </div>
                                                <div class="content">
                                                    <h3 class="title">Web Design</h3>
                                                    <p> Web Design
                                                        Your business needs a website that converts for you. Focused on user interface and experience, your website also requires a conversion optimized design to deliver your brand story and ensure visitors are engaged and take action.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- End Single Service  -->

                                <!-- Start Single Service  -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="single-service service__style--4">
                                        <a href="{{route('service_detail', 'marketing')}}">
                                            <div class="service">
                                                <div class="icon">
                                                    <i data-feather="users"></i>
                                                </div>
                                                <div class="content">
                                                    <h3 class="title">Marketing</h3>
                                                    <p>Brand momentum starts with a cohesive marketing strategy. Based on your unique story, paired with our creative execution, you are ensured that all collateral, ads and impressions resonate with your target audience.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- End Single Service  -->

                                <!-- Start Single Service  -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="single-service service__style--4">
                                        <a href="{{route('service_detail', 'advertising')}}">
                                            <div class="service">
                                                <div class="icon">
                                                    <i data-feather="monitor"></i>
                                                </div>
                                                <div class="content">
                                                    <h3 class="title">Advertising</h3>
                                                    <p>Coupled with the right strategy and audience targeting, your digital marketing and traditional advertising campaigns are focused on getting results. You can leverage our media buying relationships and expertise for a better ROI.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- End Single Service  -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Service Area  -->

            <!-- Start Portfolio Area  -->
            <div class="rn-portfolio-area rn-section-gap bg_color--1">
                <div class="portfolio-sacousel-inner pb--30">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title text-center mb--20 mb_sm--0 mb_md--0">
                                    <h2 class="title">All Works</h2>
                                    <p>There are many variations of passages of Lorem Ipsum available, <br /> but the
                                        majority have suffered alteration.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start Portfolio Activation  -->
                    <div class="portfolio-slick-activation rn-slick-activation item-fluid rn-slick-dot mt--40 mt_sm--40" data-slick-options='{
                                "spaceBetween": 15,
                                "slidesToShow": 5,
                                "slidesToScroll": 1,
                                "arrows": true,
                                "infinite": true,
                                "dots": true
                            }' data-slick-responsive='[
                            {"breakpoint":1600, "settings": {"slidesToShow": 4}},
                            {"breakpoint":1200, "settings": {"slidesToShow": 3}},
                            {"breakpoint":890, "settings": {"slidesToShow": 3}},
                            {"breakpoint":590, "settings": {"slidesToShow": 2}},
                            {"breakpoint":480, "settings": {"slidesToShow": 1}}
                            ]'>

                        @foreach($portfolio as $record)

                        <!-- Start Single Portfolio  -->
                        <div class="portfolio">
                            <a href="{{route('portfolio_detail', ['type' => $record->slug_url])}}">
                                <div class="thumbnail-inner">
                                    <div class="thumbnail" style="background-image: url({{$record->image}})"></div>
                                    <div class="bg-blr-image image-2" style="background-image: url({{$record->image}})"></div>
                                </div>
                                <div class="content">
                                    <div class="inner">
                                        <p>{{$record->title}}</p>
                                        <h4><a href="portfolio-details.html">{{$record->sub_title}}</a></h4>
                                        <div class="portfolio-button">
                                            <span class="rn-btn">Case Study</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- End Single Portfolio  -->

                        @endforeach

                    </div>
                    <!-- End Portfolio Activation  -->
                </div>
            </div>
            <!-- End Portfolio Area  -->

            <!-- Start Counterup Area  -->
            <div class="rn-counterup-area pt--25 pb--110 bg_color--1">
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

            <!-- Start Testimonial Area  -->
            @include('layout/testimonial')
            <!-- Start Testimonial Area  -->

            <!-- Start Blog Area  -->
            {{-- blog will be here --}}
            <!-- End Blog Area  -->

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
