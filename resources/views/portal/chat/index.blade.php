


<!-- Start User chat -->
<!-- start chat-leftsidebar -->
<div class="chat-leftsidebar mr-lg-1">
    <div class="tab-content">
        <!-- Start Profile tab-pane -->
        <div class="tab-pane" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
            @include('portal.chat.layouts.tabpane-profile')
        </div>
        <!-- End Profile tab-pane -->

        <!-- Start chats tab-pane -->
        <div class="tab-pane fade show active" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
            @include('portal.chat.layouts.tabpane-chats')
        </div>
        <!-- End chats tab-pane -->

        <!-- Start groups tab-pane -->
        <div class="tab-pane" id="pills-groups" role="tabpanel" aria-labelledby="pills-groups-tab">
            @include('portal.chat.layouts.tabpane-groups')
        </div>
        <!-- End groups tab-pane -->

        <!-- Start contacts tab-pane -->
        <div class="tab-pane" id="pills-contacts" role="tabpanel" aria-labelledby="pills-contacts-tab">
            @include('portal.chat.layouts.tabpane-contacts')
        </div>
        <!-- End contacts tab-pane -->

        <!-- Start settings tab-pane -->
        <div class="tab-pane" id="pills-setting" role="tabpanel" aria-labelledby="pills-setting-tab">
            @include('portal.chat.layouts.tabpane-settings')
        </div>
        <!-- End settings tab-pane -->
    </div>
    <!-- end tab content -->

</div>
<!-- end chat-leftsidebar -->
<div class="user-chat w-100">
    <div class="d-lg-flex">
        <!-- start chat conversation section -->
        <div class="w-100">
            <div id="messages">
            </div>
            <div id="group-messages">
            </div>
        </div>
        <!-- start User profile detail sidebar -->
        <div id="userprofiledetail">
        </div>
        <div id="groupprofiledetail">
        </div>
        <!-- end User profile detail sidebar -->
    </div>
</div>
<!-- End User chat -->

