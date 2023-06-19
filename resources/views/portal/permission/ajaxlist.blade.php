<div class="row">
    @if(!$result->isEmpty())
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-capitalize">@lang('lang.permission'){!! "&nbsp;" !!}@lang('lang.list')</h4>
                <div class="panel-body table-responsive ">
                    <table class="table  table-striped text-capitalize" id="listtable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('lang.name')</th>
                                <th class="">@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('portal.permission.render_data')
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <h3 class="mt-3 mb-3 text-danger font-weight-medium text-center">
                     @lang('lang.no_record_found') </h3>
              </div>
            </div>
    @endif
    </div>


