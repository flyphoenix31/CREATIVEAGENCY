@if($result)

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="title" class="col-sm-3 col-form-label">@lang('lang.title')</label>
			<div class="col-sm-9">
                <select id="title" name="title" class="form-control custom-select text-capitalize" data-live-search="true">
                    <option value="1">{{ ucfirst('mr') }}</option>
                    <option value="2">{{ ucfirst('ms') }}</option>
                    <option value="3">{{ ucfirst('mrs') }}</option>
                    <option value="4">{{ ucfirst('dr') }}</option>
                </select>
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="name" class="col-sm-3 col-form-label">@lang('lang.contact'){!! "&nbsp;" !!}@lang('lang.name')<span class="text-danger">*</span></label>
			<div class="col-sm-9">
				<input id="name" name="name" placeholder="@lang('lang.name')" class="form-control" type="text" value="" required>
			</div>
		</div>
	</div>
</div>

<div class="row">

    <div class="col-md-6">
		<div class="form-group row">
			<label for="website" class="col-sm-3 col-form-label">@lang('lang.website')</label>
			<div class="col-sm-9">
				<input id="website" name="website" placeholder="@lang('lang.website')" class="form-control" type="text" value="">
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="email" class="col-sm-3 col-form-label">@lang('lang.email')<span class="text-danger">*</span></label>
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
			<label for="status_id" class="col-sm-3 col-form-label">@lang('lang.status') </label>
			<div class="col-sm-9">
                <select id="status_id" name="status_id" class="form-control custom-select text-capitalize" data-live-search="true">
                    <option value="1">{{ ucfirst('active') }}</option>
                    <option value="2">{{ ucfirst('in active') }}</option>
                </select>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="form-group row">
			<label for="remark" class="col-sm-3 col-form-label">@lang('lang.remark') </label>
			<div class="col-sm-9">
                <textarea id="remark" name="remark" class="form-control text-capitalize" placeholder="Some Notes about the Contact."></textarea>
			</div>
		</div>
	</div>
</div>





@section('bottom_js')
@parent
<script type="text/javascript">

</script>
@endsection

@endif

