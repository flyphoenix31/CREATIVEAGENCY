<div class="filters-column col-lg-4 col-md-12 col-sm-12">

    <form name="formsearch" id="formsearch" method="POST" action="">
        @csrf
    <div class="inner-column">
        <div class="filters-outer">
            <button type="button" class="theme-btn close-filters">X</button>

            <!-- Filter Block -->
            <div class="filter-block">
                <h4>Search by Keywords</h4>
                <div class="form-group">
                    <input type="text" name="keywords" placeholder="Job title, keywords, Category">
                    <span class="icon flaticon-search-3"><i class="fal fa-search"></i></span>
                </div>
            </div>

            <!-- Filter Block -->
            <div class="filter-block">
                <h4>Category</h4>
                <div class="form-group">


                    {!! Form::select("category_id[]", $categories, null , ['class' => 'form-control select2', 'multiple', 'id' => 'category_id', 'required']); !!}
                </div>
            </div>

            <!-- Switchbox Outer -->
            <div class="switchbox-outer">
                <h4>Job type</h4>

                <ul class="checkboxes">
                    <li>
                        <label class="new-control new-checkbox new-checkbox-rounded  checkbox-outline-primary">
                            <input type="checkbox" class="new-control-input" name="job_type[]" id="job_type" value="1" checked>
                            <span class="new-control-indicator"></span>Full Time
                          </label>
                    </li>

                    <li>
                        <label class="new-control new-checkbox new-checkbox-rounded  checkbox-outline-primary">
                            <input type="checkbox" class="new-control-input" name="job_type[]" id="job_type" value="2" checked>
                            <span class="new-control-indicator"></span>Part Time
                          </label>
                    </li>

                    <li>
                        <label class="new-control new-checkbox new-checkbox-rounded  checkbox-outline-primary">
                            <input type="checkbox" class="new-control-input" name="job_type[]" id="job_type" value="3" checked>
                            <span class="new-control-indicator"></span>Remote
                          </label>
                    </li>

                </ul>

                {{-- <ul class="switchbox">
                    <li>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                            <span class="title">Full Time</span>
                        </label>
                    </li>
                    <li>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                            <span class="title">Part Time</span>
                        </label>
                    </li>
                    <li>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                            <span class="title"></span>
                        </label>
                    </li>
                </ul> --}}
            </div>

            <!-- Checkboxes Ouer -->
            <div class="checkbox-outer">
                <h4>Date Posted</h4>
                <ul class="checkboxes">
                    <li>
                        <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                            <input type="radio" class="new-control-input" name="date_posted" id="date_posted" value="" checked>
                            <span class="new-control-indicator"></span>All
                          </label>
                    </li>
                    <li>
                        <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                            <input type="radio" class="new-control-input" name="date_posted" id="date_posted" value="1">
                            <span class="new-control-indicator"></span>Last Hour
                          </label>
                    </li>
                    <li>
                        <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                            <input type="radio" class="new-control-input" name="date_posted" id="date_posted" value="2">
                            <span class="new-control-indicator"></span>Last 24 Hours
                          </label>
                    </li>
                    <li>
                        <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                            <input type="radio" class="new-control-input" name="date_posted" id="date_posted" value="3">
                            <span class="new-control-indicator"></span>Last 7 Days
                          </label>
                    </li>
                    <li>
                        <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                            <input type="radio" class="new-control-input" name="date_posted" id="date_posted" value="4">
                            <span class="new-control-indicator"></span>Last 14 Days
                          </label>
                    </li>
                    <li>
                        <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                            <input type="radio" class="new-control-input" name="date_posted" id="date_posted" value="4">
                            <span class="new-control-indicator"></span>Last 30 Days
                          </label>
                    </li>

                </ul>
            </div>



            <!-- Filter Block -->
            <div class="filter-block">
                <h4>Budget</h4>

                <div class="row mb-4">
                    <div class="col">
                        <input type="text" class="form-control allowNumberonly" maxlength="5" name="min_budget" placeholder="Min">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control allowNumberonly" maxlength="5" name="max_budget" placeholder="Max">
                    </div>
                </div>


            </div>


            <div class="filter-block">
                <button type="submit" class="btn btn-primary mb-2 mr-2">Search</button>
                <button type="reset" id="clrForm" class="btn btn-danger mb-2">Clear All</button>
            </div>


        </div>


    </div>

    </form>
</div>
