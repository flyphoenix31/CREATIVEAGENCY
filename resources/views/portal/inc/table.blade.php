@if(!empty($firstload))
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <h3 class="mt-3 mb-3 text-primary font-weight-medium text-center text-capitalize ajaxloadlabel"> @lang('lang.please_wait') </h3>
        </div>
    </div>
@else
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <h3 class="mt-3 mb-3 text-warning font-weight-medium text-center text-capitalize ajaxloadlabel"><i class="fad fa-cat fa-5x"></i> </h3>
            <h3 class="mt-3 mb-3 text-warning font-weight-medium text-center text-capitalize ajaxloadlabel">@lang('lang.no_record_found') </h3>
        </div>
    </div>
@endif
