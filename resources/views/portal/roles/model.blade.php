<!-- Modal starts -->
<form class="form-sample" name="roleform" id="roleform" action="" method="post" autocomplete="on">
	<div class="modal fade" id="openaddmodel" tabindex="-1" role="dialog" aria-labelledby="openaddmodellabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editmodelabel">@lang('lang.add') @lang('lang.role')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
				</div>
				<div class="modal-body text-capitalize">
					@include('portal.roles.render_new')


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" id="savebtn" onclick="return updateroles();return false;">@lang('lang.add')</button>
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
					<h5 class="modal-title" id="editmodelabel">@lang('lang.edit') @lang('lang.role')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
				</div>
				<div class="modal-body text-capitalize" id="render_editview">



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



<form class="form-sample" name="formedit" id="formedit" action="" method="post" autocomplete="on">
<div class="modal fade" id="openeditmodel" tabindex="-1" role="dialog" aria-labelledby="openeditmodelLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="openeditmodelLabel">@lang('lang.edit') @lang('lang.role')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><i class="fad fa-times-circle"></i></span>
                </button>
            </div>
            <div class="modal-body" id="render_editview">

            </div>
            <div class="modal-footer">
            	<button type="submit" id="savebtn" class="btn btn-primary">@lang('lang.update')</button>
                <button class="btn btn-dark" data-dismiss="modal"> @lang('lang.discard')</button>
            </div>
        </div>
    </div>
</div>
</form>
