@if($result)

<div class="row text-capitalize">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="title" class="col-sm-3 col-form-label">@lang('lang.title')</label>
			<div class="col-sm-9">
                    @switch($result->status_id)
                        @case (1)
                            {{ ucfirst('mr') }}
                        @break
                        @case (2)
                            {{ ucfirst('ms') }}
                        @break
                        @case (3)
                            {{ ucfirst('mrs') }}
                        @break
                        @case (4)
                            {{ ucfirst('dr') }}
                        @break
                    @endswitch
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="name" class="col-sm-3 col-form-label">@lang('lang.contact'){!! "&nbsp;" !!}@lang('lang.name')</label>
			<div class="col-sm-8">
				<span>{{ $result->name }}</span>
			</div>
		</div>
	</div>
</div>

<div class="row">

    <div class="col-md-6">
		<div class="form-group row">
			<label for="website" class="col-sm-3 col-form-label">@lang('lang.website') <span class="text-danger">*</span></label>
			<div class="col-sm-9">
				{{ $result->website }}
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="email" class="col-sm-3 col-form-label">@lang('lang.email') </label>
			<div class="col-sm-9">
				{{ $result->email }}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label for="phone" class="col-sm-3 col-form-label">@lang('lang.phone') </label>
			<div class="col-sm-9">
				{{ $result->phone }}
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="status_id" class="col-sm-3 col-form-label">@lang('lang.status') </label>
			<div class="col-sm-9">
                @switch($result->status_id)
                    @case (1)
                        {{ ucfirst('active') }}
                    @break
                    @case (2)
                        {{ ucfirst('in active') }}
                    @break
                @endswitch
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

