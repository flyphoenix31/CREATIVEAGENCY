<input id="id" name="id" class=" form-control" type="hidden" value="{{$result->id}}">

<div class="" id="validation-errors"></div>

<div class="form-group row mb-4">
    <label for="" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">@lang('lang.current') @lang('lang.status')</label>
    <div class="col-xl-10 col-lg-9 col-sm-10">
        <span class="badge badge-{{ $result->status->color ?? 'dark'}}"> @lang('lang.'.$result->status->name)  </span>
    </div>
</div>

<div class="form-group row mb-4">
    <label for="status_id" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">@lang('lang.new') @lang('lang.status')<span class="text-danger">*</span></label>
    <div class="col-xl-10 col-lg-9 col-sm-10">
        <select id="status_id" name="status_id" class="form-control custom-select text-capitalize">
				@foreach($statuses as $val)
					<option @if ($val->id == $result->status_id)
							selected="selected"
						 @endif	 value="{{$val->id}}">{{trans('lang.' . $val->name )}}</option>
				@endforeach
				</select>
    </div>
</div>

