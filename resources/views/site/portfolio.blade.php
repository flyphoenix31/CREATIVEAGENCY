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
                            <h2 class="title">Portfolio</h2>
                            <ul class="page-list">
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li class="current-page">Portfolio</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrump Area  -->
        <main class="page-wrapper">

            <!-- Start Portfolio Area  -->
            {{-- Featured list will be here --}}
            <!-- Start Portfolio Area  -->

            <!-- Start Portfolio Area  -->
            <div class="rn-portfolio-area rn-section-gap bg_color--5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-center mb--20">
                                <h2 class="title">All Works</h2>
                                <p>There are many variations of passages of Lorem Ipsum available, <br /> but the
                                    majority have suffered alteration.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($records as $record)

                        <!-- Start Single Portfolio  -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--40">
                            <div class="portfolio">
                                <a href="{{route('portfolio_detail', ['type' => $record->slug_url])}}">
                                    <div class="thumbnail-inner">
                                        <div class="thumbnail image-56" style="background-image: url({{$record->image}})"></div>
                                        <div class="bg-blr-image image-5"></div>
                                    </div>
                                    <div class="content">
                                        <div class="inner">
                                            <p>{{$record->tag}}</p>
                                            <h4>{{$record->title}}</h4>
                                            <div class="portfolio-button">
                                                <span class="rn-btn">Case Study</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Single Portfolio  -->

                        @endforeach

                        {{-- <!-- Start Single Portfolio  -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--40">
                            <div class="portfolio">
                                <div class="thumbnail-inner">
                                    <div class="thumbnail image-9"></div>
                                    <div class="bg-blr-image image-9"></div>
                                </div>
                                <div class="content">
                                    <div class="inner">
                                        <p>Development</p>
                                        <h4><a href="portfolio-details.html">Getting tickets to the big show</a></h4>
                                        <div class="portfolio-button">
                                            <a class="rn-btn" href="portfolio-details.html">Case Study</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Portfolio  --> --}}
                    </div>
                </div>
            </div>
            <!-- Start Portfolio Area  -->
        </main>

        @include('layout/footer')
    </div>

    @include('layout/script')


</body>

</html>

