
<div class="layout-px-spacing">
	<div class="row layout-top-spacing">
		<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
			<div class="widget-content widget-content-area br-6">
				<form class="form-sample" action="" method="post" autocomplete="off" enctype="multipart/form-data">

					{{ csrf_field() }} @foreach ($errors->all() as $error)
					<div class="alert alert-danger" role="alert">@lang($error)</div>
					@endforeach @if(session()->has('message'))
					<div class="alert alert-success mb-4" role="alert">
						@lang('lang.setting_success_save_message ')
					</div>
					@endif

                    <div class="form-row mb-4">
						<div class="form-group col-md-6">
							<label for="bank_code">Invoice Logo</label>
							<input type="file" id="input-file-max-fs" name="invoice_logo" class="dropify" data-default-file="{{$record->image}}" data-max-file-size="2M" />
						</div>
					</div>

					<div class="form-row mb-4">
						<div class="form-group col-md-6">
							<label for="account_number">Account #</label>
							<input type="text" class="form-control form-control-sm" id="account_number" placeholder="Bank Account Number" value="{{ old('account_number') ?? $record->account_number }}" name="account_number" required>
						</div>
						<div class="form-group col-md-6">
							<label for="bank_name">Bank Name</label>
							<input type="text" class="form-control form-control-sm" id="bank_name" placeholder="Insert Bank Name" value="{{ old('bank_name') ?? $record->bank_name }}" name="bank_name" required>
						</div>
					</div>

					<div class="form-row mb-4">
						<div class="form-group col-md-6">
							<label for="bank_code">SWIFT code</label>
							<input type="text" class="form-control form-control-sm" id="bank_code" placeholder="Insert Code" value="{{ old('bank_code') ?? $record->bank_code }}" name="bank_code" required>
						</div>
					</div>

					<div class="form-row mb-4">
						<div class="form-group col-md-12">
							<label for="bank_country">Country</label>
							<select name="bank_country" class="form-control country_code  form-control-sm" id="bank_country" required>
                                <option value="">Choose Country</option>
                                <option {{old( 'bank_country',$record->bank_country)=="United States"? 'selected':''}} value="United States" selected>United States</option>
                                <option {{old( 'bank_country',$record->bank_country)=="United Kingdom"? 'selected':''}} value="United Kingdom">United Kingdom</option>
                                </select>
						</div>
					</div>


                    <button type="submit" class="btn btn-primary mt-3">@lang('lang.submit')</button>
                    <a href="" class="btn btn-light mt-3">@lang('lang.reset')</a>


                </form>
            </div>
        </div>
    </div>
</div>








