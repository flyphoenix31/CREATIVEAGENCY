



    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>

        @if(!empty($notificationcount))
            <span class="badge badge-success"></span>
        @endif



    </a>
    <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
        <div class="notification-scroll">


            @forelse ($notifications as $row)
                <div class="dropdown-item">
                    <div class="media">

                        <div class="media-body">
                            <div class="data-info">
                                <h6 class="">{{$row->subject}}</h6>
                                <p class="">{{$row->created}}</p>
                            </div>

                            {{-- <div class="icon-status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @empty
                <p>No New Notifications</p>
            @endforelse





        </div>
    </div>

