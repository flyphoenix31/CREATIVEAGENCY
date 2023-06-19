<div class="col-xl-3 col-lg-6 col-md-4 col-sm-12 col-12 layout-spacing9" id="foler_uuid_{{$folder->unique_id}}">
    <div class="widget widget-five">

        <div class="widget-heading">

            <a href="{{route('list_folder', $folder->unique_id)}}" class="task-info">

                <div class="w-img">
                    <i class="fad fa-folder text-primary fa-3x"></i>
                </div>

                <div class="w-title ml-2">

                    <h5 id="folname_{{$folder->id}}">{{$folder->name}}</h5>
                    <span>{{ Carbon\Carbon::parse($folder->created_at)->format('d M') }} @if($folder->shared) . <i class="fal fa-link text-success"></i> @endif . @if($folder->items > 0) {{$folder->items}} Items @else Empty @endif </span>

                </div>
            </a>

            <div class="task-action">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;" id="folderaction">

                        @if($folder->shared)
                            <a class="dropdown-item" href="javascript:void(0);" id="callEditShareFunc" data-link="{{route('shared_filesorfolder', $folder->shared->token)}}"
                                data-id="{{$folder->unique_id}}"
                                data-protected="{{$folder->shared->protected}}"
                                data-expire_at="{{$folder->shared->expire_at}}"
                                data-expired="{{$folder->shared->expired}}"

                                >Edit Share</a>
                            <a class="dropdown-item" href="javascript:void(0);" id="callLinkShareFunc" data-link="{{route('shared_filesorfolder', $folder->shared->token)}}"  data-id="{{$folder->unique_id}}">Share Link</a>
                        @else
                            <a class="dropdown-item" href="javascript:void(0);" id="callShareFunc"  data-id="{{$folder->unique_id}}">Share</a>
                        @endif
                        <a class="dropdown-item" href="javascript:void(0);" id="callFolderRenameFunc"
                        data-mime="{{$folder->mimetype}}"
                        data-created="{{$folder->created_at}}"
                        data-name="{{$folder->name}}"
                        data-id="{{$folder->id}}"
                        >
                        Rename
                        </a>
                        <div class="dropdown-divider">

                        </div>
                        <a class="dropdown-item" href="javascript:void(0);" data-id="{{$folder->id}}" id="callFolderDelFunc">Delete</a>
                    </div>
                </div>
            </div>

        </div>



    </div>

</div>
