@if($result)

<div class="row text-capitalize">

    <div class="col-md-6">
		<div class="form-group row">
			<label for="name" class="col-sm-3 col-form-label">@lang('lang.created')</label>
			<div class="col-sm-8 mt-2 text-info">{{ \Carbon\Carbon::parse($result->created_at)->formatLocalized('%d/%b/%y')}}</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="website" class="col-sm-3 col-form-label">@lang('lang.type')</label>
			<div class="col-sm-8 mt-2">
				{{ $result->getExtraProperty('type') }}
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="email" class="col-sm-3 col-form-label">@lang('lang.user') </label>
			<div class="col-sm-8 mt-2">
				{{ $result->causer->name ?? '' }}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label for="phone" class="col-sm-3 col-form-label">@lang('lang.description') </label>
			<div class="col-sm-8 mt-2">
				{{ $result->description }}
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="email" class="col-sm-3 col-form-label">@lang('lang.platform') </label>
			<div class="col-sm-8 mt-2">
				{{ $result->getExtraProperty('browser')}}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label for="phone" class="col-sm-3 col-form-label">@lang('lang.ip') </label>
			<div class="col-sm-8 mt-2">
				{{ $result->getExtraProperty('ip') }}
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="email" class="col-sm-3 col-form-label">@lang('lang.is_bot') </label>
			<div class="col-sm-8 mt-2">
				{{ $result->getExtraProperty('is_bot') == false ? "No" : "Yes" }}
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="email" class="col-sm-3 col-form-label">@lang('lang.user'){{' '}} @lang('lang.agent')</label>
			<div class="col-sm-8 mt-2">
				{{ $result->getExtraProperty('user_agent')  }}
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="email" class="col-sm-3 col-form-label">OS</label>
			<div class="col-sm-8 mt-2">
				{{ $result->getExtraProperty('platform')  }}
			</div>
		</div>
	</div>

    <div class="col-md-6">
		<div class="form-group row">
			<label for="email" class="col-sm-3 col-form-label">OS Version</label>
			<div class="col-sm-8 mt-2">
				{{ $result->getExtraProperty('platform_version')  }}
			</div>
		</div>
	</div>
</div>

<div class="row">
    @php
     $others = $result->getExtraProperty('others');
    @endphp

    @isset($others)
        @foreach ($others as $key => $other)
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label"> {{$key}}</label>
                    <div class="col-sm-8 mt-2">
                        {{$other}}
                    </div>
                </div>
            </div>
        @endforeach
    @endisset

</div>


@endif

