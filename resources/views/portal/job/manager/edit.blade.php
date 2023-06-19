<form class="form-sample  text-capitalize" name="formadd" id="formadd" action="" method="post" autocomplete="on" >
    @csrf
    <input type="hidden" name="id" value="{{ encryptId($record->id)}}">
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>@lang('lang.edit'){{' '}} @lang('lang.job')</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form>
                    <div class="form-group mb-4">
                        <label for="title">@lang('lang.title')</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="@lang('lang.title')" value="{{ $record->title }}">

                    </div>

                    <div class="form-group mb-4">
                        <label for="delivery_day">@lang('lang.deliver_time')</label>
                        <input type="text" class="form-control allowNumberonly" id="delivery_day" name="delivery_day" maxlength="3" placeholder="In days" value="{{ $record->delivery_day }}">
                    </div>

                    <div class="form-group mb-4">
                        <label for="budget">@lang('lang.budget')</label>
                        <input type="text" class="form-control allowPriceonly" id="budget" name="budget" maxlength="5" placeholder="Your Max budget" value="{{ $record->budget }}">
                    </div>


                    @if($record->type_id == 2)
                        <div class="form-group mb-4">
                            <label for="user_id">@lang('lang.designers')</label>

                            {!! Form::select("users[]", $users, $selUsers, ['class' => 'form-control select2', 'multiple', 'id' => 'user_id']); !!}

                        </div>
                    @else
                        <div class="form-group mb-4">
                            <label for="role_id">@lang('lang.role')</label>

                            {!! Form::select("role_id", $roles, $record->job_nature , ['class' => 'form-control select2', 'id' => 'role_id', 'required','placeholder' => 'Select Role..']); !!}

                        </div>
                    @endif

                    <div class="form-group mb-4">
                        <label for="job_nature">@lang('lang.job_nature')</label>
                        {!! Form::select("job_nature", ['1' => 'Full Time' ,'2' => 'Part Time' ,'3' => 'Remote'], $record->job_nature , ['class' => 'form-control select2', 'id' => 'job_nature', 'required']); !!}
                    </div>

                    <div class="form-group mb-4">
                        <label for="category_id">@lang('lang.category')</label>
                        {!! Form::select("category_id[]", $categories, $selCat , ['class' => 'form-control select2', 'multiple', 'id' => 'category_id', 'required']); !!}
                    </div>

                    <div class="form-group mb-4">

                        <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-primary">
                              <input type="checkbox" class="new-control-input" name="is_featured" id="is_featured" value="1" @if($record->is_featured == 1) checked @endif>
                              <span class="new-control-indicator"></span>@lang('lang.is_featured') @lang('lang.job')
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-primary">
                              <input type="checkbox" class="new-control-input" name="is_urgent" id="is_urgent" value="1" @if($record->is_urgent == 1) checked @endif>
                              <span class="new-control-indicator"></span>@lang('lang.urgent') @lang('lang.job')
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="short_description">@lang('lang.short_description')</label>
                        <textarea class="form-control" id="short_description" name="short_description" rows="3" placeholder="Your Job Short Description">{{$record->short_description}}</textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label for="full_description">@lang('lang.full_description')</label>
                        <textarea class="form-control" id="full_description" name="full_description" rows="7" placeholder="Your Job Description">{{$record->full_description}}</textarea>
                    </div>

                    <button type="submit" name="time" class="mt-4 mb-4 btn btn-primary">@lang('lang.save') </button>
                </form>
            </div>
        </div>
    </div>


</form>





@include('portal.job.manager.script_edit')
