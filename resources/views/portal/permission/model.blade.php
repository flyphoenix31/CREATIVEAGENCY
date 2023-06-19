<!-- Modal starts -->
<form class="form-sample" name="formadd" id="formadd" action="" method="post" autocomplete="on">
	@csrf
	<div class="modal fade" id="openaddmodel" tabindex="-1" role="dialog" aria-labelledby="openaddmodellabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editmodelabel">@lang('lang.add') @lang('lang.permission')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				<div class="modal-body text-capitalize">
					@include('portal.permission.render_new')
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" id="savebtn">@lang('lang.add')</button>
					<button type="button" class="btn btn-dark" data-dismiss="modal">@lang('lang.cancel')</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Modal Ends -->


<!--Edit Modal starts -->
<form class="form-sample" name="formedit" id="formedit" action="" method="post" autocomplete="on">
	<div class="modal fade" id="openeditmodel" tabindex="-1" role="dialog" aria-labelledby="openeditmodel_label" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editmodelabel">@lang('lang.edit') @lang('lang.permission')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				<div class="modal-body text-capitalize" id="renderdata">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" id="savebtn" >@lang('lang.update')</button>
					<button type="button" class="btn btn-dark" data-dismiss="modal">@lang('lang.cancel')</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Modal Ends -->

