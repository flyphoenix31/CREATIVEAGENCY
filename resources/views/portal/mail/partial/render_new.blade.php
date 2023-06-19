<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="mail_driver" class="col-sm-3 col-form-label">@lang('lang.type')</label>
			<div class="col-sm-9">
                <input id="mail_driver" name="mail_driver" placeholder="Mail Driver" class="form-control" type="text" value="">
			</div>
		</div>
	</div>
    <div class="col-md-6">
		<div class="form-group row">
			<label for="display_name" class="col-sm-3 col-form-label">@lang('lang.display'){!! "&nbsp;" !!}@lang('lang.name')</label>
			<div class="col-sm-9">
				<input id="display_name" name="display_name" placeholder="@lang('lang.name')" class="form-control" type="text" value="">
			</div>
		</div>
	</div>
</div>

<div class="row">

    <div class="col-md-6">
		<div class="form-group row">
			<label for="from_name" class="col-sm-3 col-form-label">@lang('lang.from'){!! "&nbsp;" !!}@lang('lang.name')</label>
			<div class="col-sm-9">
				<input id="from_name" name="from_name" placeholder="@lang('lang.name')" class="form-control" type="text" value="">
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="from_address" class="col-sm-3 col-form-label">@lang('lang.from_address')</label>
			<div class="col-sm-9">
				<input id="from_address" name="from_address" placeholder="@lang('lang.from_address')" class="form-control" type="text" value="">
			</div>
		</div>
	</div>

</div>

<div class="row">
    <div class="col-md-6">
		<div class="form-group row">
			<label for="mail_host" class="col-sm-3 col-form-label">@lang('lang.mail_host')<span class="text-danger">*</span></label>
			<div class="col-sm-9">
				<input id="mail_host" name="mail_host" placeholder="@lang('lang.mail_host')" class="form-control" type="text" value="" required>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group row">
			<label for="mail_username" class="col-sm-3 col-form-label">@lang('lang.username') </label>
			<div class="col-sm-9">
				<input id="mail_username" name="mail_username" placeholder="@lang('lang.username')"  class="form-control" type="text" value="" >
			</div>
		</div>
	</div>
</div>

<div class="row">

	<div class="col-md-6">
		<div class="form-group row">
			<label for="mail_password" class="col-sm-3 col-form-label">@lang('lang.password') </label>
			<div class="col-sm-9">
				<input id="mail_password" name="mail_password" placeholder="@lang('lang.password')"  class="form-control" type="password" value="" >
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="password_confirmation" class="col-sm-3 col-form-label">@lang('lang.confirm') @lang('lang.password') </label>
			<div class="col-sm-9">
				<input id="password_confirmation" name="password_confirmation" placeholder="@lang('lang.password')"  class="form-control" type="password" value="" >
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="mail_port" class="col-sm-3 col-form-label">@lang('lang.mail_port') </label>
			<div class="col-sm-9">
				<input id="mail_port" name="mail_port" placeholder="@lang('lang.mail_port')"  class="form-control" type="text" value="" >
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="mail_enc" class="col-sm-3 col-form-label">@lang('lang.mail_enc') </label>
			<div class="col-sm-9">
				<input id="mail_enc" name="mail_enc" placeholder="@lang('lang.mail_enc')"  class="form-control" type="text" value="" >
			</div>
		</div>
	</div>

</div>
