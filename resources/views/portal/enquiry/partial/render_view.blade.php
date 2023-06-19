@if($result)

<div class="row text-capitalize">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="created" class="col-sm-3 col-form-label">@lang('lang.created')</label>
			<div class="col-sm-9"> {{ $result->created }}</div>
		</div>
	</div>
</div>

<div class="row">

    <div class="col-md-6">
		<div class="form-group row">
			<label for="name" class="col-sm-3 col-form-label">@lang('lang.name')</label>
			<div class="col-sm-9">
				{{ $result->name }}
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="email" class="col-sm-3 col-form-label">@lang('lang.email')</label>
			<div class="col-sm-9">
				{{ $result->email }}
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="subject" class="col-sm-3 col-form-label">@lang('lang.subject') </label>
			<div class="col-sm-9">
				{{ $result->subject }}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label for="message" class="col-sm-3 col-form-label">@lang('lang.message') </label>
			<div class="col-sm-9">
				{{ $result->message }}
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="replied" class="col-sm-3 col-form-label">@lang('lang.replied') </label>
			<div class="col-sm-9">
                @if($result->is_replied == 1 )
                    <label class='badge badge-success text-white'>Yes</label>
                @else
                    <label class='badge badge-dark text-white'>No</label>
                @endif
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="is_converted" class="col-sm-3 col-form-label">@lang('lang.converted') </label>
			<div class="col-sm-9">
                @if($result->is_converted == 1 )
                    <label class='badge badge-success text-white'>Yes</label>
                @else
                    <label class='badge badge-dark text-white'>No</label>
                @endif
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

