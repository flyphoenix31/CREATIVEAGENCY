@if($result)

<div class="row text-capitalize">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="created" class="col-sm-3 col-form-label">@lang('lang.created')</label>
			<div class="col-sm-9"> {{ $result->created ?? '' }}</div>
		</div>
	</div>
</div>

<div class="row">

    <div class="col-md-6">
		<div class="form-group row">
			<label for="title" class="col-sm-3 col-form-label">@lang('lang.title')</label>
			<div class="col-sm-9">
				{{ $result->title }}
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="sub_title" class="col-sm-3 col-form-label">@lang('lang.sub_title')</label>
			<div class="col-sm-9">
				{{ $result->sub_title }}
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="form-group row">
			<label for="content" class="col-sm-3 col-form-label">@lang('lang.content') </label>
			<div class="col-sm-9">
				 {!! $result->content !!}
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="image" class="col-sm-3 col-form-label">@lang('lang.image') </label>
			<div class="col-sm-9">
                <div class="avatar avatar-xl">
                    <img alt="avatar" src="{{ $result->image }}" class="rounded" />
                </div>

			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="banner" class="col-sm-3 col-form-label">@lang('lang.banner') </label>
			<div class="col-sm-9">
				<div class="avatar avatar-xl">
                    <img alt="avatar" src="{{ $result->banner }}" class="rounded" />
                </div>
			</div>
		</div>
	</div>

</div>


<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="is_featured" class="col-sm-3 col-form-label">@lang('lang.is_featured') </label>
			<div class="col-sm-9">
                @if($result->is_featured == 1 )
                    <label class='badge badge-primary text-white'>Yes</label>
                @else
                    <label class='badge badge-dark text-white'>No</label>
                @endif
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="status" class="col-sm-3 col-form-label">@lang('lang.status') </label>
			<div class="col-sm-9">
                @if($result->status_id == 1 )
                    <label class='badge badge-success text-white'>Active</label>
                @else
                    <label class='badge badge-dark text-white'>InActive</label>
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

