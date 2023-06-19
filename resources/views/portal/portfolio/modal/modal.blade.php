


<!-- view Modal starts -->

<div class="modal fade" id="formviewmodal" tabindex="-1" role="dialog" aria-labelledby="formeditlabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title formtitle" id="editmodelabel formtitle">@lang('lang.view'){!! "&nbsp;" !!}@lang('lang.portfolio')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                @csrf
            </div>
            <div class="modal-body renderdata text-capitalize">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('lang.close')</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ends -->
