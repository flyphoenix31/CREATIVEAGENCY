<div class="" id="validation-errors"></div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group row">
				<label for="name" class="col-sm-3 col-form-label">@lang('lang.name') <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input id="name" name="name" placeholder="@lang('lang.permission') @lang('lang.name')" class="form-control" type="text" autofocus value="" required>
				</div>
			</div>
		</div>
	</div>
	<!--
	<div class="row">
		<div class="col-md-6">
			<div class="form-group row">
				<label for="name" class="col-sm-3 col-form-label">@lang('lang.module') <span class="text-danger">*</span></label>
				<div class="col-sm-9">

					<select name="module_id" id="module_id" class="form-control custom-select">
						<option value="">@lang('lang.default_select') </option>
						@foreach($module as $val)
							<option value="{{$val->id}}">{{ ucfirst($val->name) }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
	-->


