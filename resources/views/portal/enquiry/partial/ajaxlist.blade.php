<div class="row">
    @if(!$result->isEmpty())
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-capitalize">@lang('lang.enquiry'){!! "&nbsp;" !!}@lang('lang.list')</h4>
                <div class="panel-body table-responsive ">
                    <table class="table  table-striped " id="listtable">
                        <thead>
                            <tr class="text-capitalize">
                                <th>#</th>
                                <th>@lang('lang.created')</th>
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.email')</th>
                                <th>@lang('lang.subject')</th>
                                <th>@lang('lang.message')</th>
                                <th>@lang('lang.converted')</th>
                                <th>@lang('lang.replied')</th>
                                <th class="no-content">@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('portal.enquiry.partial.render_data')
                        </tbody>
                    </table>

                    <div class="paginating-container pagination-solid">
                        {!! $result->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        @include('portal.inc.table')
    @endif
    </div>


