@if($result)

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="is_autorenew" class="col-sm-3 col-form-label">@lang('lang.is_autorenew')</label>
			<div class="col-sm-9">
                <select id="is_autorenew" name="is_autorenew" class="form-control custom-select text-capitalize" data-live-search="true">
                    <option value="1">Yes</option>
                    <option value="">No</option>
                </select>
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="name" class="col-sm-3 col-form-label">@lang('lang.domain'){!! "&nbsp;" !!}@lang('lang.name')<span class="text-danger">*</span></label>
			<div class="col-sm-9">
				<input id="name" name="name" placeholder="@lang('lang.domain'){!! "&nbsp;" !!}@lang('lang.name')" class="form-control" type="text" value="" required>
			</div>
		</div>
	</div>
</div>

<div class="row">

    <div class="col-md-6">
		<div class="form-group row">
			<label for="customer_name" class="col-sm-3 col-form-label">@lang('lang.customer'){{' '}}@lang('lang.name')</label>
			<div class="col-sm-9">
				<input id="customer_name" name="customer_name" placeholder="@lang('lang.customer'){{' '}}@lang('lang.name')" class="form-control" type="text" value="" required>
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="hosting_provider_name" class="col-sm-3 col-form-label">@lang('lang.provider_name')</label>
			<div class="col-sm-9">
				<input id="hosting_provider_name" name="hosting_provider_name" placeholder="@lang('lang.provider_name')" class="form-control" type="text" value="" required>
			</div>
		</div>
	</div>


</div>

<div class="row">

    <div class="col-md-6">
		<div class="form-group row">
			<label for="reg_at" class="col-sm-3 col-form-label">@lang('lang.reg_at')</label>
			<div class="col-sm-9">
                <input type="text" class="pickdate form-control" id="reg_at" name="reg_at" value="">
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="expire_at" class="col-sm-3 col-form-label">@lang('lang.expire_at')</label>
			<div class="col-sm-9">
				<input id="expire_at" name="expire_at" type="text" value="" class="pickdate form-control">
			</div>
		</div>
	</div>


</div>




<div class="row">
	<div class="col-md-12">
		<div class="form-group row">
			<label for="remark" class="col-sm-3 col-form-label">@lang('lang.remark') </label>
			<div class="col-sm-9">
                <textarea id="remark" name="remark" class="form-control text-capitalize" placeholder="Some Notes about the Domain."></textarea>
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

