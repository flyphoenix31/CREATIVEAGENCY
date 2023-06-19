<!-- Modal starts -->
<form class="form-sample  text-capitalize" name="formadd" id="formadd" action="" method="post" autocomplete="on" >
	<div class="modal fade" id="openaddmodel" tabindex="-1" role="dialog" aria-labelledby="openmodellabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editmodelabel formtitle">@lang('lang.add'){!! "&nbsp;" !!}@lang('lang.domain')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 	<span aria-hidden="true">&times;</span>
				  	</button>
					@csrf
				</div>
				<div class="modal-body text-capitalize">
					@include('portal.domain.partial.render_new')
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
