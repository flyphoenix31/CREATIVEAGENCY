@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default' && $page_name != 'previewquotation')

    <!--  BEGIN TOPBAR  -->
    <div class="topbar-nav header navbar" role="banner">
        <nav id="topbar">
            <ul class="navbar-nav theme-brand flex-row  text-center">
                {{-- <li class="nav-item theme-logo">
                    <a href="index.html">
                        <img src="{{asset('public/storage/img/logo2.svg')}}" class="navbar-logo" alt="logo">
                    </a>
                </li> --}}
                <li class="nav-item theme-text">
                    <a href="index.html" class="nav-link">3 Studio</a>
                </li>
            </ul>

            <ul class="list-unstyled menu-categories text-capitalize" id="topAccordion">

                <li class="menu single-menu {{ ($category_name === 'dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </div>
                    </a>
                </li>

                <li class="menu single-menu {{ ($category_name === 'chat') ? 'active' : '' }}">
                    <a href="{{ route('chat') }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="message-circle"></i>
                            <span>Chat</span>
                        </div>
                    </a>
                </li>


                @can('list_own_files')
                <li class="menu single-menu {{ ($category_name == 'files') ? 'active' : '' }}">
                    <a href="{{ route('list_files') }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="file"></i>
                            <span>Files</span>
                        </div>
                    </a>
                </li>
                @endcan

                @can('view_job')

                <li class="menu single-menu {{ ($category_name == 'jobs') ? 'active' : '' }}">
                    <a href="#page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="database"></i>
                            <span>@lang('lang.jobs')</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="page"  data-parent="#topAccordion">
                        <li  class="{{ ($page_name === 'jobCards') ? 'active' : '' }}">
                            <a href="{{route('job_cards')}}"> @lang('lang.jobs') </a>
                        </li>
                        <li  class="{{ ($page_name === 'activeJobs') ? 'active' : '' }}">
                            <a href="{{route('my_active_jobs')}}"> @lang('lang.my_active_jobs')</a>
                        </li>
                        <li  class="{{ ($page_name === 'jobHistory') ? 'active' : '' }}">
                            <a href="{{route('my_job_history')}}"> @lang('lang.my_job_history')</a>
                        </li>
                    </ul>
                </li>

                @endcan

                @can('manage_job')

                <li class="menu single-menu {{ ($category_name == 'jobs') ? 'active' : '' }}">
                    <a href="#page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="database"></i>
                            <span>@lang('lang.jobs')</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="page"  data-parent="#topAccordion">
                        <li  class="{{ ($page_name === 'create_job') ? 'active' : '' }}">
                            <a href="{{route('add_job')}}"> @lang('lang.add') </a>
                        </li>
                        <li  class="{{ ($page_name === 'jobList') ? 'active' : '' }}">
                            <a href="{{route('list_jobs')}}"> @lang('lang.list')</a>
                        </li>
                        <li  class="{{ ($page_name === 'ManageBidRequest') ? 'active' : '' }}">
                            <a href="{{route('manage_work_request')}}"> @lang('lang.manage_work_request')</a>
                        </li>
                    </ul>
                </li>

                @endcan




                @can('view_portfolio')
                <li class="menu single-menu {{ ($category_name == 'portfolio') ? 'active' : '' }}">
                    <a href="{{ route('portfoliolist') }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="command"></i>
                            <span>Portfolio</span>
                        </div>
                    </a>
                </li>
                @endcan

                @can('view_enquiry')
                <li class="menu single-menu {{ ($category_name == 'enquiryList') ? 'active' : '' }}">
                    <a href="{{ route('enquirylist') }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="message-circle"></i>
                            <span>Enquiry</span>
                        </div>
                    </a>
                </li>
                @endcan

                @can('view_contact')
                <li class="menu single-menu {{ ($category_name === 'contactList') ? 'active' : '' }}">
                    <a href="{{ route('contactlist') }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="users"></i>
                            <span>Contacts</span>
                        </div>
                    </a>
                </li>
                @endcan

                @can('view_invoice')
                <li class="menu single-menu {{ ($category_name == 'invoice') ? 'active' : '' }}">
                    <a href="{{ route('invoicelist') }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="file"></i>
                            <span>Invoice</span>
                        </div>
                    </a>
                </li>
                @endcan

                @can('view_quotation')
                <li class="menu single-menu {{ ($category_name === 'quotation') ? 'active' : '' }}">
                    <a href="{{ route('list_quotation') }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="list"></i>
                            <span>Quotation</span>
                        </div>
                    </a>
                </li>
                @endcan

                @can('view_user')
                <li class="menu single-menu {{ ($category_name == 'UserList') ? 'active' : '' }}">
                    <a href="{{ route('user_list') }}" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="users"></i>
                            <span>Users</span>
                        </div>

                    </a>
                </li>
                @endcan

                @hasrole('superadmin')

                <li class="menu single-menu {{ ($category_name == 'reports') ? 'active' : '' }}">
                    <a href="#page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="reports"></i>
                            <span>@lang('lang.reports')</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="page"  data-parent="#topAccordion">
                        <li  class="{{ ($page_name === 'auditReport') ? 'active' : '' }}">
                            <a href="{{route('auditreport')}}"> @lang('lang.audit') </a>
                        </li>
                        <li  class="{{ ($page_name === 'sharedLink') ? 'active' : '' }}">
                            <a href="{{route('sharelinkviewreport')}}"> @lang('lang.sharelink') </a>
                        </li>
                        <li  class="{{ ($page_name === 'mailerrorreport') ? 'active' : '' }}">
                            <a href="{{route('mailerrorreport')}}"> @lang('lang.mail') @lang('lang.error')</a>
                        </li>
                        {{-- <li  class="{{ ($page_name === 'sendmailreport') ? 'active' : '' }}">
                            <a href="{{route('sendmailreport')}}"> @lang('lang.outgoing') @lang('lang.mail') @lang('lang.count')</a>
                        </li> --}}
                    </ul>
                </li>

                <li class="menu single-menu {{ ($category_name == 'settings') ? 'active' : '' }}">
                    <a href="#page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <i data-feather="settings"></i>
                            <span>@lang('lang.settings')</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="page"  data-parent="#topAccordion">
                        <li  class="{{ ($page_name === 'RoleList') ? 'active' : '' }}">
                            <a href="{{route('rolelist')}}"> @lang('lang.roles') </a>
                        </li>
                        <li  class="{{ ($page_name === 'PermissionList') ? 'active' : '' }}">
                            <a href="{{route('permissionlist')}}"> @lang('lang.permission') </a>
                        </li>
                        <li  class="{{ ($page_name === 'SettingList') ? 'active' : '' }}">
                            <a href="{{route('site_settings')}}"> @lang('lang.settings') </a>
                        </li>
                        <li  class="{{ ($page_name === 'mailList') ? 'active' : '' }}">
                            <a href="{{route('mail_settings')}}"> @lang('lang.mail') </a>
                        </li>

                        <li  class="{{ ($page_name === 'countryList') ? 'active' : '' }}">
                            <a href="{{route('country_list')}}"> @lang('lang.manage'){{' '}}@lang('lang.country') </a>
                        </li>

                    </ul>
                </li>

                @endhasrole


            </ul>
        </nav>
    </div>
    <!--  END TOPBAR  -->

@endif
