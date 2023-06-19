pem
						<div class="simplebar-mask">
							<div class="simplebar-offset" style="right: 0px; bottom: 0px;">
								<div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
									<div class="simplebar-content" style="padding: 0px;">
										<div class="nk-fmg-aside-wrap">
											<div class="nk-fmg-aside-top">


												<ul class="nk-fmg-menu" style="list-style-type: none;">
													<li class="{{addactiveclass($type,'default')}}">
														<a class="nk-fmg-menu-item" href="{{route('list_files', 'default')}}">
															<i data-feather="home" class="{{addactiveclass($type,'default', 'icon')}} mr-1"></i>
															<span class="nk-fmg-menu-text">Home</span>
														</a>
													</li>
													<li class="{{addactiveclass($type,'starred')}}">
														<a class="nk-fmg-menu-item" href="{{route('list_files', 'starred')}}">
															<i data-feather="star" class="{{addactiveclass($type,'starred', 'icon')}} mr-1"></i>
															<span class="nk-fmg-menu-text">Starred</span>
														</a>
													</li>
													<li class="{{addactiveclass($type,'shared')}}">
														<a class="nk-fmg-menu-item" href="{{route('list_files', 'shared')}}">
															<i data-feather="share-2" class="{{addactiveclass($type,'shared', 'icon')}} mr-1"></i>
															<span class="nk-fmg-menu-text">Shared</span>
														</a>
													</li>
													<li class="{{addactiveclass($type,'trash')}}">
														<a class="nk-fmg-menu-item" href="{{route('list_files', 'trash')}}">
															<i data-feather="trash" class="{{addactiveclass($type,'trash', 'icon')}} mr-1"></i>
															<span class="nk-fmg-menu-text">Recovery</span>
														</a>
													</li>
													{{-- <li>
														<a class="nk-fmg-menu-item" href="{{route('list_files', 'settings')}}">
															<i data-feather="settings" class=" mr-1"></i>
															<span class="nk-fmg-menu-text">Settings</span>
														</a>
													</li> --}}
												</ul>
											</div>
											{{-- <div class="nk-fmg-aside-bottom">
												<div class="nk-fmg-status">
													<h6 class="nk-fmg-status-title">
														<i data-feather="hard-drive"></i>
														<span>Storage</span>
													</h6>
													<div class="progress progress-md bg-light">
														<div class="progress-bar" data-progress="5" style="width: 5%;"></div>
													</div>
													<div class="nk-fmg-status-info">12.47 GB of 50 GB used</div>
													{{-- <div class="nk-fmg-status-action">
														<a href="#" class="link link-primary link-sm">Upgrade Storage</a>
													</div> --} }
												</div>
											</div> --}}
										</div>
									</div>
								</div>
							</div>
						</div>
