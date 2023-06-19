
<!-- Share Link -->
<div class="modal fade" id="Modalsharefile" tabindex="-1" role="dialog" aria-labelledby="Modalsharefile-la" aria-hidden="true">
    <form id="FormShareLink" name="FormShareLink" action="POST">
        @csrf;
        <input type="hidden" name="share_file_uuid" id="share_file_uuid" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share Your File / Folder </h5>
                </div>
                <div class="modal-body">

                    <div class="form-group mb-4">
                        <div class="clipboard">
                            <p class="mt-2 text-info"><h4 class=" text-success">Public Link</h4></p>
                            <label for="public_link" class="tet-warning">Anyone who having this link may download your files.</label>
                            <div class="input-group ">
                                <input type="text" class="form-control" id="sharepublic_link" value="" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-primary text-capitalize" type="button" data-clipboard-action="copy" data-clipboard-target="#sharepublic_link"><i class="fad fa-copy"></i> @lang('lang.copy')</button>
                                </div>
                              </div>
                      </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="new_share_emails">Recipients</label>
                        <textarea class="form-control" name="new_share_emails" id="new_share_emails" placeholder="Type Your emails."></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" id="sharediscardMsg" data-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-primary">Send Mail</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- End -->




<!-- Share File / Folder -->
<div class="modal fade" id="ModalEditsharefile" tabindex="-1" role="dialog" aria-labelledby="ModalEditsharefile-la" aria-hidden="true">
    <form id="FormEditShare" name="FormEditShare" action="POST">
        @csrf;
        <input type="hidden" name="edit_share_file_uuid" id="edit_share_file_uuid" value="">
        <input type="hidden" name="edit_share_type" id="edit_share_type" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">VVEdit Share Your File / Folder </h5>
                </div>
                <div class="modal-body">

                    <div class="form-group mb-4">

                        <div class="clipboard">
                            <p class="mt-2 text-info"><h4 class=" text-success">Public Link</h4></p>
                            <label for="public_link" class="tet-warning">Anyone who having this link may download your files.</label>
                            <div class="input-group ">
                                <input type="text" class="form-control" id="edit_public_link" value="" readonly>
                                <div class="input-group-append">
                                  <button class="btn btn-primary text-capitalize" type="button" data-clipboard-action="copy" data-clipboard-target="#edit_public_link"><i class="fad fa-copy"></i> @lang('lang.copy')</button>


                                </div>
                              </div>
                      </div>
                    </div>

                    <div class="form-group mb-4">


                        <div class="n-chk">
                            <label class="new-control new-checkbox new-checkbox-text checkbox-primary">
                              <input type="checkbox" class="new-control-input" name="is_protected" id="edit_is_protected" value="1">
                              <span class="new-control-indicator"></span><span class="new-chk-content">Password Protected</span>
                            </label>
                        </div>

                        <a href="">Change Password</a>

                        <input type="password" class="form-control" id="vv_password" name="password" placeholder="Leave Blank if not Change">
                    </div>

                    <div class="form-group mb-4">


                    </div>

                    <div class="form-group mb-4">
                        <label for="password">Link Expiration</label>
                        <div class="paginating-container pagination-default">

                            <input type="hidden" class="form-control" id="edit_link_exp" name="edit_link_exp" value="">

                            <ul class="pagination" id="et_link_expire">
                                <li data-id="0"><a href="javascript:void(0);"><span>&#8734;</span></a></li>
                                <li data-id="1"><a href="javascript:void(0);">1h</a></li>
                                <li data-id="5"><a href="javascript:void(0);">5h</a></li>
                                <li data-id="12"><a href="javascript:void(0);">12h</a></li>
                                <li data-id="24"><a href="javascript:void(0);">24h</a></li>
                                <li data-id="48"><a href="javascript:void(0);">2d</a></li>
                                <li data-id="120"><a href="javascript:void(0);">5d</a></li>
                                <li data-id="720"><a href="javascript:void(0);">30d</a></li>
                            </ul>
                        </div>

                        <p id="link_note"></p>


                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal">Cancel</button>
                    <button type="button" id="cancelsharing" class="btn btn-danger">Cancel Sharing</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- End -->


<!-- Create Share link File / Folder -->
<div class="modal fade" id="ModalCreatesharefile" tabindex="-1" role="dialog" aria-labelledby="ModalCreatesharefile-la" aria-hidden="true">
    <form id="FormShareFile" name="FormShareFile" action="POST">
        @csrf;
        <input type="hidden" name="create_file_uuid" id="create_file_uuid" value="">
        <input type="hidden" name="share_type" id="share_type" value="">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share Your File / Folder </h5>
                </div>
                <div class="modal-body">

                    <div class="seperator-header">
                        <h4 class="">Link will Auto Generate</h4>
                    </div>

                    <div class="form-group mb-4">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Type Your Password or Leave empty for no password" value="">
                    </div>

                    <div class="form-group mb-4">
                        <label for="password">Link Expiration</label>

                        <input type="hidden" class="form-control" id="link_exp" name="link_exp" value="0">

                        <div class="paginating-container pagination-default">
                            <ul class="pagination" id="link_expire">
                                <li data-id="0" class="active"><a href="javascript:void(0);"><span>&#8734;</span></a></li>
                                <li data-id="1"><a href="javascript:void(0);">1h</a></li>
                                <li data-id="5"><a href="javascript:void(0);">5h</a></li>
                                <li data-id="12"><a href="javascript:void(0);">12h</a></li>
                                <li data-id="24"><a href="javascript:void(0);">24h</a></li>
                                <li data-id="48"><a href="javascript:void(0);">2d</a></li>
                                <li data-id="120"><a href="javascript:void(0);">5d</a></li>
                                <li data-id="720"><a href="javascript:void(0);">30d</a></li>

                            </ul>
                        </div>
                    </div>





                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- End -->
