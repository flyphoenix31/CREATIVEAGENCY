<input id="id" name="id" class=" form-control" type="hidden" value="{{$result->id}}">

<div class="" id="validation-errors"></div>

<div class="form-group row mb-4">
    <label for="" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">@lang('lang.current') @lang('lang.status')</label>
    <div class="col-xl-10 col-lg-9 col-sm-10">

        @if($result->status_id == 1 )
            <span class="badge badge-success"> Active </span>
        @else
            <span class='badge badge-dark'>Inactive</span>
        @endif


    </div>
</div>

<div class="form-group row mb-4">
    <label for="status_id" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">@lang('lang.new') @lang('lang.status')<span class="text-danger">*</span></label>
    <div class="col-xl-10 col-lg-9 col-sm-10">
        <select id="status_id" name="status_id" class="form-control">

            <option @if (1 == $result->status_id) selected="selected" @endif value="1">Active</option>
            <option @if (2 == $result->status_id) selected="selected" @endif value="2">In Active</option>
				</select>
    </div>
</div>

