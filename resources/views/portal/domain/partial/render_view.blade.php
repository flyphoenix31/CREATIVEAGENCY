@if($result)

<div class="row text-capitalize">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="title" class="col-sm-3 col-form-label">@lang('lang.is_autorenew')</label>
			<div class="col-sm-9">
                @if($result->is_autorenew == 1 )
                    <label class='badge badge-success text-white'>Yes</label>
                @else
                    <label class='badge badge-dark'>No</label>
                @endif
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="name" class="col-sm-4 col-form-label">@lang('lang.domain'){!! "&nbsp;" !!}@lang('lang.name')</label>
			<div class="col-sm-8"> {{ $result->name }} </div>
		</div>
	</div>
</div>

<div class="row">

    <div class="col-md-6">
		<div class="form-group row">
			<label for="customer_name" class="col-sm-3 col-form-label">@lang('lang.customer'){{' '}}@lang('lang.name')</label>
			<div class="col-sm-9">
				{{ $result->customer_name }}
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="provider_name" class="col-sm-3 col-form-label">@lang('lang.provider_name')</label>
			<div class="col-sm-9">
				{{ $result->hosting_provider_name }}
			</div>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="reg_at" class="col-sm-3 col-form-label">@lang('lang.reg_at') </label>
			<div class="col-sm-9">
				{{ $result->reg_at->format('M d Y') }}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label for="expire_at" class="col-sm-3 col-form-label">@lang('lang.expire_at') </label>
			<div class="col-sm-9">
				{{ $result->expire_at->diffForHumans() }}
			</div>
		</div>
	</div>
</div>



<div class="row">
	<div class="col-md-12">
		<div class="form-group row">
			<label for="remark" class="col-sm-3 col-form-label">@lang('lang.remark') </label>
			<div class="col-sm-9">
                {{$result->remark}}
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

