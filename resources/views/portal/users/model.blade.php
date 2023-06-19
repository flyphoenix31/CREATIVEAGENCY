<!-- Modal starts -->
<form class="form-sample  text-capitalize" name="formadd" id="formadd" action="" method="post" autocomplete="on" >
	<div class="modal fade" id="openaddmodel" tabindex="-1" role="dialog" aria-labelledby="openmodellabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editmodelabel formtitle">@lang('lang.add') @lang('lang.user')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 	<span aria-hidden="true">&times;</span>
				  	</button>
					@csrf
				</div>
				<div class="modal-body text-capitalize">
					@include('portal.users.render_new')
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
	<div class="modal fade" id="formeditmodel" tabindex="-1" role="dialog" aria-labelledby="formeditlabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editmodelabel formtitle">@lang('lang.edit') @lang('lang.user')</h5>
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

<!-- Status Modal starts -->
<form class="form-sample  text-capitalize" name="formchangestatus" id="formchangestatus" action="" method="post" autocomplete="off">
	<div class="modal fade" id="openstatusmodel" tabindex="-1" role="dialog" aria-labelledby="openstatusmodellabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editstatusmodelabel formtitle">@lang('lang.change') @lang('lang.status')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 	<span aria-hidden="true">&times;</span>
				  	</button>
					@csrf
				</div>
				<div class="modal-body renderuserstatusdata text-capitalize">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" id="savebtn" >@lang('lang.update')</button>
					<button type="button" class="btn " data-dismiss="modal">@lang('lang.cancel')</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Modal Ends -->

<!-- BulkStatus Modal starts -->
<form class="form-sample  text-capitalize" name="formchangebulkstatus" id="formchangebulkstatus" action="" method="post" autocomplete="off">
	<div class="modal fade" id="openbulkstatusmodel" tabindex="-1" role="dialog" aria-labelledby="openbulkstatusmodellabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editstatusmodelabel formtitle">@lang('lang.change') @lang('lang.status')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 	<span aria-hidden="true">&times;</span>
				  	</button>
					@csrf
				</div>
				<div class="modal-body renderbulkuserstatusdata text-capitalize">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group row">
							<label for="role" class="col-sm-3 col-form-label">@lang('lang.status') <span class="text-danger">*</span></label>
							<div class="col-sm-9">
								<input type="hidden" id="usersIds" name="ids" />
 								<select id="status_id" name="status_id" class="form-control custom-select text-capitalize">
									@foreach($statuses as $val)
										<option value="{{$val->id}}">{{trans('lang.' . $val->name )}}</option>
									@endforeach
									</select>
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" id="savebtn" >@lang('lang.update')</button>
					<button type="button" class="btn " data-dismiss="modal">@lang('lang.cancel')</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Modal Ends -->

<!-- BulkRole Modal starts -->
<form class="form-sample  text-capitalize" name="formchangebulkrole" id="formchangebulkrole" action="" method="post" autocomplete="off">
	<div class="modal fade" id="openbulkrolemodel" tabindex="-1" role="dialog" aria-labelledby="openbulkrolemodellabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editstatusmodelabel formtitle">@lang('lang.change') @lang('lang.role')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 	<span aria-hidden="true">&times;</span>
				  	</button>
					@csrf
				</div>
				<div class="modal-body renderbulkuserroledata text-capitalize">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group row">
							<label for="role" class="col-sm-3 col-form-label">@lang('lang.role') <span class="text-danger">*</span></label>
							<div class="col-sm-9">
							<input type="hidden" id="usersRoleIds" name="user_ids" />
 							<select id="role" name="role" class="form-control custom-select text-capitalize">
								<option value="">@lang('lang.default_select') </option>
								@foreach ($roles as $role)
									<option value="{{$role->name}}"> {{ucfirst($role->name)}} </option>
								@endforeach
							</select>
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" id="savebtn" >@lang('lang.update')</button>
					<button type="button" class="btn " data-dismiss="modal">@lang('lang.cancel')</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Modal Ends -->


<!-- password Modal starts -->
<form class="form-sample  text-capitalize" name="formchangepassword" id="formchangepassword" action="" method="post" autocomplete="off">
	<div class="modal fade" id="openpasswordmodel" tabindex="-1" role="dialog" aria-labelledby="openpasswordmodellabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title formtitle" id="editstatusmodelabel formtitle">@lang('lang.change') @lang('lang.password')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 	<span aria-hidden="true">&times;</span>
				  	</button>
					@csrf
				</div>
				<div class="modal-body text-capitalize">
				<input id="id" name="id" class=" form-control" type="hidden" value="">
					<div class="" id="validation-errors"></div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
								<label for="password" class="col-sm-3 col-form-label">@lang('lang.password') <span class="text-danger">*</span></label>
								<div class="col-sm-9">
									<input type="password" required class="form-control" name="password" id="password" value="" maxlength="50">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
								<label for="password_confirmation" class="col-sm-3 col-form-label">@lang('lang.confirm_password')<span class="text-danger">*</span></label>
								<div class="col-sm-9">
									<input type="password" required class="form-control" name="password_confirmation" id="password_confirmation" value="" maxlength="50">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" id="savebtn" >@lang('lang.update')</button>
					<button type="button" class="btn " data-dismiss="modal">@lang('lang.cancel')</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Modal Ends -->




<!-- Profile Image Modal starts -->
<form class="form-sample" name="formprofile" id="formprofile" action="" method="post" autocomplete="on" enctype="multipart/form-data">
	<div class="modal fade" id="openprofilemodel" tabindex="-1" role="dialog" aria-labelledby="openprofilemodellabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editvouchermodelabel">@lang('lang.change') @lang('lang.profile') @lang('lang.picture')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
				</div>
				<div class="modal-body">
					<div class="" id="validation-errors"></div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label for="profile_image" class="col-sm-3 col-form-label">@lang('lang.profile') @lang('lang.picture') <span class="text-danger">*</span></label>
								<div class="col-sm-9">
									<input id="profile_image" name="profile_image" class="form-control" type="file" >
									<a href="javascript:void(0)" data-id = "" class="imga btn btn-icons btn-rounded btn-outline-danger btn-inverse-danger"><i class=" icon-close  "></i></a>


								</div>
							</div>

						</div>

					</div>


				</div>
				<div class="modal-footer">
					<button type="submit" id="savebtn" class="btn btn-success savebtn">@lang('lang.change')</button>
					<button type="button" class="btn " data-dismiss="modal">@lang('lang.cancel')</button>
				</div>
				<input type="hidden" name="hidden_void" id="hidden_void" value="">

			</div>
		</div>
	</div>
</form>
<!-- Modal Ends -->
