
<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
    <div class="card">
        <div class="card-body">
            <form class="text-capitalize" name="searchform" id="searchform" action="" method="get" autocomplete="on">
                <h4 class="card-title">@lang('lang.search')</h4>
                <div class="form-group row">

                    <div class="col">
                        <label for="name">@lang('lang.name')</label>
                        <div id="the-basics">
                            <input type="text" class="form-control typeahead tt-input" name="s_name" id="s_name" placeholder="@lang('lang.name')">
                        </div>
                    </div>
                    <div class="col">
                        <label for="s_hosting_name">@lang('lang.hosting_name')</label>
                        <div id="the-basics">
                            <input type="text" class="form-control typeahead tt-input" name="s_hosting_name" id="s_hosting_name" placeholder="@lang('lang.hosting_name')">
                        </div>
                    </div>

                    <div class="col">
                        <label for="s_customer_name">@lang('lang.customer_name')</label>
                        <div id="the-basics">
                            <input type="text" class="form-control typeahead tt-input" name="s_customer_name" id="s_customer_name" placeholder="@lang('lang.customer_name')">
                        </div>
                    </div>

                    <div class="col" >
                        <div class="custom-control custom-checkbox mt-4">
                            <input type="checkbox" class="custom-control-input" id="showexpiringitems" name="showexpiringitems" value="1">
                            <label class="custom-control-label" for="showexpiringitems">Show Only Expiring items</label>
                        </div>
                    </div>



                    <div class="col">
                        <label>@lang('lang.action')</label>
                        <div id="bloodhound">
                            <button type="button" id="search" class="btn btn-icons btn-rounded btn-outline-info btn-inverse-info search rounded-circle"> <i class="fad fa-search"></i> </button>
                            <button type="button" id="reset_search" class="btn btn-icons btn-rounded btn-outline-danger btn-inverse-danger rounded-circle"> <i class="fad fa-redo"></i> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



