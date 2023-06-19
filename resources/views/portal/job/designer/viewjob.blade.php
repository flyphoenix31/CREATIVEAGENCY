@if($result)


<div class="row">
<div class="col-xl-8 col-lg-8 col-md-8 col-8 layout-spacing">
    @include('portal.job.designer.micro.jobdetail')
</div>






<div id="divJobAction" class="col-lg-4 layout-spacing">
    @include('portal.job.designer.micro.action')
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




@include('portal.job.designer.script_view')


@else


@include('portal.inc.error_not_auth')

@endif
