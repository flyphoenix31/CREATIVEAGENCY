@if($result)
<input id="id" name="id" class=" form-control" type="hidden" value="{{$result->id}}">  
<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="name" class="col-sm-3 col-form-label">@lang('lang.name') <span class="text-danger">*</span></label>
			<div class="col-sm-9">
				<input id="name" name="name" placeholder="@lang('lang.name')" class="form-control" type="text" value="{{ $result->name }}" required autofocus>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="username" class="col-sm-3 col-form-label">@lang('lang.username')</label>
			<div class="col-sm-9">
				<input id="username" name="username" placeholder="@lang('lang.username')" class="form-control" type="text" value="{{ $result->username }}" >
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="email" class="col-sm-3 col-form-label">@lang('lang.email') </label>
			<div class="col-sm-9">
				<input id="email" name="email" placeholder="@lang('lang.email')" class="form-control" type="text" value="{{ $result->email }}" >
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label for="phone" class="col-sm-3 col-form-label">@lang('lang.phone') </label>
			<div class="col-sm-9">
				<input id="phone" name="phone" placeholder="@lang('lang.phone')"  class="form-control" type="text" value="{{ $result->phone }}" >
			</div>
		</div>
	</div>
</div>	

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="gender_id" class="col-sm-3 col-form-label">@lang('lang.gender') </label>
			<div class="col-sm-9">
			<select id="gender_id" name="gender_id" class="form-control custom-select text-capitalize" data-live-search="true">   
				<option value="">@lang('lang.default_select') </option>                                             
				@foreach($genders as $val)
					<option value="{{$val->id}}" @if ($val->id == $result->gender_id) selected="selected" @endif >{{ ucfirst($val->name) }}</option>
				@endforeach
			</select>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group row">
			<label for="status_id" class="col-sm-3 col-form-label">@lang('lang.status') <span class="text-danger">*</span></label>
			<div class="col-sm-9">
			<select id="status_id" name="status_id" class="form-control custom-select text-capitalize" data-live-search="true">   
				<option value="">@lang('lang.default_select') </option>                                             
				@foreach($statuses as $val)
					<option value="{{$val->id}}" @if ($val->id == $result->status_id) selected="selected" @endif>{{ucfirst ( trans('lang.' . $val->name ) )}} </option>
				@endforeach
			</select>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="role" class="col-sm-3 col-form-label">@lang('lang.role') <span class="text-danger">*</span></label>
			<div class="col-sm-9">
				<select id="role" name="role" class="form-control custom-select text-capitalize" data-live-search="true">   
					<option value="">@lang('lang.default_select') </option>                                             
					@foreach ($roles as $role)
						<option value="{{$role->name}}" {{ $result->roles->contains($role->id) ? 'selected' : '' }} >{{ucfirst($role->name)}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
<div>



@section('bottom_js')
@parent
<script type="text/javascript">
   
</script>                   
@endsection					

@endif

