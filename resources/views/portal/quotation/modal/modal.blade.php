<!-- Modal starts -->
<form class="form-sample  text-capitalize" name="formadd" id="formadd" action="" method="post" autocomplete="on" >
	<div class="modal fade" id="openaddmodel" tabindex="-1" role="dialog" aria-labelledby="openmodellabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editmodelabel formtitle">@lang('lang.create'){!! "&nbsp;" !!}@lang('lang.quotation')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 	<span aria-hidden="true">&times;</span>
				  	</button>
					@csrf
				</div>
				<div class="modal-body text-capitalize">
					@include('portal.quotation.partial.create')
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="savebtn">@lang('lang.add')</button>
					<button type="button" class="btn" data-dismiss="modal">@lang('lang.cancel')</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Modal Ends -->


<!-- Edit Modal starts -->
<form class="form-sample  text-capitalize" name="formedit" id="formedit" action="" method="post" autocomplete="on" >
	<div class="modal fade" id="formeditmodal" tabindex="-1" role="dialog" aria-labelledby="formeditlabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editmodelabel formtitle">@lang('lang.edit'){!! "&nbsp;" !!}@lang('lang.contact')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 	<span aria-hidden="true">&times;</span>
				  	</button>
					@csrf
				</div>
				<div class="modal-body renderdata">

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="savebtn">@lang('lang.update')</button>
					<button type="button" class="btn" data-dismiss="modal">@lang('lang.cancel')</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Modal Ends -->


<!-- Edit Modal starts -->

	<div class="modal fade" id="formviewmodal" tabindex="-1" role="dialog" aria-labelledby="formeditlabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editmodelabel formtitle">@lang('lang.view'){!! "&nbsp;" !!}@lang('lang.contact')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 	<span aria-hidden="true">&times;</span>
				  	</button>
					@csrf
				</div>
				<div class="modal-body renderdata">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-dismiss="modal">@lang('lang.cancel')</button>
				</div>
			</div>
		</div>
	</div>

<!-- Modal Ends -->

<!-- Status Modal starts -->
<form class="form-sample" name="formchangestatus" id="formchangestatus" action="" method="post" autocomplete="off">
	<div class="modal fade" id="openstatusmodel" tabindex="-1" role="dialog" aria-labelledby="openstatusmodellabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editstatusmodelabel formtitle">@lang('lang.change') {!! "&nbsp;" !!}@lang('lang.status')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 	<span aria-hidden="true">&times;</span>
				  	</button>
					@csrf
				</div>
				<div class="modal-body renderuserstatusdata text-capitalize">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="savebtn" >@lang('lang.update')</button>
					<button type="button" class="btn" data-dismiss="modal">@lang('lang.cancel')</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Modal Ends -->
