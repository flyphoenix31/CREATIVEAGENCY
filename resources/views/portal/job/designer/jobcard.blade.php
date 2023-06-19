
<section class="ls-section">
    <div class="auto-container">
        <div class="filters-backdrop"></div>

        <div class="row">

            <!-- Filters Column -->

            @include('portal.job.designer.micro.job_filter')



            <!-- Content Column -->
            <div class="content-column col-lg-8 col-md-12 col-sm-12">
                <div class="ls-outer">
                    <button type="button" class="theme-btn btn-style-two toggle-filters">Show Filters</button>

                    <!-- ls Switcher -->
                   {{--  <div class="ls-switcher">
                        <div class="showing-result">
                            <div class="text">Showing <strong>41-60</strong> of <strong>944</strong> jobs</div>
                        </div>

                    </div> --}}
                    <div id="jobdiv">
                        @include('portal.job.designer.micro.card')
                    </div>



                   <!-- Listing Show More -->
                    <div class="ls-show-more">
                        {{-- <p>Showing 36 of 497 Jobs</p>
                        <div class="bar"><span class="bar-inner" style="width: 40%"></span></div>
                        <button class="show-more">Show More</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>







@include('portal.job.designer.script_board')













