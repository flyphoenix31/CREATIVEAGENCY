
    @if(!$result->isEmpty())
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-capitalize">@lang('lang.invoice'){!! "&nbsp;" !!}@lang('lang.list')</h4>
                <div class="table-responsive ">
                    <table class="table table-bordered table-striped mb-4" id="listtable">
                        <thead>
                            <tr class="text-capitalize">
                                <th>@lang('lang.invoice_number')</th>
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.email')</th>
                                <th>@lang('lang.date')</th>
                                <th>@lang('lang.due_date')</th>
                                <th>@lang('lang.amount')</th>
                                <th>@lang('lang.created_by')</th>
                                <th>@lang('lang.status')</th>
                                <th class="no-content">@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('portal.invoice.partial.render_data')
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



