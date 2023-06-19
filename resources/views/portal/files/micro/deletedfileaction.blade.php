<div class="task-action">
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                <circle cx="12" cy="12" r="1"></circle>
                <circle cx="19" cy="12" r="1"></circle>
                <circle cx="5" cy="12" r="1"></circle>
            </svg>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;" id="cclc">

            <a class="dropdown-item" href="javascript:void(0);" id="callRestoreFunc"
            data-mime="{{$list->mimetype}}"
            data-created="{{$list->created_at}}"
            data-name="{{$list->name}}"
            data-id="{{$list->id}}"
            data-uuid="{{$list->unique_id}}"
            >
            Restore
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="javascript:void(0);" data-id="{{$list->id}}" data-uuid="{{$list->unique_id}}" id="callPerDelFunc">Delete Permanently</a>
        </div>
    </div>
</div>
