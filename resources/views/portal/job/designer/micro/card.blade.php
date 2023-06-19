

@forelse($result as $row)
    <!-- Job Block -->
    <div class="job-block">
        <div class="inner-box">
            <div class="content">

                <h4><a href="{{$row->slugurl}}">{{$row->title}}</a></h4>
                <ul class="job-info">
                    <li><i class="fad fa-stopwatch text-success"></i> deleiver in {{$row->delivery_day}} days</li>
                    <li><i class="fad fa-clock text-danger"></i> {{$row->created_at->diffForHumans()}}</li>
                    <li><i class="fad fa-dollar-sign text-warning"></i> ${{$row->budget}}</li>
                </ul>
                <p>
                    <span class="badge badge-pills outline-badge-primary mr-2">
                        @if($row->job_nature == 1)  @lang('lang.full_time')
                        @elseif($row->job_nature == 2) @lang('lang.part_time')
                        @elseif($row->job_nature == 3) @lang('lang.remote')
                        @endif
                    </span>
                    @if($row->is_urgent == 1)
                        <span class="badge badge-pills outline-badge-danger mr-2"> Urgent </span>
                    @endif

                    @if($row->is_featured == 1)
                        <span class="badge badge-pills outline-badge-success mr-2"> Featured </span>
                    @endif

                {{-- <button class="bookmark-btn"><i class="fal fa-bookmark"></i></button> --}}
            </div>
        </div>
    </div>
    <!-- End Block -->


@empty
<div class="col-lg-12 grid-margin stretch-card ">
    <div class="card ">
        <h3 class="mt-3 mb-3 text-warning font-weight-medium text-center text-capitalize ajaxloadlabel"><i class="fad fa-telescope fa-5x"></i> </h3>

        <h3 class="mt-3 mb-3 text-warning font-weight-medium text-center text-capitalize ajaxloadlabel">@lang('lang.no_record_found') </h3>

    </div>
</div>
@endforelse
