
<!-- Create Reply Comment -->
<div class="modal fade" id="ModalreplyComment" tabindex="-1" role="dialog" aria-labelledby="ModalreplyComment-la" aria-hidden="true">
    <form id="FormreplyComment" name="FormreplyComment" action="POST">
        @csrf
        <input type="hidden" name="comment_id" id="comment_id" value="">
        <input type="hidden" name="share_id" value="{{ encryptId($shared->id) }}">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
                </div>
                <div class="modal-body">

                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="form-group col-md-12">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Type Your message here.." style="background-color: black;"></textarea>
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="form-group col-md-12">
                            <input type="checkbox" name="is_private" id="is_private" class="mr-1" value="1">
                            <label for="is_private">Private Comment</label>
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
