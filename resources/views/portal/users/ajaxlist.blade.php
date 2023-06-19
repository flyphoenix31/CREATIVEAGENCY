<div class="row">
    @if(!$result->isEmpty())
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-capitalize">@lang('lang.user'){!! "&nbsp;" !!}@lang('lang.list')</h4>
                <div class="panel-body table-responsive text-capitalize">
                    <table class="table" id="listtable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll" ></th>
                                <th>#</th>
                                <th>@lang('lang.created_at')</th>
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.username')</th>
                                <th>@lang('lang.email')</th>
                                <th>@lang('lang.role')</th>
                                <th>@lang('lang.status')</th>
                                <th class="">@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        <form name="formuser" id="formuser" action="" method="post" autocomplete="off" >
                        @csrf
                            @include('portal.users.render_data')
                        </form>
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
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <h3 class="mt-3 mb-3 text-danger font-weight-medium text-center">
                     @lang('lang.no_record_found') </h3>
              </div>
            </div>
    @endif
    </div>


