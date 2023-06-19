
<!-- Upload Files -->

<div class="modal fade" id="uploadFiles" tabindex="-1" role="dialog" aria-labelledby="uploadFiles" aria-hidden="true">
    <form id="uploadfiles" name="uploadfiles" enctype="multipart/form-data">
        @csrf;
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Files</h5>

            </div>
            <div class="modal-body">

                <div class="custom-file-container" data-upload-id="mySecondImage">
                    <label>Upload (Single File) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                    <label class="custom-file-container__custom-file" >
                        <input type="file" class="custom-file-container__custom-file__custom-file-input" id="userfiles" name="userfiles" >
                        <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                    </label>
                    <div class="custom-file-container__image-preview"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">Discard</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</form>
</div>

<!-- End -->


<!-- Rename File -->
<div class="modal fade" id="ModalRename" tabindex="-1" role="dialog" aria-labelledby="ModalRename-la" aria-hidden="true">
    <form id="Formrename" name="Formrename" action="" method="POST" >
        @csrf;
        <input type="hidden" name="fileid" id="fileid" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Name </h5>
                </div>
                <div class="modal-body">

                        <div class="form-group mb-4">
                            <label for="name">Edit Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="Type Name Here.." maxlength="150">
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

