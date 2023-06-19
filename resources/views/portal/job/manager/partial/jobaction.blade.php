<div class="statbox widget box box-shadow">
    <div class="widget-header">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h3 class="mt-1 ml-1">Statistics</h3>
            </div>
        </div>
    </div>
    <div class="widget-content widget-content-area">
        <ul class="list-unstyled">

            <li class="row mb-2">
                <div class="col-md-4 col-xs-5">Status:</div>
                <div class="col-md-8 col-xs-7">
                    @if($result->status_id == 1 )
                        <label class='badge badge-success'>Active</label>
                    @elseif($result->status_id == 2 )
                        <label class='badge badge-dark'>Inactive</label>
                    @elseif($result->status_id == 3 )
                        <label class='badge badge-warning'>Closed</label>
                    @elseif($result->status_id == 4 )
                        <label class='badge badge-danger'>Suspended</label>
                    @else
                        <label class='badge badge-dark'>Deleted</label>
                    @endif
                </div>
            </li>

            <li class="row mb-2">
                <div class="col-md-4 col-xs-5">Total Views:</div>
                <div class="col-md-8 col-xs-7">
                    <span>{{$result->view_count ?? 0}}</span>
                </div>
            </li>

            <li class="row mb-2">
                <div class="col-md-4 col-xs-5">Total Bid:</div>
                <div class="col-md-8 col-xs-7">
                    <span class='badge badge-success'>{{ $result->totalbid ?? 0 }}</span>
                </div>
            </li>


            <li class="row mb-2">
                <div class="col-md-4 col-xs-5">Distribution Type:</div>
                <div class="col-md-8 col-xs-7">
                    @if($result->type_id ==1 )
                        <span class='badge badge-primary' id="viewusers">Role::Designer</span>
                    @else
                        <span class='badge badge-info' id="viewusers">Users::Designer</span>
                    @endif
                </div>
            </li>

            <li class="row mb-2">
                <div class="col-md-4 col-xs-5">Accepted By:</div>
                <div class="col-md-8 col-xs-7">
                    {{ $result->active_jobuser->user->name ?? '--' }}
                </div>
            </li>

        </ul>


            @if($result->status_id == 1 || $result->status_id == 2)
                <a href="{{route('edit_job', $result->slug)}}" class="btn btn-info mb-2">Edit</a>
                {{-- <a href="{{route('job_requests', ['slug' => $result->slug])}}" class="btn btn-primary mb-2">View Requests</a> --}}
                <button class="btn btn-warning mb-2" id="closeJob" data-id="{{encryptid($result->id)}}">Close Job Ad</button>
            @endif


    </div>
</div>
