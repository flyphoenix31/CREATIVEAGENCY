<div class="row">
<div class="col-xl-8 col-lg-8 col-md-8 col-8 layout-spacing">
    <div class="widget widget-content-area br-4">
        <div class="widget-one">

            <h2 class="text-primary">{{$result->title}}</h2>

            <p class="mb-0 mt-3" style="color: #888ea8;">Date Posted: <span class="font-weight-bold">  {{ $result->updated_at->format('M d Y') }} </span></p>
            <hr>
        </div>



        <div class="widget-one">

            <h2 class="text-dark">Job Details</h2>

            <ul class="list-unstyled">
                <li class="row mb-3">
                    <div class="col-md-4 col-xs-5">Budget:</div>
                    <div class="col-md-8 col-xs-7">
                        <span class="fontfont-weight-bold">${{$result->budget}}</span>
                    </div>
                </li>

                <li class="row mb-3">
                    <div class="col-md-4 col-xs-5">Featured:</div>
                    <div class="col-md-8 col-xs-7">
                        @if($result->is_featured == 1)
                            <span class="badge badge-primary"> Yes </span>
                        @else
                            <span class="badge badge-dark"> No </span>
                        @endif

                    </div>
                </li>

                <li class="row mb-3">
                    <div class="col-md-4 col-xs-5">Daye to Complete:</div>
                    <div class="col-md-8 col-xs-7">
                        <span><span class="badge badge-primary" > {{$result->delivery_day}}  </span></span>
                    </div>
                </li>

                <li class="row mb-3">
                    <div class="col-md-4 col-xs-5">Nature of Job:</div>
                    <div class="col-md-8 col-xs-7">
                        <span>Test Nature</span>
                    </div>
                </li>

                <li class="row mb-3">
                    <div class="col-md-4 col-xs-5">Category:</div>
                    <div class="col-md-8 col-xs-7">
                        @foreach($result->categories as $category)
                            <span class="badge" style="color:#FFF;background: @php randomcolor(); @endphp"> {{ $category->category->name }} </span>
                        @endforeach
                    </div>
                </li>

            </ul>

        </div>
    </div>
</div>






<div id="divJobAction" class="col-lg-4 layout-spacing">
    @include('portal.job.manager.partial.jobaction')
</div>



<div class="col-xl-8 col-lg-8 col-md-8 col-8 layout-spacing">
    <div class="widget widget-content-area br-4">
        <div class="widget-one">
            <h2 class="">Job Description</h2><hr>
        </div>
        <div class="widget-one text-dark">
            {!! $result->full_description !!}
        </div>



    </div>
</div>







</div>




@include('portal.job.manager.script_view')
