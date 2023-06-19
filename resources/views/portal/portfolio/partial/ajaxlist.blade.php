@if(!$result->isEmpty())
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-capitalize">@lang('lang.portfolio'){!! "&nbsp;" !!}@lang('lang.list')</h4>
                <div class="table-responsive ">
                    <table class="table table-bordered table-striped mb-4" id="listtable">
                        <thead>
                            <tr class="text-capitalize">
                                <th>#</th>
                                <th>@lang('lang.created')</th>
                                <th>@lang('lang.title')</th>
                                <th>@lang('lang.tag')</th>
                                <th>@lang('lang.is_featured')</th>
                                <th>@lang('lang.image')</th>
                                <th>@lang('lang.banner')</th>
                                <th>@lang('lang.status')</th>
                                <th class="no-content">@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('portal.portfolio.partial.render_data')
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



