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
                            <h2 class="title">Service</h2>
                            <ul class="page-list">
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li class="current-page">Service</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrump Area  -->
        <main class="page-wrapper">

            <!-- Start Service Area  -->
            <div class="rn-service-area rn-section-gap bg_color--5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-center mb--30">
                                <h2>Our Services</h2>
                                <p>There are many variations of passages of Lorem Ipsum available, <br> but the majority
                                    have suffered alteration.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- Start Single Service  -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30">
                            <div class="single-service service__style--2 bg-color-gray">
                                <a href="{{route('service_detail', ['type' => 'webdev'])}}">
                                    <div class="service">
                                        <div class="icon">
                                            <i data-feather="cast"></i>
                                        </div>
                                        <div class="content">
                                            <h3 class="title">Business Stratagy</h3>
                                            <p>I throw myself down among the tall grass by the stream as I lie close to
                                                the earth.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Single Service  -->

                        <!-- Start Single Service  -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30">
                            <div class="single-service service__style--2 bg-color-gray">
                                <a href="{{route('service_detail', ['type' => 'webdev'])}}">
                                    <div class="service">
                                        <div class="icon">
                                            <i data-feather="layers"></i>
                                        </div>
                                        <div class="content">
                                            <h3 class="title">Website Development</h3>
                                            <p>I throw myself down among the tall grass by the stream as I lie close to
                                                the earth.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Single Service  -->

                        <!-- Start Single Service  -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30">
                            <div class="single-service service__style--2 bg-color-gray">
                                <a href="{{route('service_detail', ['type' => 'webdev'])}}">
                                    <div class="service">
                                        <div class="icon">
                                            <i data-feather="users"></i>
                                        </div>
                                        <div class="content">
                                            <h3 class="title">Marketing & Reporting</h3>
                                            <p>I throw myself down among the tall grass by the stream as I lie close to
                                                the earth.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Single Service  -->

                        <!-- Start Single Service  -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30">
                            <div class="single-service service__style--2 bg-color-gray">
                                <a href="{{route('service_detail', ['type' => 'webdev'])}}">
                                    <div class="service">
                                        <div class="icon">
                                            <i data-feather="monitor"></i>
                                        </div>
                                        <div class="content">
                                            <h3 class="title">Mobile Development</h3>
                                            <p>I throw myself down among the tall grass by the stream as I lie close to
                                                the earth.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Single Service  -->

                        <!-- Start Single Service  -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30">
                            <div class="single-service service__style--2 bg-color-gray">
                                <a href="{{route('service_detail', ['type' => 'webdev'])}}">
                                    <div class="service">
                                        <div class="icon">
                                            <i data-feather="camera"></i>
                                        </div>
                                        <div class="content">
                                            <h3 class="title">Marketing & Reporting</h3>
                                            <p>I throw myself down among the tall grass by the stream as I lie close to
                                                the earth.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Single Service  -->

                        <!-- Start Single Service  -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30">
                            <div class="single-service service__style--2 bg-color-gray">
                                <a href="{{route('service_detail', ['type' => 'webdev'])}}">
                                    <div class="service">
                                        <div class="icon">
                                            <i data-feather="activity"></i>
                                        </div>
                                        <div class="content">
                                            <h3 class="title">Mobile Development</h3>
                                            <p>I throw myself down among the tall grass by the stream as I lie close to
                                                the earth.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Single Service  -->
                    </div>
                </div>
            </div>
            <!-- Start Service Area  -->



        </main>

        @include('layout/footer')
    </div>

    @include('layout/script')


</body>

</html>


