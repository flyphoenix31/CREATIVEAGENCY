
<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="name" class="col-sm-3 col-form-label">@lang('lang.name') <span class="text-danger">*</span></label>
			<div class="col-sm-9">
				<input id="name" name="name" placeholder="@lang('lang.name')" class="form-control" type="text" value="" required autofocus>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="username" class="col-sm-3 col-form-label">@lang('lang.username')</label>
			<div class="col-sm-9">
				<input id="username" name="username" placeholder="@lang('lang.username')" class="form-control" type="text" value="" >
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="email" class="col-sm-3 col-form-label">@lang('lang.email') </label>
			<div class="col-sm-9">
				<input id="email" name="email" placeholder="@lang('lang.email')" class="form-control" type="text" value="" required>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label for="phone" class="col-sm-3 col-form-label">@lang('lang.phone') </label>
			<div class="col-sm-9">
				<input id="phone" name="phone" placeholder="@lang('lang.phone')"  class="form-control" type="text" value="" >
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
					<option value="{{$val->id}}" >{{ ucfirst($val->name) }}</option>
				@endforeach
			</select>
			</div>
		</div>
	</div>	
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label">@lang('lang.password') <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <input id="password" name="password" class="form-control" type="password" value="" maxlength="30">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label for="password_confirmation" class="col-sm-3 col-form-label">@lang('lang.confirm_password')  <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <input id="password_confirmation" name="password_confirmation" class="form-control" type="password" value="" maxlength="30">
            </div>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="role" class="col-sm-3 col-form-label">@lang('lang.role') <span class="text-danger">*</span></label>
			<div class="col-sm-9">
				<select id="role" name="role" class="form-control custom-select text-capitalize">   
					<option value="">@lang('lang.default_select') </option>                                             
					@foreach ($roles as $role)
						<option value="{{$role->name}}"> {{ucfirst($role->name)}} </option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
</div>