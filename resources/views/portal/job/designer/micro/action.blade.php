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

            @if(!empty($result->active_jobuser->user_id))

                @if($result->active_jobuser->user_id == \Auth::id())

                <li class="row mb-2">
                    <div class="col-md-4 col-xs-5">Accepted:</div>
                    <div class="col-md-8 col-xs-7">
                        <span class='badge badge-primary'>{{ $result->active_jobuser->created_at->diffForHumans() }}</span>
                    </div>
                </li>

                @endif

            @endif
            @if(!empty($result->rejected))

            <li class="row mb-2">
                <div class="col-md-4 col-xs-5">Rejcted:</div>
                <div class="col-md-8 col-xs-7">
                    <span class='badge badge-primary'>{{ $result->rejected->created_at->diffForHumans() }}</span>
                </div>
            </li>

            @endif



        </ul>

        @if($result->status_id == 3)
            @if(!$result->active_jobuser)
                @if(empty($result->rejected))
                    <button data-id="{{ encryptid($result->id) }}" id="accept_job" class="btn btn-info mb-2">Accept Job</button>
                    <button data-id="{{ encryptid($result->id) }}" id="reject_job" class="btn btn-warning mb-2">Reject</button>
                @endif
            @endif
        @endif


    </div>
</div>
