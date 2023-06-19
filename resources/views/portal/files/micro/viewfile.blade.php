<div class="col-xl-3 col-lg-6 col-md-4 col-sm-12 col-12 layout-spacing9" id="file_uuid_{{$list->unique_id}}">
	<div class="widget widget-five">
		<div class="widget-heading">
			<a href="javascript:void(0)" class="task-info">
				<div class="w-img">
                    {{ getfileicon($list) }}
                </div>
				<div class="w-title ml-2">
					<h5 class="limitchar" id="filename_{{$list->id}}"><span class=""></span> {{ \Str::limit($list->name, 15) }}.{{$list->mimetype}}</h5>
					<span>{{ Carbon\Carbon::parse($list->created_at)->format('d M') }} @if($list->shared) . <i class="fal fa-link text-{{ $list->shared->expired == TRUE ? "warning" : "success" }}"></i> @endif . {{$list->filesize}}</span>
				</div>
			</a>

            @if(empty($list->deleted_at))
                @include('portal.files.micro.fileaction')
            @else
                @include('portal.files.micro.deletedfileaction')
            @endif

		</div>
	</div>
</div>
