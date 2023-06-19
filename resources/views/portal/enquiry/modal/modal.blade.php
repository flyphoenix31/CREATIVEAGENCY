<!-- Modal starts -->
<form class="form-sample  text-capitalize" name="formsend" id="formsend" action="" method="post" autocomplete="on" >
	<div class="modal fade" id="sendquotation" tabindex="-1" role="dialog" aria-labelledby="openmodellabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editmodelabel formtitle">@lang('lang.send'){!! "&nbsp;" !!}@lang('lang.email')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 	<span aria-hidden="true">&times;</span>
				  	</button>
					@csrf
				</div>
				<div class="modal-body text-capitalize">
					@include('portal.enquiry.partial.sendmail')
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="savebtn">@lang('lang.send')</button>
					<button type="button" class="btn" data-dismiss="modal">@lang('lang.cancel')</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Modal Ends -->



<!-- view Modal starts -->

<div class="modal fade" id="formviewmodal" tabindex="-1" role="dialog" aria-labelledby="formeditlabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title formtitle" id="editmodelabel formtitle">@lang('lang.view'){!! "&nbsp;" !!}@lang('lang.enquiry')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                @csrf
            </div>
            <div class="modal-body renderdata text-capitalize">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">@lang('lang.close')</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ends -->
