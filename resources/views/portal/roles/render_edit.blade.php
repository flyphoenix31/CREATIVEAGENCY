@csrf
<div class="" id="validation-errors"></div>

<input type="hidden" name="id" id="id" value="{{$id}}">

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="name" class="col-sm-3 col-form-label">@lang('lang.role') @lang('lang.name') <span class="text-danger">*</span></label>
			<div class="col-sm-9">
				<input id="name" name="name" placeholder="@lang('lang.role') @lang('lang.name')" class="form-control" type="text" autofocus value="{{ $role->name }}" required>
			</div>
		</div>
	</div>
</div>

<h5 class="mb-4 mt-3">@lang('lang.permission') @lang('lang.list')</h5>
<div class="row">

	<div class="form-group container">
		<div class="form-row">
			@foreach($permissions as $permission)
				<div class="col-3">

					<label class="new-control new-checkbox new-checkbox-text checkbox-success">
					      <input type="checkbox" class="new-control-input" value="{{ $permission->name }}" name="permission[{{ $permission->id }}]" id="permission[]" {{ in_array($permission->id, $rolePermissions) ? 'checked' : false }}>
					      <span class="new-control-indicator"></span><span class="new-chk-content">{{ $permission->name }}</span>
					    </label>
				    </div>
			@endforeach
		</div>
	</div>

</div>



<div class="row">

</div>


