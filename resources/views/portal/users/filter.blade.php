<div class="row">

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="" name="searchform" id="searchform" action="" method="get" autocomplete="on">
                <h4 class="card-title">Search</h4>
                <div class="form-group row">
                    <div class="col">
                        <label for="s_user">@lang('lang.name')</label>
                        <div id="the-basics">
                            <input type="text" class="form-control typeahead tt-input" name="s_name" id="s_name" placeholder="@lang('lang.name')">
                        </div>
                    </div>

                    <div class="col">
                        <label for="s_user">@lang('lang.username')</label>
                        <div id="the-basics">
                            <input type="text" class="form-control typeahead tt-input" name="s_username" id="s_username" placeholder="@lang('lang.username')">
                        </div>
                    </div>

                    <div class="col">
                        <label for="s_user">@lang('lang.email')</label>
                        <div id="the-basics">
                            <input type="text" class="form-control typeahead tt-input" name="s_email" id="s_email" placeholder="@lang('lang.email')">
                        </div>
                    </div>

                    <div class="col">
                        <label for="s_status">@lang('lang.status')</label>
                        <div id="bloodhound">
                            <select id="s_status" name="s_status" class="form-control custom-select">
                                <option value="" selected>@lang('lang.default_select')</option>
                                @foreach($statuses ?? '' as $val)
                                    <option value="{{$val->id}}">{{ucfirst(trans('lang.' . $val->name ))}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <label for="s_role">@lang('lang.role')</label>
                        <div id="bloodhound">
                            <select id="s_role" name="s_role" class="form-control custom-select">
                                <option value="" selected>@lang('lang.default_select')</option>
                                @foreach($roles ?? '' as $val)
                                    <option value="{{$val->id}}">{{ $val->name }}</option>
                                @endforeach
                            </select>
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

</div>


