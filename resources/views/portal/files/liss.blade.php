<input type="hidden" name="uuid" id="uuid" value="{{ $uuid ?? 0 }}">


<div class="nk-content p-0 mt-10" id="sectionfile">
	<div class="nk-content-inner">
		<div class="nk-content-body">
			<div class="nk-fmg">
				<div class="nk-fmg-aside toggle-screen-lg" data-content="files-aside" data-toggle-overlay="true" data-toggle-body="true" data-toggle-screen="lg" data-simplebar="init">
					<div class="simplebar-wrapper" style="margin: 0px;">
						<div class="simplebar-height-auto-observer-wrapper">
							<div class="simplebar-height-auto-observer"></div>
						</div>

                        @include('portal.files.micro.sidebar')

						<div class="simplebar-placeholder" style="width: auto; height: 527px;"></div>
					</div>
					<div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
						<div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
					</div>
					<div class="simplebar-track simplebar-vertical" style="visibility: visible;">
						<div class="simplebar-scrollbar" style="height: 272px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
					</div>
				</div>
				<div class="nk-fmg-body">
					<div class="nk-fmg-body-head d-none d-lg-flex">

                        <div class="row  col-8">

                            <div class="search-input-group-style input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search files, folders" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>



						{{-- <div class="nk-fmg-search">
							<i data-feather="search"></i>
							<input type="text" class="form-control border-transparent form-focus-none " placeholder="Search files, folders">
							</div> --}}
							<div class="nk-fmg-actions">
								<ul class="nk-block-tools g-3">
                                    <li>
										<a href="javascript:void(0)" class="btn btn-info" onClick="return CreateFolder();return false;">
											<i data-feather="folder-plus"></i>
											<span>Create Folder</span>
										</a>
									</li>

									<li>
										<a href="#file-upload" class="btn btn-primary" data-toggle="modal" onClick="return openmodel();return false;">
											<i data-feather="upload-cloud"></i>
											<span>Upload</span>
										</a>
									</li>
								</ul>
							</div>
						</div>

						<div class="nk-fmg-body-content">
							<div class="nk-block-head nk-block-head-sm">
								<div class="nk-block-between position-relative">
									<div class="nk-block-head-content">
                                        @if($parent)
                                            <a href="{{route('list_folder', $parent->unique_id)}}">
                                                <h4 class="nk-block-title text-info-light text-capitalize"><i class="fal fa-angle-left"></i> {{$parent->name}}</h4>
                                            </a>
                                        @endif
										<h3 class="nk-block-title page-title text-capitalize">{{ $record->name ?? 'Home' }}</h3>
									</div>
									<div class="nk-block-head-content">
										<ul class="nk-block-tools g-1">
											<li class="d-lg-none">
												<a href="#" class="btn btn-trigger btn-icon search-toggle toggle-search" data-target="search">
													<i data-feather="search"></i>
												</a>
											</li>
											<li class="d-lg-none">
												<div class="dropdown">
													<a href="#" class="btn btn-trigger btn-icon" data-toggle="dropdown">
														<em class="icon ni ni-plus"></em>
													</a>
													<div class="dropdown-menu dropdown-menu-right">
														<ul class="link-list-opt no-bdr">
															<li>
																<a href="#file-upload" data-toggle="modal">
																	<i data-feather="upload-cloud"></i>
																	<span>Upload File</span>
																</a>
															</li>
															<li>
																<a href="#">
																	<i data-feather="plus"></i>
																	<span>Create File</span>
																</a>
															</li>
															<li>
																<a href="#">
																	<i data-feather="plus"></i>
																	<span>Create Folder</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
											</li>
											<li class="d-lg-none mr-n1">
												<a href="#" class="btn btn-trigger btn-icon toggle" data-target="files-aside">
													<em class="icon ni ni-menu-alt-r"></em>
												</a>
											</li>
										</ul>
									</div>
									<div class="search-wrap px-2 d-lg-none" data-search="search">
										<div class="search-content">
											<a href="#" class="search-back btn btn-icon toggle-search" data-target="search">
												<i data-feather="search"></i>
											</a>
											<input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or message">
												<button class="search-submit btn btn-icon">
													<i data-feather="search"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
								{{-- <div class="nk-fmg-quick-list nk-block">
									<div class="nk-block-head-xs">
										<div class="nk-block-between g-2">
											<div class="nk-block-head-content">
												<h6 class="nk-block-title title">Quick Access</h6>
											</div>
											<div class="nk-block-head-content">
												<a href="#" class="link link-primary toggle-opt active" data-target="quick-access">
													<div class="inactive-text">Show</div>
													<div class="active-text">Hide</div>
												</a>
											</div>
										</div>
									</div>


                                    <!-- Quick Access will be here--->



								</div> --}}



								<div class="nk-fmg-listing nk-block">

									<div class="toggle-expand-content expanded" data-content="recent-files">
										<div class="nk-files nk-files-view-group">
											{{-- <div class="nk-files-head">
												<div class="nk-file-item">
													<div class="nk-file-info">
														<div class="dropdown">
															<div class="tb-head dropdown-toggle dropdown-indicator-caret" data-toggle="dropdown">Latest</div>
															<div class="dropdown-menu dropdown-menu-xs">
																{{-- <ul class="link-list-opt no-bdr">
																	<li>
																		<a class="active" href="#">
																			<span>Last Opened</span>
																		</a>
																	</li>
																	<li>
																		<a href="#">
																			<span>Name</span>
																		</a>
																	</li>
																	<li>
																		<a href="#">
																			<span>Size</span>
																		</a>
																	</li>
																</ul> --} }
															</div>
														</div>
													</div>
												</div>
											</div> --}}


											<div class="nk-files-group">
												<h6 class="title">Folder</h6>
												<div class="nk-files-list" id="divFolderList">
                                                    @include('portal.files.micro.folder_list')
												</div>
											</div>







											<div class="nk-files-group">
												<h6 class="title">Files</h6>
												<div class="nk-files-list" id="divFileList">
                                                    @include('portal.files.micro.filelist')
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>





        @include('portal.files.modal.share')
        @include('portal.files.modal.file')
        @include('portal.files.modal.folder')



@include('portal.files.restore_script')
@include('portal.files.folderscript')
@include('portal.files.sharescript')
@include('portal.files.script')
