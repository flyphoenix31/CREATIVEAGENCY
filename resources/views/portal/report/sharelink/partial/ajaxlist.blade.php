@if(!$result->isEmpty())
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-capitalize">@lang('lang.shared'){!! "&nbsp;" !!}@lang('lang.list')</h4>
                <div class="table-responsive ">
                    <table class="table table-bordered table-striped mb-4" id="listtable">
                        <thead>
                            <tr class="text-capitalize">
                                <th>Created</th>
                                <th>Type</th>
                                <th>User</th>
                                <th>Link</th>
                                <th>Expire</th>
                                <th>Protected</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('portal.report.sharelink.partial.render_data')
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



