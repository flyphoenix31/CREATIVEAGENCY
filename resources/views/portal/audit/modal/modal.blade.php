

<!-- Edit Modal starts -->
<form class="form-sample  text-capitalize" name="formedit" id="formedit" action="" method="post" autocomplete="on" >
	<div class="modal fade" id="formeditmodal" tabindex="-1" role="dialog" aria-labelledby="formeditlabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editmodelabel formtitle">@lang('lang.view'){!! "&nbsp;" !!}@lang('lang.audit'){!! "&nbsp;" !!}@lang('lang.detail')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 	<span aria-hidden="true">&times;</span>
				  	</button>
					@csrf
				</div>
				<div class="modal-body renderdata">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-dismiss="modal">@lang('lang.close')</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Modal Ends -->

