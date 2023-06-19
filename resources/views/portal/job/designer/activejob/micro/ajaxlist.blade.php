@if(!$result->isEmpty())
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-capitalize">@lang('lang.job'){!! "&nbsp;" !!}@lang('lang.list')</h4>
                <div class="table-responsive ">
                    <table class="table mb-4" id="listtable">
                        <thead>
                            <tr class="text-capitalize">
                                <th>#</th>
                                <th>@lang('lang.created')</th>
                                <th>@lang('lang.title')</th>
                                <th>@lang('lang.description')</th>
                                <th>@lang('lang.categories')</th>
                                <th>@lang('lang.budget')</th>
                                <th>@lang('lang.status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('portal.job.designer.activejob.micro.render_data')
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



