
<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
    <div class="card">
        <div class="card-body">
            <form class="text-capitalize" name="searchform" id="searchform" action="" method="get" autocomplete="on">
                <h4 class="card-title">@lang('lang.search')</h4>
                <div class="form-group row">

                    <div class="col">
                        <label for="sku">@lang('lang.email')</label>
                        <div id="the-basics">
                            <input type="text" class="form-control typeahead tt-input" name="s_email" id="s_email" placeholder="@lang('lang.email')" value="{{request()->get('email')}}">
                        </div>
                    </div>
                    <div class="col">
                        <label for="invoice">@lang('lang.invoice') @lang('lang.number')</label>
                        <div id="the-basics">
                            <input type="text" class="form-control typeahead tt-input" name="invoice" id="invoice" placeholder="@lang('lang.invoice') @lang('lang.number')">
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



