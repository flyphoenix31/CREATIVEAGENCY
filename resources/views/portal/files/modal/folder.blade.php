<!-- Create Folder -->
<div class="modal fade" id="ModalCreateFolder" tabindex="-1" role="dialog" aria-labelledby="CreateFolderLa" aria-hidden="true">
    <form id="Formcreatefolder" name="Formcreatefolder" enctype="multipart/form-data">
        @csrf;
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Folder</h5>
                </div>
                <div class="modal-body">

                        <div class="form-group mb-4">
                            <label for="foldername">Folder Name</label>
                            <input type="text" class="form-control" id="foldername" name="foldername" placeholder="Your Folder Name" maxlength="50">
                        </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- End -->

<!-- Rename Folder -->
<div class="modal fade" id="ModalFolderRename" tabindex="-1" role="dialog" aria-labelledby="ModalFolderRename-la" aria-hidden="true">
    <form id="Formfolderrename" name="Formfolderrename">
        @csrf;
        <input type="hidden" name="folerid" id="folerid" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Name </h5>
                </div>
                <div class="modal-body">

                        <div class="form-group mb-4">
                            <label for="name">Edit Name</label>
                            <input type="text" class="form-control" id="folder_edit_name" name="folder_new_name" placeholder="Type Name Here.." maxlength="150">
                        </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- End -->
