<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
	<!--begin::Menu wrapper-->
	<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
		<!--begin::Menu-->
		<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
			<!--begin:Menu item-->

			<div class="menu-item pt-5">
				<!--begin:Menu content-->
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Apps</span>
				</div>
				<!--end:Menu content-->
			</div>
            
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ (request()->segment(1) == 'dashboard' || request()->segment(1) == 'qb_dashboard' || request()->segment(1) == 'frm_dashboard' || request()->segment(1) == 'medical_exit_interview') ? 'here show' : '' }}">
                <!--begin:Menu link-->
                <span class="menu-link">
                    <span class="svg-icon svg-icon-primary svg-icon-1x mx-2"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Media/Equalizer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"/>
                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"/>
                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"/>
                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                    <span class="menu-title">Dashboards</span>
                    <span class="menu-arrow"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ (request()->segment(1) == 'frm_dashboard') ? 'active' : '' }}" href="{{route('dashboards.frm_dashboard')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">FRM Dashboard</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ (request()->segment(1) == 'qb_dashboard') ? 'active' : '' }}" href="{{ route('dashboards.qb_dashboard') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">QB Dashboard</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ (request()->segment(1) == 'medical_exit_interview') ? 'active' : '' }}" href="{{ route('dashboards.medical_exit_interview') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Medical Exit Dashboard</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
            </div>
            
			<!--end:Menu item-->
			<!--begin:Menu item-->
            @can('read user management')
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ (request()->routeIs('user-management.*')) ? 'here show' : '' }} ">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="svg-icon svg-icon-primary svg-icon-1x mx-2"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Communication/Add-user.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                        <span class="menu-title">User Management</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->routeIs('user-management.users.*') ? 'active' : '' }}" href="{{ route('user-management.users.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Users</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->routeIs('user-management.roles.*') ? 'active' : '' }}" href="{{ route('user-management.roles.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Roles</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->routeIs('user-management.permissions.*') ? 'active' : '' }}" href="{{ route('user-management.permissions.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Permissions</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
            @endcan
            @can('frm')
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ (request()->segment(1) == 'frm-managements' ||  request()->routeIs('frm-export')) ? 'here show' : ''}}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">{!! getIcon('abstract-1', 'fs-2') !!}</span>
                        <span class="menu-title">FRM Tracker</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        @can('create feedback registry')
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ request()->routeIs('frm-managements.create') ? 'active' : '' }}" href="{{ route('frm-managements.create') }}"">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Add Feedback/Complaint</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endcan
                        @can('read feedback registry')
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ request()->routeIs('frm-managements.index') ? 'active' : '' }}" href="{{ route('frm-managements.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">List Feedback/Complaint</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endcan
                        @can('read feedback registry')
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ request()->routeIs('frm-export') ? 'active' : '' }}" href="{{ route('frm-export') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Export Feedback/Complaint</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endcan
                    </div>
                    <!--end:Menu sub-->
                </div>
            @endcan
            @can('quality_bench')
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ (request()->segment(1) == 'quality-benchs' ||  request()->routeIs('qb-export') || request()->routeIs('qbactionpoint-export')) ? 'here show' : ''}} ">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="svg-icon svg-icon-primary svg-icon-1x mx-2"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Weather/Wind.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M3,13 L3,11 L17.5,11 C18.3284271,11 19,10.3284271 19,9.5 L19,9 C19,8.44771525 18.5522847,8 18,8 C17.4477153,8 17,8.44771525 17,9 L17,10 L15,10 L15,9 C15,7.34314575 16.3431458,6 18,6 C19.6568542,6 21,7.34314575 21,9 L21,9.5 C21,11.4329966 19.4329966,13 17.5,13 L3,13 Z" fill="#000000" fill-rule="nonzero"/>
                                <path d="M3,9 L3,7 L9.5,7 C10.3284271,7 11,6.32842712 11,5.5 L11,5 C11,4.44771525 10.5522847,4 10,4 C9.44771525,4 9,4.44771525 9,5 L9,6 L7,6 L7,5 C7,3.34314575 8.34314575,2 10,2 C11.6568542,2 13,3.34314575 13,5 L13,5.5 C13,7.43299662 11.4329966,9 9.5,9 L3,9 Z M3,15 L9.5,15 C11.4329966,15 13,16.5670034 13,18.5 L13,19 C13,20.6568542 11.6568542,22 10,22 C8.34314575,22 7,20.6568542 7,19 L7,18 L9,18 L9,19 C9,19.5522847 9.44771525,20 10,20 C10.5522847,20 11,19.5522847 11,19 L11,18.5 C11,17.6715729 10.3284271,17 9.5,17 L3,17 L3,15 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                        <span class="menu-title">Quality Benchmarks</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        @can('create quality benchmarks')
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ request()->routeIs('quality-benchs.create') ? 'active' : '' }}" href="{{ route('quality-benchs.create') }}"">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Create Quality Benchmarks</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endcan
                        @can('read quality benchmarks')
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ request()->routeIs('quality-benchs.index') ? 'active' : '' }}" href="{{ route('quality-benchs.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">List Quality Benchmarks</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endcan
                        @can('read quality benchmarks')
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ request()->routeIs('qb-export') ? 'active' : '' }}" href="{{ route('qb-export') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Export Quality Benchmarks</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ request()->routeIs('qbactionpoint-export') ? 'active' : '' }}" href="{{ route('qbactionpoint-export') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Export QB Action Points</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        @endcan
                    </div>
                    <!--end:Menu sub-->
                </div>
            @endcan
			<!--end:Menu item-->
		</div>
		<!--end::Menu-->
	</div>
	<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
