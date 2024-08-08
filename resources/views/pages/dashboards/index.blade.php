<x-default-layout>

    @section('title')
    Dashboard
    @endsection

    @section('breadcrumbs')
        
    @endsection
    @can('dashboards')
        {{-- <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <iframe title="sci-dashboard-1" width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=ce4b58b8-c937-4937-8264-aa54771a47ee&autoAuth=true&ctid=37ef3d19-1651-4452-b761-dc2414bf0416" frameborder="0" allowFullScreen="true"></iframe>
        </div>
        <!--end::Row--> --}}
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <!--begin::Content wrapper-->
            <div class="d-flex flex-column flex-column-fluid">
                <!--begin::Toolbar-->
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <!--begin::Toolbar container-->
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <!--begin::Title-->
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Projects Dashboard</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">Dashboards</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                        <!--begin::Actions-->
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <!--begin::Secondary button-->
                            <a href="../../demo1/dist/apps/projects/list.html" class="btn btn-sm fw-bold btn-secondary">My Projects</a>
                            <!--end::Secondary button-->
                            <!--begin::Primary button-->
                            <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">New Project</a>
                            <!--end::Primary button-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Toolbar container-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-10 mb-xl-10">
                            <!--begin::Col-->
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                <!--begin::Card widget 16-->
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-50 mb-5 mb-xl-10" style="background-color: white">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ $projects_count ?? '0' }}</span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span class="text-dark opacity-50 pt-1 fw-semibold fs-7">Total Projects</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex align-items-end pt-0">
                                        <canvas id="myChart" width="400" height="400"></canvas>
                                        
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 16-->
                                <!--begin::Card widget 7-->
                                <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">357</span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Professionals</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-column justify-content-end pe-0">
                                        <!--begin::Title-->
                                        <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">Today’s Heroes</span>
                                        <!--end::Title-->
                                        <!--begin::Users group-->
                                        <div class="symbol-group symbol-hover flex-nowrap">
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" data-bs-original-title="Alan Warden" data-kt-initialized="1">
                                                <span class="symbol-label bg-warning text-inverse-warning fw-bold">A</span>
                                            </div>
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" aria-label="Michael Eberon" data-bs-original-title="Michael Eberon" data-kt-initialized="1">
                                                <img alt="Pic" src="assets/media/avatars/300-11.jpg">
                                            </div>
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" data-bs-original-title="Susan Redwood" data-kt-initialized="1">
                                                <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                                            </div>
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" aria-label="Melody Macy" data-bs-original-title="Melody Macy" data-kt-initialized="1">
                                                <img alt="Pic" src="assets/media/avatars/300-2.jpg">
                                            </div>
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" data-bs-original-title="Perry Matthew" data-kt-initialized="1">
                                                <span class="symbol-label bg-danger text-inverse-danger fw-bold">P</span>
                                            </div>
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" aria-label="Barry Walter" data-bs-original-title="Barry Walter" data-kt-initialized="1">
                                                <img alt="Pic" src="assets/media/avatars/300-12.jpg">
                                            </div>
                                            <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
                                                <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+42</span>
                                            </a>
                                        </div>
                                        <!--end::Users group-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 7-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                <!--begin::Card widget 17-->
                                <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Currency-->
                                                <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">$</span>
                                                <!--end::Currency-->
                                                <!--begin::Amount-->
                                                <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">69,700</span>
                                                <!--end::Amount-->
                                                <!--begin::Badge-->
                                                <span class="badge badge-light-success fs-base">
                                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>2.2%</span>
                                                <!--end::Badge-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Subtitle-->
                                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Projects Earnings in April</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                                        <!--begin::Chart-->
                                        <div class="d-flex flex-center me-5 pt-2">
                                            <div id="kt_card_widget_17_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11"><span></span><canvas height="70" width="70"></canvas></div>
                                        </div>
                                        <!--end::Chart-->
                                        <!--begin::Labels-->
                                        <div class="d-flex flex-column content-justify-center flex-row-fluid">
                                            <!--begin::Label-->
                                            <div class="d-flex fw-semibold align-items-center">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">Leaf CRM</div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-bolder text-gray-700 text-xxl-end">$7,660</div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Label-->
                                            <div class="d-flex fw-semibold align-items-center my-3">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">Mivy App</div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-bolder text-gray-700 text-xxl-end">$2,820</div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Label-->
                                            <div class="d-flex fw-semibold align-items-center">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-3px rounded-2 me-3" style="background-color: #E4E6EF"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">Others</div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-bolder text-gray-700 text-xxl-end">$45,257</div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Labels-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 17-->
                                <!--begin::List widget 25-->
                                <div class="card card-flush h-lg-50">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <h3 class="card-title text-gray-800">Highlights</h3>
                                        <!--end::Title-->
                                        <!--begin::Toolbar-->
                                        <div class="card-toolbar d-none">
                                            <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                            <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4" data-kt-initialized="1">
                                                <!--begin::Display range-->
                                                <div class="text-gray-600 fw-bold">4 Jul 2024 - 2 Aug 2024</div>
                                                <!--end::Display range-->
                                                <i class="ki-duotone ki-calendar-8 fs-1 ms-2 me-0">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                    <span class="path6"></span>
                                                </i>
                                            </div>
                                            <!--end::Daterangepicker-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-5">
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Section-->
                                            <div class="text-gray-700 fw-semibold fs-6 me-2">Avg. Client Rating</div>
                                            <!--end::Section-->
                                            <!--begin::Statistics-->
                                            <div class="d-flex align-items-senter">
                                                <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <!--begin::Number-->
                                                <span class="text-gray-900 fw-bolder fs-6">7.8</span>
                                                <!--end::Number-->
                                                <span class="text-gray-400 fw-bold fs-6">/10</span>
                                            </div>
                                            <!--end::Statistics-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-3"></div>
                                        <!--end::Separator-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Section-->
                                            <div class="text-gray-700 fw-semibold fs-6 me-2">Avg. Quotes</div>
                                            <!--end::Section-->
                                            <!--begin::Statistics-->
                                            <div class="d-flex align-items-senter">
                                                <i class="ki-duotone ki-arrow-down-right fs-2 text-danger me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <!--begin::Number-->
                                                <span class="text-gray-900 fw-bolder fs-6">730</span>
                                                <!--end::Number-->
                                            </div>
                                            <!--end::Statistics-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-3"></div>
                                        <!--end::Separator-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Section-->
                                            <div class="text-gray-700 fw-semibold fs-6 me-2">Avg. Agent Earnings</div>
                                            <!--end::Section-->
                                            <!--begin::Statistics-->
                                            <div class="d-flex align-items-senter">
                                                <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <!--begin::Number-->
                                                <span class="text-gray-900 fw-bolder fs-6">$2,309</span>
                                                <!--end::Number-->
                                            </div>
                                            <!--end::Statistics-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::LIst widget 25-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                                <!--begin::Timeline widget 3-->
                                <div class="card h-md-100">
                                    <!--begin::Header-->
                                    <div class="card-header border-0 pt-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold text-dark">What’s up Today</span>
                                            <span class="text-muted mt-1 fw-semibold fs-7">Total 424,567 deliveries</span>
                                        </h3>
                                        <!--begin::Toolbar-->
                                        <div class="card-toolbar">
                                            <a href="#" class="btn btn-sm btn-light">Report Cecnter</a>
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-7 px-0">
                                        <!--begin::Nav-->
                                        <ul class="nav nav-stretch nav-pills nav-pills-custom nav-pills-active-custom d-flex justify-content-between mb-8 px-5" role="tablist">
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <!--begin::Date-->
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger" data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_1" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="fs-7 fw-semibold">Fr</span>
                                                    <span class="fs-6 fw-bold">20</span>
                                                </a>
                                                <!--end::Date-->
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <!--begin::Date-->
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger" data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_2" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="fs-7 fw-semibold">Sa</span>
                                                    <span class="fs-6 fw-bold">21</span>
                                                </a>
                                                <!--end::Date-->
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <!--begin::Date-->
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger" data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_3" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="fs-7 fw-semibold">Su</span>
                                                    <span class="fs-6 fw-bold">22</span>
                                                </a>
                                                <!--end::Date-->
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <!--begin::Date-->
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger active" data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_4" aria-selected="true" role="tab">
                                                    <span class="fs-7 fw-semibold">Tu</span>
                                                    <span class="fs-6 fw-bold">23</span>
                                                </a>
                                                <!--end::Date-->
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <!--begin::Date-->
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger" data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_5" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="fs-7 fw-semibold">Tu</span>
                                                    <span class="fs-6 fw-bold">24</span>
                                                </a>
                                                <!--end::Date-->
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <!--begin::Date-->
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger" data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_6" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="fs-7 fw-semibold">We</span>
                                                    <span class="fs-6 fw-bold">25</span>
                                                </a>
                                                <!--end::Date-->
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <!--begin::Date-->
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger" data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_7" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="fs-7 fw-semibold">Th</span>
                                                    <span class="fs-6 fw-bold">26</span>
                                                </a>
                                                <!--end::Date-->
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <!--begin::Date-->
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger" data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_8" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="fs-7 fw-semibold">Fri</span>
                                                    <span class="fs-6 fw-bold">27</span>
                                                </a>
                                                <!--end::Date-->
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <!--begin::Date-->
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger" data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_9" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="fs-7 fw-semibold">Sa</span>
                                                    <span class="fs-6 fw-bold">28</span>
                                                </a>
                                                <!--end::Date-->
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <!--begin::Date-->
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger" data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_10" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="fs-7 fw-semibold">Su</span>
                                                    <span class="fs-6 fw-bold">29</span>
                                                </a>
                                                <!--end::Date-->
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <!--begin::Date-->
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger" data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_11" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="fs-7 fw-semibold">Mo</span>
                                                    <span class="fs-6 fw-bold">30</span>
                                                </a>
                                                <!--end::Date-->
                                            </li>
                                            <!--end::Nav item-->
                                        </ul>
                                        <!--end::Nav-->
                                        <!--begin::Tab Content (ishlamayabdi)-->
                                        <div class="tab-content mb-2 px-9">
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_timeline_widget_3_tab_content_1" role="tabpanel">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">10:20 - 11:00
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter Marcus</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">12:00 - 13:40
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Dashboard UI/UX Design Review</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Bob</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">16:30 - 17:00
                                                        <span class="text-gray-400 fw-semibold fs-7">PM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Marketing Campaign Discussion</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark Morris</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_timeline_widget_3_tab_content_2" role="tabpanel">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">16:30 - 17:00
                                                        <span class="text-gray-400 fw-semibold fs-7">PM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Marketing Campaign Discussion</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark Morris</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">12:00 - 13:40
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter Marcus</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">10:20 - 11:00
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter Marcus</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_timeline_widget_3_tab_content_3" role="tabpanel">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">10:20 - 11:00
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter Marcus</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">12:00 - 13:40
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Marketing Campaign Discussion</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Bob</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">16:30 - 17:00
                                                        <span class="text-gray-400 fw-semibold fs-7">PM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Marketing Campaign Discussion</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark Morris</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade show active" id="kt_timeline_widget_3_tab_content_4" role="tabpanel">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">10:20 - 11:00
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter Marcus</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">16:30 - 17:00
                                                        <span class="text-gray-400 fw-semibold fs-7">PM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Dashboard UI/UX Design Review</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Bob</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">12:00 - 13:40
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Marketing Campaign Discussion</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark Morris</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_timeline_widget_3_tab_content_5" role="tabpanel">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">12:00 - 13:40
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Dashboard UI/UX Design Review</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Bob</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">10:20 - 11:00
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark Morris</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">16:30 - 17:00
                                                        <span class="text-gray-400 fw-semibold fs-7">PM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Marketing Campaign Discussion</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter Marcus</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_timeline_widget_3_tab_content_6" role="tabpanel">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">10:20 - 11:00
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Marketing Campaign Discussion</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark Morris</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">16:30 - 17:00
                                                        <span class="text-gray-400 fw-semibold fs-7">PM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter Marcus</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">12:00 - 13:40
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Dashboard UI/UX Design Review</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Bob</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_timeline_widget_3_tab_content_7" role="tabpanel">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">12:00 - 13:40
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Bob</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">10:20 - 11:00
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Dashboard UI/UX Design Review</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter Marcus</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">16:30 - 17:00
                                                        <span class="text-gray-400 fw-semibold fs-7">PM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Marketing Campaign Discussion</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark Morris</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_timeline_widget_3_tab_content_8" role="tabpanel">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">16:30 - 17:00
                                                        <span class="text-gray-400 fw-semibold fs-7">PM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Marketing Campaign Discussion</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter Marcus</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">10:20 - 11:00
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark Morris</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">12:00 - 13:40
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Dashboard UI/UX Design Review</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Bob</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_timeline_widget_3_tab_content_9" role="tabpanel">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">12:00 - 13:40
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Bob</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">16:30 - 17:00
                                                        <span class="text-gray-400 fw-semibold fs-7">PM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Marketing Campaign Discussion</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark Morris</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">10:20 - 11:00
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Dashboard UI/UX Design Review</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter Marcus</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_timeline_widget_3_tab_content_10" role="tabpanel">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">12:00 - 13:40
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Marketing Campaign Discussion</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter Marcus</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">10:20 - 11:00
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Dashboard UI/UX Design Review</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Bob</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">16:30 - 17:00
                                                        <span class="text-gray-400 fw-semibold fs-7">PM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark Morris</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_timeline_widget_3_tab_content_11" role="tabpanel">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">16:30 - 17:00
                                                        <span class="text-gray-400 fw-semibold fs-7">PM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Dashboard UI/UX Design Review</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark Morris</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">10:20 - 11:00
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">Marketing Campaign Discussion</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter Marcus</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center mb-6">
                                                    <!--begin::Bullet-->
                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>
                                                    <!--end::Bullet-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1 me-5">
                                                        <!--begin::Time-->
                                                        <div class="text-gray-800 fw-semibold fs-2">12:00 - 13:40
                                                        <span class="text-gray-400 fw-semibold fs-7">AM</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Description-->
                                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>
                                                        <!--end::Description-->
                                                        <!--begin::Link-->
                                                        <div class="text-gray-400 fw-semibold fs-7">Lead by
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Bob</a>
                                                        <!--end::Name--></div>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Tap pane-->
                                        </div>
                                        <!--end::Tab Content-->
                                        <!--begin::Action-->
                                        <div class="float-end d-none">
                                            <a href="#" class="btn btn-sm btn-light me-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">Add Lesson</a>
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Call Sick for Today</a>
                                        </div>
                                        <!--end::Action-->
                                    </div>
                                    <!--end: Card Body-->
                                </div>
                                <!--end::Timeline widget 3-->
                                <!--begin::Timeline widget 3-->
                                <div class="card card-flush d-none h-md-100">
                                    <!--begin::Card header-->
                                    <div class="card-header mt-6">
                                        <!--begin::Card title-->
                                        <div class="card-title flex-column">
                                            <h3 class="fw-bold mb-1">What's on the road?</h3>
                                            <div class="fs-6 text-gray-400">Total 482 participants</div>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <!--begin::Select-->
                                            <select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-solid form-select-sm fw-bold w-100px select2-hidden-accessible" data-select2-id="select2-data-7-1zv7" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                <option value="1" selected="selected" data-select2-id="select2-data-9-0yph">Options</option>
                                                <option value="2">Option 1</option>
                                                <option value="3">Option 2</option>
                                                <option value="4">Option 3</option>
                                            </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-8-c2ki" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm fw-bold w-100px" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-status-nq-container" aria-controls="select2-status-nq-container"><span class="select2-selection__rendered" id="select2-status-nq-container" role="textbox" aria-readonly="true" title="Options">Options</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body p-0">
                                        <!--begin::Dates-->
                                        <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2 ms-4" role="tablist">
                                            <!--begin::Date-->
                                            <li class="nav-item me-1" role="presentation">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_0" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="text-gray-400 fs-7 fw-semibold">Fr</span>
                                                    <span class="fs-6 text-gray-800 fw-bold">20</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1" role="presentation">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_1" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="text-gray-400 fs-7 fw-semibold">Sa</span>
                                                    <span class="fs-6 text-gray-800 fw-bold">21</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1" role="presentation">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_2" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="text-gray-400 fs-7 fw-semibold">Su</span>
                                                    <span class="fs-6 text-gray-800 fw-bold">22</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1" role="presentation">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger active" data-bs-toggle="tab" href="#kt_schedule_day_3" aria-selected="true" role="tab">
                                                    <span class="text-gray-400 fs-7 fw-semibold">Mo</span>
                                                    <span class="fs-6 text-gray-800 fw-bold">23</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1" role="presentation">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_4" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="text-gray-400 fs-7 fw-semibold">Tu</span>
                                                    <span class="fs-6 text-gray-800 fw-bold">24</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1" role="presentation">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_5" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="text-gray-400 fs-7 fw-semibold">We</span>
                                                    <span class="fs-6 text-gray-800 fw-bold">25</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1" role="presentation">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_6" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="text-gray-400 fs-7 fw-semibold">Th</span>
                                                    <span class="fs-6 text-gray-800 fw-bold">26</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1" role="presentation">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_7" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="text-gray-400 fs-7 fw-semibold">Fr</span>
                                                    <span class="fs-6 text-gray-800 fw-bold">27</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1" role="presentation">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_8" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="text-gray-400 fs-7 fw-semibold">Sa</span>
                                                    <span class="fs-6 text-gray-800 fw-bold">28</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1" role="presentation">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_9" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="text-gray-400 fs-7 fw-semibold">Su</span>
                                                    <span class="fs-6 text-gray-800 fw-bold">29</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1" role="presentation">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_10" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="text-gray-400 fs-7 fw-semibold">Mo</span>
                                                    <span class="fs-6 text-gray-800 fw-bold">30</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                            <!--begin::Date-->
                                            <li class="nav-item me-1" role="presentation">
                                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_11" aria-selected="false" tabindex="-1" role="tab">
                                                    <span class="text-gray-400 fs-7 fw-semibold">Tu</span>
                                                    <span class="fs-6 text-gray-800 fw-bold">31</span>
                                                </a>
                                            </li>
                                            <!--end::Date-->
                                        </ul>
                                        <!--end::Dates-->
                                        <!--begin::Tab Content-->
                                        <div class="tab-content px-9">
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_0" class="tab-pane fade show" role="tabpanel">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">10:00 - 11:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Kendell Trevor</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">11:00 - 11:45
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Walter White</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Bob Harris</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_1" class="tab-pane fade show active" role="tabpanel">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">11:00 - 11:45
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Sales Pitch Proposal</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Terry Robins</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">9:00 - 10:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Caleb Donaldson</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">16:30 - 17:30
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Naomi Hayabusa</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_2" class="tab-pane fade show" role="tabpanel">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">16:30 - 17:30
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Bob Harris</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">10:00 - 11:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Kendell Trevor</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">9:00 - 10:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Kendell Trevor</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_3" class="tab-pane fade show" role="tabpanel">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">10:00 - 11:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Karina Clarke</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Peter Marcus</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">16:30 - 17:30
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Peter Marcus</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_4" class="tab-pane fade show" role="tabpanel">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Sean Bean</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Naomi Hayabusa</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">14:30 - 15:30
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Mark Randall</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_5" class="tab-pane fade show" role="tabpanel">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">11:00 - 11:45
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">David Stevenson</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Project Review &amp; Testing</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Sean Bean</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">12:00 - 13:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Mark Randall</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_6" class="tab-pane fade show" role="tabpanel">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Karina Clarke</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">14:30 - 15:30
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Michael Walters</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">10:00 - 11:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Kendell Trevor</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_7" class="tab-pane fade show" role="tabpanel">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">12:00 - 13:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Walter White</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">12:00 - 13:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Naomi Hayabusa</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">10:00 - 11:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Sales Pitch Proposal</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Kendell Trevor</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_8" class="tab-pane fade show" role="tabpanel">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">11:00 - 11:45
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Karina Clarke</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Caleb Donaldson</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">9:00 - 10:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Walter White</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_9" class="tab-pane fade show" role="tabpanel">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">12:00 - 13:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Sean Bean</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">10:00 - 11:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Peter Marcus</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Bob Harris</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_10" class="tab-pane fade show" role="tabpanel">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">10:00 - 11:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Terry Robins</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">11:00 - 11:45
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Caleb Donaldson</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">9:00 - 10:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">David Stevenson</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                            <!--begin::Day-->
                                            <div id="kt_schedule_day_11" class="tab-pane fade show" role="tabpanel">
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">14:30 - 15:30
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Terry Robins</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">13:00 - 14:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Terry Robins</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                                <!--begin::Time-->
                                                <div class="d-flex flex-stack position-relative mt-8">
                                                    <!--begin::Bar-->
                                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                                    <!--end::Bar-->
                                                    <!--begin::Info-->
                                                    <div class="fw-semibold ms-5 text-gray-600">
                                                        <!--begin::Time-->
                                                        <div class="fs-5">10:00 - 11:00
                                                        <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                                        <!--end::Time-->
                                                        <!--begin::Title-->
                                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                                        <!--end::Title-->
                                                        <!--begin::User-->
                                                        <div class="text-gray-400">Lead by
                                                        <a href="#">Terry Robins</a></div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Action-->
                                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                    <!--end::Action-->
                                                </div>
                                                <!--end::Time-->
                                            </div>
                                            <!--end::Day-->
                                        </div>
                                        <!--end::Tab Content-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Timeline widget-3-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                            <!--begin::Col-->
                            <div class="col-xxl-6">
                                <!--begin::Card widget 18-->
                                <div class="card card-flush h-md-100">
                                    <!--begin::Body-->
                                    <div class="card-body py-9">
                                        <!--begin::Row-->
                                        <div class="row gx-9 h-100">
                                            <!--begin::Col-->
                                            <div class="col-sm-6 mb-10 mb-sm-0">
                                                <!--begin::Image-->
                                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-400px min-h-sm-100 h-100" style="background-size: 100% 100%;background-image:url('assets/media/stock/600x600/img-33.jpg')"></div>
                                                <!--end::Image-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-sm-6">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-column h-100">
                                                    <!--begin::Header-->
                                                    <div class="mb-7">
                                                        <!--begin::Headin-->
                                                        <div class="d-flex flex-stack mb-6">
                                                            <!--begin::Title-->
                                                            <div class="flex-shrink-0 me-5">
                                                                <span class="text-gray-400 fs-7 fw-bold me-2 d-block lh-1 pb-1">Featured</span>
                                                                <span class="text-gray-800 fs-1 fw-bold">9 Degree</span>
                                                            </div>
                                                            <!--end::Title-->
                                                            <span class="badge badge-light-primary flex-shrink-0 align-self-center py-3 px-4 fs-7">In Process</span>
                                                        </div>
                                                        <!--end::Heading-->
                                                        <!--begin::Items-->
                                                        <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                                            <!--begin::Item-->
                                                            <div class="d-flex align-items-center me-5 me-xl-13">
                                                                <!--begin::Symbol-->
                                                                <div class="symbol symbol-30px symbol-circle me-3">
                                                                    <img src="assets/media/avatars/300-3.jpg" class="" alt="">
                                                                </div>
                                                                <!--end::Symbol-->
                                                                <!--begin::Info-->
                                                                <div class="m-0">
                                                                    <span class="fw-semibold text-gray-400 d-block fs-8">Manager</span>
                                                                    <a href="../../demo1/dist/pages/user-profile/overview.html" class="fw-bold text-gray-800 text-hover-primary fs-7">Robert Fox</a>
                                                                </div>
                                                                <!--end::Info-->
                                                            </div>
                                                            <!--end::Item-->
                                                            <!--begin::Item-->
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Symbol-->
                                                                <div class="symbol symbol-30px symbol-circle me-3">
                                                                    <span class="symbol-label bg-success">
                                                                        <i class="ki-duotone ki-abstract-41 fs-5 text-white">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                        </i>
                                                                    </span>
                                                                </div>
                                                                <!--end::Symbol-->
                                                                <!--begin::Info-->
                                                                <div class="m-0">
                                                                    <span class="fw-semibold text-gray-400 d-block fs-8">Budget</span>
                                                                    <span class="fw-bold text-gray-800 fs-7">$64.800</span>
                                                                </div>
                                                                <!--end::Info-->
                                                            </div>
                                                            <!--end::Item-->
                                                        </div>
                                                        <!--end::Items-->
                                                    </div>
                                                    <!--end::Header-->
                                                    <!--begin::Body-->
                                                    <div class="mb-6">
                                                        <!--begin::Text-->
                                                        <span class="fw-semibold text-gray-600 fs-6 mb-8 d-block">Flat cartoony illustrations with vivid unblended colors and asymmetrical beautiful purple hair lady</span>
                                                        <!--end::Text-->
                                                        <!--begin::Stats-->
                                                        <div class="d-flex">
                                                            <!--begin::Stat-->
                                                            <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                                                                <!--begin::Date-->
                                                                <span class="fs-6 text-gray-700 fw-bold">Feb 6, 2021</span>
                                                                <!--end::Date-->
                                                                <!--begin::Label-->
                                                                <div class="fw-semibold text-gray-400">Due Date</div>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Stat-->
                                                            <!--begin::Stat-->
                                                            <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 mb-3">
                                                                <!--begin::Number-->
                                                                <span class="fs-6 text-gray-700 fw-bold">$
                                                                <span class="ms-n1 counted" data-kt-countup="true" data-kt-countup-value="284,900.00" data-kt-initialized="1">284,900</span></span>
                                                                <!--end::Number-->
                                                                <!--begin::Label-->
                                                                <div class="fw-semibold text-gray-400">Budget</div>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Stat-->
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Body-->
                                                    <!--begin::Footer-->
                                                    <div class="d-flex flex-stack mt-auto bd-highlight">
                                                        <!--begin::Users group-->
                                                        <div class="symbol-group symbol-hover flex-nowrap">
                                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" aria-label="Melody Macy" data-bs-original-title="Melody Macy" data-kt-initialized="1">
                                                                <img alt="Pic" src="assets/media/avatars/300-2.jpg">
                                                            </div>
                                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" aria-label="Michael Eberon" data-bs-original-title="Michael Eberon" data-kt-initialized="1">
                                                                <img alt="Pic" src="assets/media/avatars/300-3.jpg">
                                                            </div>
                                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" data-bs-original-title="Susan Redwood" data-kt-initialized="1">
                                                                <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                                                            </div>
                                                        </div>
                                                        <!--end::Users group-->
                                                        <!--begin::Actions-->
                                                        <a href="../../demo1/dist/apps/projects/project.html" class="d-flex align-items-center text-primary opacity-75-hover fs-6 fw-semibold">View Project
                                                        <i class="ki-duotone ki-exit-right-corner fs-4 ms-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i></a>
                                                        <!--end::Actions-->
                                                    </div>
                                                    <!--end::Footer-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Card widget 18-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xxl-6">
                                <!--begin::Engage widget 8-->
                                <div class="card border-0 h-md-100" data-bs-theme="light" style="background: linear-gradient(112.14deg, #00D2FF 0%, #3A7BD5 100%)">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <!--begin::Row-->
                                        <div class="row align-items-center h-100">
                                            <!--begin::Col-->
                                            <div class="col-7 ps-xl-13">
                                                <!--begin::Title-->
                                                <div class="text-white mb-6 pt-6">
                                                    <span class="fs-4 fw-semibold me-2 d-block lh-1 pb-2 opacity-75">Get best offer</span>
                                                    <span class="fs-2qx fw-bold">Upgrade Your Plan</span>
                                                </div>
                                                <!--end::Title-->
                                                <!--begin::Text-->
                                                <span class="fw-semibold text-white fs-6 mb-8 d-block opacity-75">Flat cartoony and illustrations with vivid unblended purple hair lady</span>
                                                <!--end::Text-->
                                                <!--begin::Items-->
                                                <div class="d-flex align-items-center flex-wrap d-grid gap-2 mb-10 mb-xl-20">
                                                    <!--begin::Item-->
                                                    <div class="d-flex align-items-center me-5 me-xl-13">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-30px symbol-circle me-3">
                                                            <span class="symbol-label" style="background: #35C7FF">
                                                                <i class="ki-duotone ki-abstract-41 fs-5 text-white">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        <!--begin::Info-->
                                                        <div class="text-white">
                                                            <span class="fw-semibold d-block fs-8 opacity-75">Projects</span>
                                                            <span class="fw-bold fs-7">Up to 500</span>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-30px symbol-circle me-3">
                                                            <span class="symbol-label" style="background: #35C7FF">
                                                                <i class="ki-duotone ki-abstract-26 fs-5 text-white">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        <!--begin::Info-->
                                                        <div class="text-white">
                                                            <span class="fw-semibold opacity-75 d-block fs-8">Tasks</span>
                                                            <span class="fw-bold fs-7">Unlimited</span>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                    <!--end::Item-->
                                                </div>
                                                <!--end::Items-->
                                                <!--begin::Action-->
                                                <div class="d-flex flex-column flex-sm-row d-grid gap-2">
                                                    <a href="#" class="btn btn-success flex-shrink-0 me-lg-2" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Upgrade Plan</a>
                                                    <a href="#" class="btn btn-primary flex-shrink-0" style="background: rgba(255, 255, 255, 0.2)" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Read Guides</a>
                                                </div>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-5 pt-10">
                                                <!--begin::Illustration-->
                                                <div class="bgi-no-repeat bgi-size-contain bgi-position-x-end h-225px" style="background-image:url('assets/media/svg/illustrations/easy/5.svg"></div>
                                                <!--end::Illustration-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Engage widget 8-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                            <!--begin::Col-->
                            <div class="col-xl-4">
                                <!--begin::Chart Widget 35-->
                                <div class="card card-flush h-md-100">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5 mb-6">
                                        <!--begin::Title-->
                                        <h3 class="card-title align-items-start flex-column">
                                            <!--begin::Statistics-->
                                            <div class="d-flex align-items-center mb-2">
                                                <!--begin::Currency-->
                                                <span class="fs-3 fw-semibold text-gray-400 align-self-start me-1">$</span>
                                                <!--end::Currency-->
                                                <!--begin::Value-->
                                                <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">3,274.94</span>
                                                <!--end::Value-->
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>9.2%</span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Statistics-->
                                            <!--begin::Description-->
                                            <span class="fs-6 fw-semibold text-gray-400">Avg. Agent Earnings</span>
                                            <!--end::Description-->
                                        </h3>
                                        <!--end::Title-->
                                        <!--begin::Toolbar-->
                                        <div class="card-toolbar">
                                            <!--begin::Menu-->
                                            <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                <i class="ki-duotone ki-dots-square fs-1 text-gray-400 me-n1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </button>
                                            <!--begin::Menu 2-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator mb-3 opacity-75"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">New Ticket</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">New Customer</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                                    <!--begin::Menu item-->
                                                    <a href="#" class="menu-link px-3">
                                                        <span class="menu-title">New Group</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu sub-->
                                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">Admin Group</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">Staff Group</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">Member Group</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu sub-->
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">New Contact</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator mt-3 opacity-75"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content px-3 py-3">
                                                        <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                                    </div>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu 2-->
                                            <!--end::Menu-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-0 px-0">
                                        <!--begin::Nav-->
                                        <ul class="nav d-flex justify-content-between mb-3 mx-9" role="tablist">
                                            <!--begin::Item-->
                                            <li class="nav-item mb-3" role="presentation">
                                                <!--begin::Link-->
                                                <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px active" data-bs-toggle="tab" id="kt_charts_widget_35_tab_1" href="#kt_charts_widget_35_tab_content_1" aria-selected="true" role="tab">1d</a>
                                                <!--end::Link-->
                                            </li>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <li class="nav-item mb-3" role="presentation">
                                                <!--begin::Link-->
                                                <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px" data-bs-toggle="tab" id="kt_charts_widget_35_tab_2" href="#kt_charts_widget_35_tab_content_2" aria-selected="false" tabindex="-1" role="tab">5d</a>
                                                <!--end::Link-->
                                            </li>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <li class="nav-item mb-3" role="presentation">
                                                <!--begin::Link-->
                                                <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px" data-bs-toggle="tab" id="kt_charts_widget_35_tab_3" href="#kt_charts_widget_35_tab_content_3" aria-selected="false" tabindex="-1" role="tab">1m</a>
                                                <!--end::Link-->
                                            </li>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <li class="nav-item mb-3" role="presentation">
                                                <!--begin::Link-->
                                                <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px" data-bs-toggle="tab" id="kt_charts_widget_35_tab_4" href="#kt_charts_widget_35_tab_content_4" aria-selected="false" tabindex="-1" role="tab">6m</a>
                                                <!--end::Link-->
                                            </li>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <li class="nav-item mb-3" role="presentation">
                                                <!--begin::Link-->
                                                <a class="nav-link btn btn-flex flex-center btn-active-danger btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px" data-bs-toggle="tab" id="kt_charts_widget_35_tab_5" href="#kt_charts_widget_35_tab_content_5" aria-selected="false" tabindex="-1" role="tab">1y</a>
                                                <!--end::Link-->
                                            </li>
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Nav-->
                                        <!--begin::Tab Content-->
                                        <div class="tab-content mt-n6">
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade active show" id="kt_charts_widget_35_tab_content_1" role="tabpanel" aria-labelledby="kt_charts_widget_35_tab_1">
                                                <!--begin::Chart-->
                                                <div id="kt_charts_widget_35_chart_1" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6" style="min-height: 215px;"><div id="apexcharts5jisz7cc" class="apexcharts-canvas apexcharts5jisz7cc apexcharts-theme-light" style="width: 366.75px; height: 200px;"><svg id="SvgjsSvg2908" width="366.75" height="200" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="366.75" height="200"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 100px;"></div></foreignObject><rect id="SvgjsRect2935" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG2956" class="apexcharts-yaxis" rel="0" transform="translate(-8, 0)"><g id="SvgjsG2957" class="apexcharts-yaxis-texts-g"></g></g><g id="SvgjsG2910" class="apexcharts-inner apexcharts-graphical" transform="translate(22, 30)"><defs id="SvgjsDefs2909"><clipPath id="gridRectMask5jisz7cc"><rect id="SvgjsRect2912" width="341.75" height="158" x="-3.5" y="-1.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask5jisz7cc"></clipPath><clipPath id="nonForecastMask5jisz7cc"></clipPath><clipPath id="gridRectMarkerMask5jisz7cc"><rect id="SvgjsRect2913" width="338.75" height="159" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient2918" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop2919" stop-opacity="0.4" stop-color="rgba(62,151,255,0.4)" offset="0.15"></stop><stop id="SvgjsStop2920" stop-opacity="0.2" stop-color="rgba(255,255,255,0.2)" offset="1.2"></stop><stop id="SvgjsStop2921" stop-opacity="0.2" stop-color="rgba(255,255,255,0.2)" offset="1"></stop></linearGradient></defs><g id="SvgjsG2924" class="apexcharts-grid"><g id="SvgjsG2925" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine2929" x1="0" y1="38.75" x2="334.75" y2="38.75" stroke="#dbdfe9" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2930" x1="0" y1="77.5" x2="334.75" y2="77.5" stroke="#dbdfe9" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2931" x1="0" y1="116.25" x2="334.75" y2="116.25" stroke="#dbdfe9" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG2926" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine2934" x1="0" y1="155" x2="334.75" y2="155" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine2933" x1="0" y1="1" x2="0" y2="155" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG2914" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG2915" class="apexcharts-series" seriesName="Earnings" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath2922" d="M 0 155 L 0 98.16666666666666C 8.368749999999999 98.16666666666666 15.541964285714286 46.5 23.910714285714285 46.5C 32.27946428571428 46.5 39.45267857142857 46.5 47.82142857142857 46.5C 56.190178571428575 46.5 63.363392857142856 82.66666666666666 71.73214285714286 82.66666666666666C 80.10089285714285 82.66666666666666 87.27410714285715 82.66666666666666 95.64285714285714 82.66666666666666C 104.01160714285714 82.66666666666666 111.18482142857142 113.66666666666666 119.55357142857143 113.66666666666666C 127.92232142857144 113.66666666666666 135.09553571428572 113.66666666666666 143.46428571428572 113.66666666666666C 151.83303571428573 113.66666666666666 159.00625 82.66666666666666 167.375 82.66666666666666C 175.74375 82.66666666666666 182.91696428571427 82.66666666666666 191.28571428571428 82.66666666666666C 199.65446428571428 82.66666666666666 206.82767857142855 41.33333333333334 215.19642857142856 41.33333333333334C 223.56517857142856 41.33333333333334 230.73839285714286 41.33333333333334 239.10714285714286 41.33333333333334C 247.47589285714284 41.33333333333334 254.64910714285713 62 263.0178571428571 62C 271.38660714285714 62 278.5598214285714 62 286.92857142857144 62C 295.2973214285714 62 302.47053571428575 38.75 310.8392857142857 38.75C 319.2080357142857 38.75 326.38125 38.75 334.75 38.75C 334.75 38.75 334.75 38.75 334.75 155M 334.75 38.75z" fill="url(#SvgjsLinearGradient2918)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask5jisz7cc)" pathTo="M 0 155 L 0 98.16666666666666C 8.368749999999999 98.16666666666666 15.541964285714286 46.5 23.910714285714285 46.5C 32.27946428571428 46.5 39.45267857142857 46.5 47.82142857142857 46.5C 56.190178571428575 46.5 63.363392857142856 82.66666666666666 71.73214285714286 82.66666666666666C 80.10089285714285 82.66666666666666 87.27410714285715 82.66666666666666 95.64285714285714 82.66666666666666C 104.01160714285714 82.66666666666666 111.18482142857142 113.66666666666666 119.55357142857143 113.66666666666666C 127.92232142857144 113.66666666666666 135.09553571428572 113.66666666666666 143.46428571428572 113.66666666666666C 151.83303571428573 113.66666666666666 159.00625 82.66666666666666 167.375 82.66666666666666C 175.74375 82.66666666666666 182.91696428571427 82.66666666666666 191.28571428571428 82.66666666666666C 199.65446428571428 82.66666666666666 206.82767857142855 41.33333333333334 215.19642857142856 41.33333333333334C 223.56517857142856 41.33333333333334 230.73839285714286 41.33333333333334 239.10714285714286 41.33333333333334C 247.47589285714284 41.33333333333334 254.64910714285713 62 263.0178571428571 62C 271.38660714285714 62 278.5598214285714 62 286.92857142857144 62C 295.2973214285714 62 302.47053571428575 38.75 310.8392857142857 38.75C 319.2080357142857 38.75 326.38125 38.75 334.75 38.75C 334.75 38.75 334.75 38.75 334.75 155M 334.75 38.75z" pathFrom="M -1 206.66666666666666 L -1 206.66666666666666 L 23.910714285714285 206.66666666666666 L 47.82142857142857 206.66666666666666 L 71.73214285714286 206.66666666666666 L 95.64285714285714 206.66666666666666 L 119.55357142857143 206.66666666666666 L 143.46428571428572 206.66666666666666 L 167.375 206.66666666666666 L 191.28571428571428 206.66666666666666 L 215.19642857142856 206.66666666666666 L 239.10714285714286 206.66666666666666 L 263.0178571428571 206.66666666666666 L 286.92857142857144 206.66666666666666 L 310.8392857142857 206.66666666666666 L 334.75 206.66666666666666"></path><path id="SvgjsPath2923" d="M 0 98.16666666666666C 8.368749999999999 98.16666666666666 15.541964285714286 46.5 23.910714285714285 46.5C 32.27946428571428 46.5 39.45267857142857 46.5 47.82142857142857 46.5C 56.190178571428575 46.5 63.363392857142856 82.66666666666666 71.73214285714286 82.66666666666666C 80.10089285714285 82.66666666666666 87.27410714285715 82.66666666666666 95.64285714285714 82.66666666666666C 104.01160714285714 82.66666666666666 111.18482142857142 113.66666666666666 119.55357142857143 113.66666666666666C 127.92232142857144 113.66666666666666 135.09553571428572 113.66666666666666 143.46428571428572 113.66666666666666C 151.83303571428573 113.66666666666666 159.00625 82.66666666666666 167.375 82.66666666666666C 175.74375 82.66666666666666 182.91696428571427 82.66666666666666 191.28571428571428 82.66666666666666C 199.65446428571428 82.66666666666666 206.82767857142855 41.33333333333334 215.19642857142856 41.33333333333334C 223.56517857142856 41.33333333333334 230.73839285714286 41.33333333333334 239.10714285714286 41.33333333333334C 247.47589285714284 41.33333333333334 254.64910714285713 62 263.0178571428571 62C 271.38660714285714 62 278.5598214285714 62 286.92857142857144 62C 295.2973214285714 62 302.47053571428575 38.75 310.8392857142857 38.75C 319.2080357142857 38.75 326.38125 38.75 334.75 38.75" fill="none" fill-opacity="1" stroke="#3e97ff" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask5jisz7cc)" pathTo="M 0 98.16666666666666C 8.368749999999999 98.16666666666666 15.541964285714286 46.5 23.910714285714285 46.5C 32.27946428571428 46.5 39.45267857142857 46.5 47.82142857142857 46.5C 56.190178571428575 46.5 63.363392857142856 82.66666666666666 71.73214285714286 82.66666666666666C 80.10089285714285 82.66666666666666 87.27410714285715 82.66666666666666 95.64285714285714 82.66666666666666C 104.01160714285714 82.66666666666666 111.18482142857142 113.66666666666666 119.55357142857143 113.66666666666666C 127.92232142857144 113.66666666666666 135.09553571428572 113.66666666666666 143.46428571428572 113.66666666666666C 151.83303571428573 113.66666666666666 159.00625 82.66666666666666 167.375 82.66666666666666C 175.74375 82.66666666666666 182.91696428571427 82.66666666666666 191.28571428571428 82.66666666666666C 199.65446428571428 82.66666666666666 206.82767857142855 41.33333333333334 215.19642857142856 41.33333333333334C 223.56517857142856 41.33333333333334 230.73839285714286 41.33333333333334 239.10714285714286 41.33333333333334C 247.47589285714284 41.33333333333334 254.64910714285713 62 263.0178571428571 62C 271.38660714285714 62 278.5598214285714 62 286.92857142857144 62C 295.2973214285714 62 302.47053571428575 38.75 310.8392857142857 38.75C 319.2080357142857 38.75 326.38125 38.75 334.75 38.75" pathFrom="M -1 206.66666666666666 L -1 206.66666666666666 L 23.910714285714285 206.66666666666666 L 47.82142857142857 206.66666666666666 L 71.73214285714286 206.66666666666666 L 95.64285714285714 206.66666666666666 L 119.55357142857143 206.66666666666666 L 143.46428571428572 206.66666666666666 L 167.375 206.66666666666666 L 191.28571428571428 206.66666666666666 L 215.19642857142856 206.66666666666666 L 239.10714285714286 206.66666666666666 L 263.0178571428571 206.66666666666666 L 286.92857142857144 206.66666666666666 L 310.8392857142857 206.66666666666666 L 334.75 206.66666666666666" fill-rule="evenodd"></path><g id="SvgjsG2916" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle2961" r="0" cx="0" cy="0" class="apexcharts-marker w9jv017ka no-pointer-events" stroke="#3e97ff" fill="#3e97ff" fill-opacity="1" stroke-width="3" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG2917" class="apexcharts-datalabels" data:realIndex="0"></g></g><g id="SvgjsG2927" class="apexcharts-grid-borders"><line id="SvgjsLine2928" x1="0" y1="0" x2="334.75" y2="0" stroke="#dbdfe9" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2932" x1="0" y1="155" x2="334.75" y2="155" stroke="#dbdfe9" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line></g><line id="SvgjsLine2936" x1="0" y1="0" x2="0" y2="155" stroke="#3e97ff" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="155" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><line id="SvgjsLine2937" x1="0" y1="0" x2="334.75" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2938" x1="0" y1="0" x2="334.75" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG2939" class="apexcharts-xaxis" transform="translate(20, 0)"><g id="SvgjsG2940" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG2958" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG2959" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG2960" class="apexcharts-point-annotations"></g><rect id="SvgjsRect2962" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect><rect id="SvgjsRect2963" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect></g></svg><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: inherit; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(62, 151, 255);"></span><div class="apexcharts-tooltip-text" style="font-family: inherit; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light"><div class="apexcharts-xaxistooltip-text" style="font-family: inherit; font-size: 12px;"></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                                                <!--end::Chart-->
                                                <!--begin::Table container-->
                                                <div class="table-responsive mx-9 mt-n6">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle gs-0 gy-4">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr>
                                                                <th class="min-w-100px"></th>
                                                                <th class="min-w-100px text-end pe-0"></th>
                                                                <th class="text-end min-w-50px"></th>
                                                            </tr>
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-danger">-139.34</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">3:10 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$3,207.03</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-success">+576.24</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">3:55 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$3,274.94</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-success">+124.03</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Table container-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_charts_widget_35_tab_content_2" role="tabpanel" aria-labelledby="kt_charts_widget_35_tab_2">
                                                <!--begin::Chart-->
                                                <div id="kt_charts_widget_35_chart_2" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
                                                <!--end::Chart-->
                                                <!--begin::Table container-->
                                                <div class="table-responsive mx-9 mt-n6">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle gs-0 gy-4">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr>
                                                                <th class="min-w-100px"></th>
                                                                <th class="min-w-100px text-end pe-0"></th>
                                                                <th class="text-end min-w-50px"></th>
                                                            </tr>
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">4:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$2,345.45</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-success">+134.02</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">11:35 AM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-primary">-124.03</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">3:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$1,756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-danger">+144.04</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Table container-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_charts_widget_35_tab_content_3" role="tabpanel" aria-labelledby="kt_charts_widget_35_tab_3">
                                                <!--begin::Chart-->
                                                <div id="kt_charts_widget_35_chart_3" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
                                                <!--end::Chart-->
                                                <!--begin::Table container-->
                                                <div class="table-responsive mx-9 mt-n6">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle gs-0 gy-4">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr>
                                                                <th class="min-w-100px"></th>
                                                                <th class="min-w-100px text-end pe-0"></th>
                                                                <th class="text-end min-w-50px"></th>
                                                            </tr>
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">3:20 AM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$3,756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-primary">+185.03</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">12:30 AM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-danger">+124.03</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">4:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-success">-154.03</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Table container-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_charts_widget_35_tab_content_4" role="tabpanel" aria-labelledby="kt_charts_widget_35_tab_4">
                                                <!--begin::Chart-->
                                                <div id="kt_charts_widget_35_chart_4" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
                                                <!--end::Chart-->
                                                <!--begin::Table container-->
                                                <div class="table-responsive mx-9 mt-n6">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle gs-0 gy-4">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr>
                                                                <th class="min-w-100px"></th>
                                                                <th class="min-w-100px text-end pe-0"></th>
                                                                <th class="text-end min-w-50px"></th>
                                                            </tr>
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-warning">+124.03</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">5:30 AM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$1,756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-info">+144.65</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">4:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$2,085.25</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-primary">+154.06</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Table container-->
                                            </div>
                                            <!--end::Tap pane-->
                                            <!--begin::Tap pane-->
                                            <div class="tab-pane fade" id="kt_charts_widget_35_tab_content_5" role="tabpanel" aria-labelledby="kt_charts_widget_35_tab_5">
                                                <!--begin::Chart-->
                                                <div id="kt_charts_widget_35_chart_5" data-kt-chart-color="primary" class="min-h-auto h-200px ps-3 pe-6"></div>
                                                <!--end::Chart-->
                                                <!--begin::Table container-->
                                                <div class="table-responsive mx-9 mt-n6">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle gs-0 gy-4">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <tr>
                                                                <th class="min-w-100px"></th>
                                                                <th class="min-w-100px text-end pe-0"></th>
                                                                <th class="text-end min-w-50px"></th>
                                                            </tr>
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$2,045.04</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-warning">+114.03</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">3:30 AM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-primary">-124.03</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="text-gray-600 fw-bold fs-6">10:30 PM</a>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="text-gray-800 fw-bold fs-6 me-1">$1.756.26</span>
                                                                </td>
                                                                <td class="pe-0 text-end">
                                                                    <span class="fw-bold fs-6 text-info">+165.86</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Table container-->
                                            </div>
                                            <!--end::Tap pane-->
                                        </div>
                                        <!--end::Tab Content-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Chart Widget 35-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-8">
                                <!--begin::Table widget 14-->
                                <div class="card card-flush h-md-100">
                                    <!--begin::Header-->
                                    <div class="card-header pt-7">
                                        <!--begin::Title-->
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold text-gray-800">Projects Stats</span>
                                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Updated 37 minutes ago</span>
                                        </h3>
                                        <!--end::Title-->
                                        <!--begin::Toolbar-->
                                        <div class="card-toolbar">
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/add-product.html" class="btn btn-sm btn-light">History</a>
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-6">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                                        <th class="p-0 pb-3 min-w-175px text-start">ITEM</th>
                                                        <th class="p-0 pb-3 min-w-100px text-end">BUDGET</th>
                                                        <th class="p-0 pb-3 min-w-100px text-end">PROGRESS</th>
                                                        <th class="p-0 pb-3 min-w-175px text-end pe-12">STATUS</th>
                                                        <th class="p-0 pb-3 w-125px text-end pe-7">CHART</th>
                                                        <th class="p-0 pb-3 w-50px text-end">VIEW</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-50px me-3">
                                                                    <img src="assets/media/stock/600x600/img-49.jpg" class="" alt="">
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Mivy App</a>
                                                                    <span class="text-gray-400 fw-semibold d-block fs-7">Jane Cooper</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <span class="text-gray-600 fw-bold fs-6">$32,400</span>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <!--begin::Label-->
                                                            <span class="badge badge-light-success fs-base">
                                                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>9.2%</span>
                                                            <!--end::Label-->
                                                        </td>
                                                        <td class="text-end pe-12">
                                                            <span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <div id="kt_table_widget_14_chart_1" class="h-50px mt-n8 pe-7" data-kt-chart-color="success" style="min-height: 50px;"><div id="apexchartsqd1m65x1" class="apexcharts-canvas apexchartsqd1m65x1 apexcharts-theme-light" style="width: 92.25px; height: 50px;"><svg id="SvgjsSvg2964" width="92.25" height="50" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="92.25" height="50"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 25px;"></div></foreignObject><g id="SvgjsG3012" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG2966" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs2965"><clipPath id="gridRectMaskqd1m65x1"><rect id="SvgjsRect2969" width="98.25" height="52" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskqd1m65x1"></clipPath><clipPath id="nonForecastMaskqd1m65x1"></clipPath><clipPath id="gridRectMarkerMaskqd1m65x1"><rect id="SvgjsRect2970" width="96.25" height="54" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG2977" class="apexcharts-grid"><g id="SvgjsG2978" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine2981" x1="0" y1="0" x2="92.25" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2982" x1="0" y1="5" x2="92.25" y2="5" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2983" x1="0" y1="10" x2="92.25" y2="10" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2984" x1="0" y1="15" x2="92.25" y2="15" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2985" x1="0" y1="20" x2="92.25" y2="20" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2986" x1="0" y1="25" x2="92.25" y2="25" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2987" x1="0" y1="30" x2="92.25" y2="30" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2988" x1="0" y1="35" x2="92.25" y2="35" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2989" x1="0" y1="40" x2="92.25" y2="40" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2990" x1="0" y1="45" x2="92.25" y2="45" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2991" x1="0" y1="50" x2="92.25" y2="50" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG2979" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine2993" x1="0" y1="50" x2="92.25" y2="50" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine2992" x1="0" y1="1" x2="0" y2="50" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG2971" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG2972" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath2975" d="M 0 50 L 0 44.166666666666664C 2.483653846153846 44.166666666666664 4.612500000000001 41.666666666666664 7.096153846153847 41.666666666666664C 9.579807692307693 41.666666666666664 11.708653846153847 45.833333333333336 14.192307692307693 45.833333333333336C 16.67596153846154 45.833333333333336 18.804807692307694 32.5 21.28846153846154 32.5C 23.772115384615386 32.5 25.90096153846154 45 28.384615384615387 45C 30.868269230769233 45 32.997115384615384 40.83333333333333 35.48076923076923 40.83333333333333C 37.96442307692308 40.83333333333333 40.09326923076924 45.833333333333336 42.57692307692308 45.833333333333336C 45.06057692307692 45.833333333333336 47.18942307692308 30.833333333333332 49.67307692307693 30.833333333333332C 52.156730769230776 30.833333333333332 54.28557692307693 45.833333333333336 56.769230769230774 45.833333333333336C 59.252884615384616 45.833333333333336 61.38173076923077 40.83333333333333 63.86538461538462 40.83333333333333C 66.34903846153847 40.83333333333333 68.47788461538462 35 70.96153846153847 35C 73.44519230769231 35 75.57403846153846 44.166666666666664 78.0576923076923 44.166666666666664C 80.54134615384615 44.166666666666664 82.67019230769232 32.5 85.15384615384616 32.5C 87.6375 32.5 89.76634615384616 39.166666666666664 92.25 39.166666666666664C 92.25 39.166666666666664 92.25 39.166666666666664 92.25 50M 92.25 39.166666666666664z" fill="rgba(255,255,255,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskqd1m65x1)" pathTo="M 0 50 L 0 44.166666666666664C 2.483653846153846 44.166666666666664 4.612500000000001 41.666666666666664 7.096153846153847 41.666666666666664C 9.579807692307693 41.666666666666664 11.708653846153847 45.833333333333336 14.192307692307693 45.833333333333336C 16.67596153846154 45.833333333333336 18.804807692307694 32.5 21.28846153846154 32.5C 23.772115384615386 32.5 25.90096153846154 45 28.384615384615387 45C 30.868269230769233 45 32.997115384615384 40.83333333333333 35.48076923076923 40.83333333333333C 37.96442307692308 40.83333333333333 40.09326923076924 45.833333333333336 42.57692307692308 45.833333333333336C 45.06057692307692 45.833333333333336 47.18942307692308 30.833333333333332 49.67307692307693 30.833333333333332C 52.156730769230776 30.833333333333332 54.28557692307693 45.833333333333336 56.769230769230774 45.833333333333336C 59.252884615384616 45.833333333333336 61.38173076923077 40.83333333333333 63.86538461538462 40.83333333333333C 66.34903846153847 40.83333333333333 68.47788461538462 35 70.96153846153847 35C 73.44519230769231 35 75.57403846153846 44.166666666666664 78.0576923076923 44.166666666666664C 80.54134615384615 44.166666666666664 82.67019230769232 32.5 85.15384615384616 32.5C 87.6375 32.5 89.76634615384616 39.166666666666664 92.25 39.166666666666664C 92.25 39.166666666666664 92.25 39.166666666666664 92.25 50M 92.25 39.166666666666664z" pathFrom="M -1 50 L -1 50 L 7.096153846153847 50 L 14.192307692307693 50 L 21.28846153846154 50 L 28.384615384615387 50 L 35.48076923076923 50 L 42.57692307692308 50 L 49.67307692307693 50 L 56.769230769230774 50 L 63.86538461538462 50 L 70.96153846153847 50 L 78.0576923076923 50 L 85.15384615384616 50 L 92.25 50"></path><path id="SvgjsPath2976" d="M 0 44.166666666666664C 2.483653846153846 44.166666666666664 4.612500000000001 41.666666666666664 7.096153846153847 41.666666666666664C 9.579807692307693 41.666666666666664 11.708653846153847 45.833333333333336 14.192307692307693 45.833333333333336C 16.67596153846154 45.833333333333336 18.804807692307694 32.5 21.28846153846154 32.5C 23.772115384615386 32.5 25.90096153846154 45 28.384615384615387 45C 30.868269230769233 45 32.997115384615384 40.83333333333333 35.48076923076923 40.83333333333333C 37.96442307692308 40.83333333333333 40.09326923076924 45.833333333333336 42.57692307692308 45.833333333333336C 45.06057692307692 45.833333333333336 47.18942307692308 30.833333333333332 49.67307692307693 30.833333333333332C 52.156730769230776 30.833333333333332 54.28557692307693 45.833333333333336 56.769230769230774 45.833333333333336C 59.252884615384616 45.833333333333336 61.38173076923077 40.83333333333333 63.86538461538462 40.83333333333333C 66.34903846153847 40.83333333333333 68.47788461538462 35 70.96153846153847 35C 73.44519230769231 35 75.57403846153846 44.166666666666664 78.0576923076923 44.166666666666664C 80.54134615384615 44.166666666666664 82.67019230769232 32.5 85.15384615384616 32.5C 87.6375 32.5 89.76634615384616 39.166666666666664 92.25 39.166666666666664" fill="none" fill-opacity="1" stroke="#50cd89" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskqd1m65x1)" pathTo="M 0 44.166666666666664C 2.483653846153846 44.166666666666664 4.612500000000001 41.666666666666664 7.096153846153847 41.666666666666664C 9.579807692307693 41.666666666666664 11.708653846153847 45.833333333333336 14.192307692307693 45.833333333333336C 16.67596153846154 45.833333333333336 18.804807692307694 32.5 21.28846153846154 32.5C 23.772115384615386 32.5 25.90096153846154 45 28.384615384615387 45C 30.868269230769233 45 32.997115384615384 40.83333333333333 35.48076923076923 40.83333333333333C 37.96442307692308 40.83333333333333 40.09326923076924 45.833333333333336 42.57692307692308 45.833333333333336C 45.06057692307692 45.833333333333336 47.18942307692308 30.833333333333332 49.67307692307693 30.833333333333332C 52.156730769230776 30.833333333333332 54.28557692307693 45.833333333333336 56.769230769230774 45.833333333333336C 59.252884615384616 45.833333333333336 61.38173076923077 40.83333333333333 63.86538461538462 40.83333333333333C 66.34903846153847 40.83333333333333 68.47788461538462 35 70.96153846153847 35C 73.44519230769231 35 75.57403846153846 44.166666666666664 78.0576923076923 44.166666666666664C 80.54134615384615 44.166666666666664 82.67019230769232 32.5 85.15384615384616 32.5C 87.6375 32.5 89.76634615384616 39.166666666666664 92.25 39.166666666666664" pathFrom="M -1 50 L -1 50 L 7.096153846153847 50 L 14.192307692307693 50 L 21.28846153846154 50 L 28.384615384615387 50 L 35.48076923076923 50 L 42.57692307692308 50 L 49.67307692307693 50 L 56.769230769230774 50 L 63.86538461538462 50 L 70.96153846153847 50 L 78.0576923076923 50 L 85.15384615384616 50 L 92.25 50" fill-rule="evenodd"></path><g id="SvgjsG2973" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0"></g></g><g id="SvgjsG2974" class="apexcharts-datalabels" data:realIndex="0"></g></g><g id="SvgjsG2980" class="apexcharts-grid-borders" style="display: none;"></g><line id="SvgjsLine2994" x1="0" y1="0" x2="92.25" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2995" x1="0" y1="0" x2="92.25" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG2996" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG2997" class="apexcharts-xaxis-texts-g" transform="translate(0, 4)"></g></g><g id="SvgjsG3013" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG3014" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG3015" class="apexcharts-point-annotations"></g></g></svg></div></div>
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                                <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-50px me-3">
                                                                    <img src="assets/media/stock/600x600/img-40.jpg" class="" alt="">
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Avionica</a>
                                                                    <span class="text-gray-400 fw-semibold d-block fs-7">Esther Howard</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <span class="text-gray-600 fw-bold fs-6">$256,910</span>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <!--begin::Label-->
                                                            <span class="badge badge-light-danger fs-base">
                                                            <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>0.4%</span>
                                                            <!--end::Label-->
                                                        </td>
                                                        <td class="text-end pe-12">
                                                            <span class="badge py-3 px-4 fs-7 badge-light-warning">On Hold</span>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <div id="kt_table_widget_14_chart_2" class="h-50px mt-n8 pe-7" data-kt-chart-color="danger" style="min-height: 50px;"><div id="apexcharts32uh35l6" class="apexcharts-canvas apexcharts32uh35l6 apexcharts-theme-light" style="width: 92.25px; height: 50px;"><svg id="SvgjsSvg3016" width="92.25" height="50" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="92.25" height="50"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 25px;"></div></foreignObject><g id="SvgjsG3064" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG3018" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs3017"><clipPath id="gridRectMask32uh35l6"><rect id="SvgjsRect3021" width="98.25" height="52" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask32uh35l6"></clipPath><clipPath id="nonForecastMask32uh35l6"></clipPath><clipPath id="gridRectMarkerMask32uh35l6"><rect id="SvgjsRect3022" width="96.25" height="54" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG3029" class="apexcharts-grid"><g id="SvgjsG3030" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine3033" x1="0" y1="0" x2="92.25" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3034" x1="0" y1="5" x2="92.25" y2="5" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3035" x1="0" y1="10" x2="92.25" y2="10" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3036" x1="0" y1="15" x2="92.25" y2="15" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3037" x1="0" y1="20" x2="92.25" y2="20" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3038" x1="0" y1="25" x2="92.25" y2="25" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3039" x1="0" y1="30" x2="92.25" y2="30" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3040" x1="0" y1="35" x2="92.25" y2="35" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3041" x1="0" y1="40" x2="92.25" y2="40" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3042" x1="0" y1="45" x2="92.25" y2="45" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3043" x1="0" y1="50" x2="92.25" y2="50" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG3031" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine3045" x1="0" y1="50" x2="92.25" y2="50" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine3044" x1="0" y1="1" x2="0" y2="50" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG3023" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG3024" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath3027" d="M 0 50 L 0 35.83333333333333C 2.483653846153846 35.83333333333333 4.612500000000001 45.833333333333336 7.096153846153847 45.833333333333336C 9.579807692307693 45.833333333333336 11.708653846153847 30.833333333333332 14.192307692307693 30.833333333333332C 16.67596153846154 30.833333333333332 18.804807692307694 48.333333333333336 21.28846153846154 48.333333333333336C 23.772115384615386 48.333333333333336 25.90096153846154 32.5 28.384615384615387 32.5C 30.868269230769233 32.5 32.997115384615384 42.5 35.48076923076923 42.5C 37.96442307692308 42.5 40.09326923076924 35.83333333333333 42.57692307692308 35.83333333333333C 45.06057692307692 35.83333333333333 47.18942307692308 30.833333333333332 49.67307692307693 30.833333333333332C 52.156730769230776 30.833333333333332 54.28557692307693 46.666666666666664 56.769230769230774 46.666666666666664C 59.252884615384616 46.666666666666664 61.38173076923077 30 63.86538461538462 30C 66.34903846153847 30 68.47788461538462 42.5 70.96153846153847 42.5C 73.44519230769231 42.5 75.57403846153846 35.83333333333333 78.0576923076923 35.83333333333333C 80.54134615384615 35.83333333333333 82.67019230769232 32.5 85.15384615384616 32.5C 87.6375 32.5 89.76634615384616 44.166666666666664 92.25 44.166666666666664C 92.25 44.166666666666664 92.25 44.166666666666664 92.25 50M 92.25 44.166666666666664z" fill="rgba(255,255,255,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask32uh35l6)" pathTo="M 0 50 L 0 35.83333333333333C 2.483653846153846 35.83333333333333 4.612500000000001 45.833333333333336 7.096153846153847 45.833333333333336C 9.579807692307693 45.833333333333336 11.708653846153847 30.833333333333332 14.192307692307693 30.833333333333332C 16.67596153846154 30.833333333333332 18.804807692307694 48.333333333333336 21.28846153846154 48.333333333333336C 23.772115384615386 48.333333333333336 25.90096153846154 32.5 28.384615384615387 32.5C 30.868269230769233 32.5 32.997115384615384 42.5 35.48076923076923 42.5C 37.96442307692308 42.5 40.09326923076924 35.83333333333333 42.57692307692308 35.83333333333333C 45.06057692307692 35.83333333333333 47.18942307692308 30.833333333333332 49.67307692307693 30.833333333333332C 52.156730769230776 30.833333333333332 54.28557692307693 46.666666666666664 56.769230769230774 46.666666666666664C 59.252884615384616 46.666666666666664 61.38173076923077 30 63.86538461538462 30C 66.34903846153847 30 68.47788461538462 42.5 70.96153846153847 42.5C 73.44519230769231 42.5 75.57403846153846 35.83333333333333 78.0576923076923 35.83333333333333C 80.54134615384615 35.83333333333333 82.67019230769232 32.5 85.15384615384616 32.5C 87.6375 32.5 89.76634615384616 44.166666666666664 92.25 44.166666666666664C 92.25 44.166666666666664 92.25 44.166666666666664 92.25 50M 92.25 44.166666666666664z" pathFrom="M -1 50 L -1 50 L 7.096153846153847 50 L 14.192307692307693 50 L 21.28846153846154 50 L 28.384615384615387 50 L 35.48076923076923 50 L 42.57692307692308 50 L 49.67307692307693 50 L 56.769230769230774 50 L 63.86538461538462 50 L 70.96153846153847 50 L 78.0576923076923 50 L 85.15384615384616 50 L 92.25 50"></path><path id="SvgjsPath3028" d="M 0 35.83333333333333C 2.483653846153846 35.83333333333333 4.612500000000001 45.833333333333336 7.096153846153847 45.833333333333336C 9.579807692307693 45.833333333333336 11.708653846153847 30.833333333333332 14.192307692307693 30.833333333333332C 16.67596153846154 30.833333333333332 18.804807692307694 48.333333333333336 21.28846153846154 48.333333333333336C 23.772115384615386 48.333333333333336 25.90096153846154 32.5 28.384615384615387 32.5C 30.868269230769233 32.5 32.997115384615384 42.5 35.48076923076923 42.5C 37.96442307692308 42.5 40.09326923076924 35.83333333333333 42.57692307692308 35.83333333333333C 45.06057692307692 35.83333333333333 47.18942307692308 30.833333333333332 49.67307692307693 30.833333333333332C 52.156730769230776 30.833333333333332 54.28557692307693 46.666666666666664 56.769230769230774 46.666666666666664C 59.252884615384616 46.666666666666664 61.38173076923077 30 63.86538461538462 30C 66.34903846153847 30 68.47788461538462 42.5 70.96153846153847 42.5C 73.44519230769231 42.5 75.57403846153846 35.83333333333333 78.0576923076923 35.83333333333333C 80.54134615384615 35.83333333333333 82.67019230769232 32.5 85.15384615384616 32.5C 87.6375 32.5 89.76634615384616 44.166666666666664 92.25 44.166666666666664" fill="none" fill-opacity="1" stroke="#f1416c" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask32uh35l6)" pathTo="M 0 35.83333333333333C 2.483653846153846 35.83333333333333 4.612500000000001 45.833333333333336 7.096153846153847 45.833333333333336C 9.579807692307693 45.833333333333336 11.708653846153847 30.833333333333332 14.192307692307693 30.833333333333332C 16.67596153846154 30.833333333333332 18.804807692307694 48.333333333333336 21.28846153846154 48.333333333333336C 23.772115384615386 48.333333333333336 25.90096153846154 32.5 28.384615384615387 32.5C 30.868269230769233 32.5 32.997115384615384 42.5 35.48076923076923 42.5C 37.96442307692308 42.5 40.09326923076924 35.83333333333333 42.57692307692308 35.83333333333333C 45.06057692307692 35.83333333333333 47.18942307692308 30.833333333333332 49.67307692307693 30.833333333333332C 52.156730769230776 30.833333333333332 54.28557692307693 46.666666666666664 56.769230769230774 46.666666666666664C 59.252884615384616 46.666666666666664 61.38173076923077 30 63.86538461538462 30C 66.34903846153847 30 68.47788461538462 42.5 70.96153846153847 42.5C 73.44519230769231 42.5 75.57403846153846 35.83333333333333 78.0576923076923 35.83333333333333C 80.54134615384615 35.83333333333333 82.67019230769232 32.5 85.15384615384616 32.5C 87.6375 32.5 89.76634615384616 44.166666666666664 92.25 44.166666666666664" pathFrom="M -1 50 L -1 50 L 7.096153846153847 50 L 14.192307692307693 50 L 21.28846153846154 50 L 28.384615384615387 50 L 35.48076923076923 50 L 42.57692307692308 50 L 49.67307692307693 50 L 56.769230769230774 50 L 63.86538461538462 50 L 70.96153846153847 50 L 78.0576923076923 50 L 85.15384615384616 50 L 92.25 50" fill-rule="evenodd"></path><g id="SvgjsG3025" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0"></g></g><g id="SvgjsG3026" class="apexcharts-datalabels" data:realIndex="0"></g></g><g id="SvgjsG3032" class="apexcharts-grid-borders" style="display: none;"></g><line id="SvgjsLine3046" x1="0" y1="0" x2="92.25" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine3047" x1="0" y1="0" x2="92.25" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG3048" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG3049" class="apexcharts-xaxis-texts-g" transform="translate(0, 4)"></g></g><g id="SvgjsG3065" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG3066" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG3067" class="apexcharts-point-annotations"></g></g></svg></div></div>
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                                <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-50px me-3">
                                                                    <img src="assets/media/stock/600x600/img-39.jpg" class="" alt="">
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Charto CRM</a>
                                                                    <span class="text-gray-400 fw-semibold d-block fs-7">Jenny Wilson</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <span class="text-gray-600 fw-bold fs-6">$8,220</span>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <!--begin::Label-->
                                                            <span class="badge badge-light-success fs-base">
                                                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>9.2%</span>
                                                            <!--end::Label-->
                                                        </td>
                                                        <td class="text-end pe-12">
                                                            <span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <div id="kt_table_widget_14_chart_3" class="h-50px mt-n8 pe-7" data-kt-chart-color="success" style="min-height: 50px;"><div id="apexchartsvgakk09t" class="apexcharts-canvas apexchartsvgakk09t apexcharts-theme-light" style="width: 92.25px; height: 50px;"><svg id="SvgjsSvg3068" width="92.25" height="50" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="92.25" height="50"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 25px;"></div></foreignObject><g id="SvgjsG3116" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG3070" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs3069"><clipPath id="gridRectMaskvgakk09t"><rect id="SvgjsRect3073" width="98.25" height="52" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskvgakk09t"></clipPath><clipPath id="nonForecastMaskvgakk09t"></clipPath><clipPath id="gridRectMarkerMaskvgakk09t"><rect id="SvgjsRect3074" width="96.25" height="54" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG3081" class="apexcharts-grid"><g id="SvgjsG3082" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine3085" x1="0" y1="0" x2="92.25" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3086" x1="0" y1="5" x2="92.25" y2="5" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3087" x1="0" y1="10" x2="92.25" y2="10" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3088" x1="0" y1="15" x2="92.25" y2="15" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3089" x1="0" y1="20" x2="92.25" y2="20" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3090" x1="0" y1="25" x2="92.25" y2="25" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3091" x1="0" y1="30" x2="92.25" y2="30" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3092" x1="0" y1="35" x2="92.25" y2="35" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3093" x1="0" y1="40" x2="92.25" y2="40" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3094" x1="0" y1="45" x2="92.25" y2="45" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3095" x1="0" y1="50" x2="92.25" y2="50" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG3083" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine3097" x1="0" y1="50" x2="92.25" y2="50" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine3096" x1="0" y1="1" x2="0" y2="50" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG3075" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG3076" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath3079" d="M 0 50 L 0 48.333333333333336C 2.483653846153846 48.333333333333336 4.612500000000001 30 7.096153846153847 30C 9.579807692307693 30 11.708653846153847 45.833333333333336 14.192307692307693 45.833333333333336C 16.67596153846154 45.833333333333336 18.804807692307694 35.83333333333333 21.28846153846154 35.83333333333333C 23.772115384615386 35.83333333333333 25.90096153846154 44.166666666666664 28.384615384615387 44.166666666666664C 30.868269230769233 44.166666666666664 32.997115384615384 48.333333333333336 35.48076923076923 48.333333333333336C 37.96442307692308 48.333333333333336 40.09326923076924 40 42.57692307692308 40C 45.06057692307692 40 47.18942307692308 30 49.67307692307693 30C 52.156730769230776 30 54.28557692307693 45.833333333333336 56.769230769230774 45.833333333333336C 59.252884615384616 45.833333333333336 61.38173076923077 30 63.86538461538462 30C 66.34903846153847 30 68.47788461538462 48.333333333333336 70.96153846153847 48.333333333333336C 73.44519230769231 48.333333333333336 75.57403846153846 43.333333333333336 78.0576923076923 43.333333333333336C 80.54134615384615 43.333333333333336 82.67019230769232 40 85.15384615384616 40C 87.6375 40 89.76634615384616 44.166666666666664 92.25 44.166666666666664C 92.25 44.166666666666664 92.25 44.166666666666664 92.25 50M 92.25 44.166666666666664z" fill="rgba(255,255,255,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskvgakk09t)" pathTo="M 0 50 L 0 48.333333333333336C 2.483653846153846 48.333333333333336 4.612500000000001 30 7.096153846153847 30C 9.579807692307693 30 11.708653846153847 45.833333333333336 14.192307692307693 45.833333333333336C 16.67596153846154 45.833333333333336 18.804807692307694 35.83333333333333 21.28846153846154 35.83333333333333C 23.772115384615386 35.83333333333333 25.90096153846154 44.166666666666664 28.384615384615387 44.166666666666664C 30.868269230769233 44.166666666666664 32.997115384615384 48.333333333333336 35.48076923076923 48.333333333333336C 37.96442307692308 48.333333333333336 40.09326923076924 40 42.57692307692308 40C 45.06057692307692 40 47.18942307692308 30 49.67307692307693 30C 52.156730769230776 30 54.28557692307693 45.833333333333336 56.769230769230774 45.833333333333336C 59.252884615384616 45.833333333333336 61.38173076923077 30 63.86538461538462 30C 66.34903846153847 30 68.47788461538462 48.333333333333336 70.96153846153847 48.333333333333336C 73.44519230769231 48.333333333333336 75.57403846153846 43.333333333333336 78.0576923076923 43.333333333333336C 80.54134615384615 43.333333333333336 82.67019230769232 40 85.15384615384616 40C 87.6375 40 89.76634615384616 44.166666666666664 92.25 44.166666666666664C 92.25 44.166666666666664 92.25 44.166666666666664 92.25 50M 92.25 44.166666666666664z" pathFrom="M -1 50 L -1 50 L 7.096153846153847 50 L 14.192307692307693 50 L 21.28846153846154 50 L 28.384615384615387 50 L 35.48076923076923 50 L 42.57692307692308 50 L 49.67307692307693 50 L 56.769230769230774 50 L 63.86538461538462 50 L 70.96153846153847 50 L 78.0576923076923 50 L 85.15384615384616 50 L 92.25 50"></path><path id="SvgjsPath3080" d="M 0 48.333333333333336C 2.483653846153846 48.333333333333336 4.612500000000001 30 7.096153846153847 30C 9.579807692307693 30 11.708653846153847 45.833333333333336 14.192307692307693 45.833333333333336C 16.67596153846154 45.833333333333336 18.804807692307694 35.83333333333333 21.28846153846154 35.83333333333333C 23.772115384615386 35.83333333333333 25.90096153846154 44.166666666666664 28.384615384615387 44.166666666666664C 30.868269230769233 44.166666666666664 32.997115384615384 48.333333333333336 35.48076923076923 48.333333333333336C 37.96442307692308 48.333333333333336 40.09326923076924 40 42.57692307692308 40C 45.06057692307692 40 47.18942307692308 30 49.67307692307693 30C 52.156730769230776 30 54.28557692307693 45.833333333333336 56.769230769230774 45.833333333333336C 59.252884615384616 45.833333333333336 61.38173076923077 30 63.86538461538462 30C 66.34903846153847 30 68.47788461538462 48.333333333333336 70.96153846153847 48.333333333333336C 73.44519230769231 48.333333333333336 75.57403846153846 43.333333333333336 78.0576923076923 43.333333333333336C 80.54134615384615 43.333333333333336 82.67019230769232 40 85.15384615384616 40C 87.6375 40 89.76634615384616 44.166666666666664 92.25 44.166666666666664" fill="none" fill-opacity="1" stroke="#50cd89" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskvgakk09t)" pathTo="M 0 48.333333333333336C 2.483653846153846 48.333333333333336 4.612500000000001 30 7.096153846153847 30C 9.579807692307693 30 11.708653846153847 45.833333333333336 14.192307692307693 45.833333333333336C 16.67596153846154 45.833333333333336 18.804807692307694 35.83333333333333 21.28846153846154 35.83333333333333C 23.772115384615386 35.83333333333333 25.90096153846154 44.166666666666664 28.384615384615387 44.166666666666664C 30.868269230769233 44.166666666666664 32.997115384615384 48.333333333333336 35.48076923076923 48.333333333333336C 37.96442307692308 48.333333333333336 40.09326923076924 40 42.57692307692308 40C 45.06057692307692 40 47.18942307692308 30 49.67307692307693 30C 52.156730769230776 30 54.28557692307693 45.833333333333336 56.769230769230774 45.833333333333336C 59.252884615384616 45.833333333333336 61.38173076923077 30 63.86538461538462 30C 66.34903846153847 30 68.47788461538462 48.333333333333336 70.96153846153847 48.333333333333336C 73.44519230769231 48.333333333333336 75.57403846153846 43.333333333333336 78.0576923076923 43.333333333333336C 80.54134615384615 43.333333333333336 82.67019230769232 40 85.15384615384616 40C 87.6375 40 89.76634615384616 44.166666666666664 92.25 44.166666666666664" pathFrom="M -1 50 L -1 50 L 7.096153846153847 50 L 14.192307692307693 50 L 21.28846153846154 50 L 28.384615384615387 50 L 35.48076923076923 50 L 42.57692307692308 50 L 49.67307692307693 50 L 56.769230769230774 50 L 63.86538461538462 50 L 70.96153846153847 50 L 78.0576923076923 50 L 85.15384615384616 50 L 92.25 50" fill-rule="evenodd"></path><g id="SvgjsG3077" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0"></g></g><g id="SvgjsG3078" class="apexcharts-datalabels" data:realIndex="0"></g></g><g id="SvgjsG3084" class="apexcharts-grid-borders" style="display: none;"></g><line id="SvgjsLine3098" x1="0" y1="0" x2="92.25" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine3099" x1="0" y1="0" x2="92.25" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG3100" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG3101" class="apexcharts-xaxis-texts-g" transform="translate(0, 4)"></g></g><g id="SvgjsG3117" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG3118" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG3119" class="apexcharts-point-annotations"></g></g></svg></div></div>
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                                <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-50px me-3">
                                                                    <img src="assets/media/stock/600x600/img-47.jpg" class="" alt="">
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tower Hill</a>
                                                                    <span class="text-gray-400 fw-semibold d-block fs-7">Cody Fisher</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <span class="text-gray-600 fw-bold fs-6">$74,000</span>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <!--begin::Label-->
                                                            <span class="badge badge-light-success fs-base">
                                                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>9.2%</span>
                                                            <!--end::Label-->
                                                        </td>
                                                        <td class="text-end pe-12">
                                                            <span class="badge py-3 px-4 fs-7 badge-light-success">Complated</span>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <div id="kt_table_widget_14_chart_4" class="h-50px mt-n8 pe-7" data-kt-chart-color="success" style="min-height: 50px;"><div id="apexchartsfet2pz7l" class="apexcharts-canvas apexchartsfet2pz7l apexcharts-theme-light" style="width: 92.25px; height: 50px;"><svg id="SvgjsSvg3120" width="92.25" height="50" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="92.25" height="50"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 25px;"></div></foreignObject><g id="SvgjsG3168" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG3122" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs3121"><clipPath id="gridRectMaskfet2pz7l"><rect id="SvgjsRect3125" width="98.25" height="52" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskfet2pz7l"></clipPath><clipPath id="nonForecastMaskfet2pz7l"></clipPath><clipPath id="gridRectMarkerMaskfet2pz7l"><rect id="SvgjsRect3126" width="96.25" height="54" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG3133" class="apexcharts-grid"><g id="SvgjsG3134" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine3137" x1="0" y1="0" x2="92.25" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3138" x1="0" y1="5" x2="92.25" y2="5" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3139" x1="0" y1="10" x2="92.25" y2="10" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3140" x1="0" y1="15" x2="92.25" y2="15" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3141" x1="0" y1="20" x2="92.25" y2="20" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3142" x1="0" y1="25" x2="92.25" y2="25" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3143" x1="0" y1="30" x2="92.25" y2="30" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3144" x1="0" y1="35" x2="92.25" y2="35" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3145" x1="0" y1="40" x2="92.25" y2="40" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3146" x1="0" y1="45" x2="92.25" y2="45" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3147" x1="0" y1="50" x2="92.25" y2="50" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG3135" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine3149" x1="0" y1="50" x2="92.25" y2="50" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine3148" x1="0" y1="1" x2="0" y2="50" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG3127" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG3128" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath3131" d="M 0 50 L 0 30C 2.483653846153846 30 4.612500000000001 47.5 7.096153846153847 47.5C 9.579807692307693 47.5 11.708653846153847 45.833333333333336 14.192307692307693 45.833333333333336C 16.67596153846154 45.833333333333336 18.804807692307694 34.166666666666664 21.28846153846154 34.166666666666664C 23.772115384615386 34.166666666666664 25.90096153846154 47.5 28.384615384615387 47.5C 30.868269230769233 47.5 32.997115384615384 44.166666666666664 35.48076923076923 44.166666666666664C 37.96442307692308 44.166666666666664 40.09326923076924 29.166666666666664 42.57692307692308 29.166666666666664C 45.06057692307692 29.166666666666664 47.18942307692308 38.33333333333333 49.67307692307693 38.33333333333333C 52.156730769230776 38.33333333333333 54.28557692307693 45.833333333333336 56.769230769230774 45.833333333333336C 59.252884615384616 45.833333333333336 61.38173076923077 38.33333333333333 63.86538461538462 38.33333333333333C 66.34903846153847 38.33333333333333 68.47788461538462 48.333333333333336 70.96153846153847 48.333333333333336C 73.44519230769231 48.333333333333336 75.57403846153846 43.333333333333336 78.0576923076923 43.333333333333336C 80.54134615384615 43.333333333333336 82.67019230769232 45.833333333333336 85.15384615384616 45.833333333333336C 87.6375 45.833333333333336 89.76634615384616 35.83333333333333 92.25 35.83333333333333C 92.25 35.83333333333333 92.25 35.83333333333333 92.25 50M 92.25 35.83333333333333z" fill="rgba(255,255,255,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskfet2pz7l)" pathTo="M 0 50 L 0 30C 2.483653846153846 30 4.612500000000001 47.5 7.096153846153847 47.5C 9.579807692307693 47.5 11.708653846153847 45.833333333333336 14.192307692307693 45.833333333333336C 16.67596153846154 45.833333333333336 18.804807692307694 34.166666666666664 21.28846153846154 34.166666666666664C 23.772115384615386 34.166666666666664 25.90096153846154 47.5 28.384615384615387 47.5C 30.868269230769233 47.5 32.997115384615384 44.166666666666664 35.48076923076923 44.166666666666664C 37.96442307692308 44.166666666666664 40.09326923076924 29.166666666666664 42.57692307692308 29.166666666666664C 45.06057692307692 29.166666666666664 47.18942307692308 38.33333333333333 49.67307692307693 38.33333333333333C 52.156730769230776 38.33333333333333 54.28557692307693 45.833333333333336 56.769230769230774 45.833333333333336C 59.252884615384616 45.833333333333336 61.38173076923077 38.33333333333333 63.86538461538462 38.33333333333333C 66.34903846153847 38.33333333333333 68.47788461538462 48.333333333333336 70.96153846153847 48.333333333333336C 73.44519230769231 48.333333333333336 75.57403846153846 43.333333333333336 78.0576923076923 43.333333333333336C 80.54134615384615 43.333333333333336 82.67019230769232 45.833333333333336 85.15384615384616 45.833333333333336C 87.6375 45.833333333333336 89.76634615384616 35.83333333333333 92.25 35.83333333333333C 92.25 35.83333333333333 92.25 35.83333333333333 92.25 50M 92.25 35.83333333333333z" pathFrom="M -1 50 L -1 50 L 7.096153846153847 50 L 14.192307692307693 50 L 21.28846153846154 50 L 28.384615384615387 50 L 35.48076923076923 50 L 42.57692307692308 50 L 49.67307692307693 50 L 56.769230769230774 50 L 63.86538461538462 50 L 70.96153846153847 50 L 78.0576923076923 50 L 85.15384615384616 50 L 92.25 50"></path><path id="SvgjsPath3132" d="M 0 30C 2.483653846153846 30 4.612500000000001 47.5 7.096153846153847 47.5C 9.579807692307693 47.5 11.708653846153847 45.833333333333336 14.192307692307693 45.833333333333336C 16.67596153846154 45.833333333333336 18.804807692307694 34.166666666666664 21.28846153846154 34.166666666666664C 23.772115384615386 34.166666666666664 25.90096153846154 47.5 28.384615384615387 47.5C 30.868269230769233 47.5 32.997115384615384 44.166666666666664 35.48076923076923 44.166666666666664C 37.96442307692308 44.166666666666664 40.09326923076924 29.166666666666664 42.57692307692308 29.166666666666664C 45.06057692307692 29.166666666666664 47.18942307692308 38.33333333333333 49.67307692307693 38.33333333333333C 52.156730769230776 38.33333333333333 54.28557692307693 45.833333333333336 56.769230769230774 45.833333333333336C 59.252884615384616 45.833333333333336 61.38173076923077 38.33333333333333 63.86538461538462 38.33333333333333C 66.34903846153847 38.33333333333333 68.47788461538462 48.333333333333336 70.96153846153847 48.333333333333336C 73.44519230769231 48.333333333333336 75.57403846153846 43.333333333333336 78.0576923076923 43.333333333333336C 80.54134615384615 43.333333333333336 82.67019230769232 45.833333333333336 85.15384615384616 45.833333333333336C 87.6375 45.833333333333336 89.76634615384616 35.83333333333333 92.25 35.83333333333333" fill="none" fill-opacity="1" stroke="#50cd89" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskfet2pz7l)" pathTo="M 0 30C 2.483653846153846 30 4.612500000000001 47.5 7.096153846153847 47.5C 9.579807692307693 47.5 11.708653846153847 45.833333333333336 14.192307692307693 45.833333333333336C 16.67596153846154 45.833333333333336 18.804807692307694 34.166666666666664 21.28846153846154 34.166666666666664C 23.772115384615386 34.166666666666664 25.90096153846154 47.5 28.384615384615387 47.5C 30.868269230769233 47.5 32.997115384615384 44.166666666666664 35.48076923076923 44.166666666666664C 37.96442307692308 44.166666666666664 40.09326923076924 29.166666666666664 42.57692307692308 29.166666666666664C 45.06057692307692 29.166666666666664 47.18942307692308 38.33333333333333 49.67307692307693 38.33333333333333C 52.156730769230776 38.33333333333333 54.28557692307693 45.833333333333336 56.769230769230774 45.833333333333336C 59.252884615384616 45.833333333333336 61.38173076923077 38.33333333333333 63.86538461538462 38.33333333333333C 66.34903846153847 38.33333333333333 68.47788461538462 48.333333333333336 70.96153846153847 48.333333333333336C 73.44519230769231 48.333333333333336 75.57403846153846 43.333333333333336 78.0576923076923 43.333333333333336C 80.54134615384615 43.333333333333336 82.67019230769232 45.833333333333336 85.15384615384616 45.833333333333336C 87.6375 45.833333333333336 89.76634615384616 35.83333333333333 92.25 35.83333333333333" pathFrom="M -1 50 L -1 50 L 7.096153846153847 50 L 14.192307692307693 50 L 21.28846153846154 50 L 28.384615384615387 50 L 35.48076923076923 50 L 42.57692307692308 50 L 49.67307692307693 50 L 56.769230769230774 50 L 63.86538461538462 50 L 70.96153846153847 50 L 78.0576923076923 50 L 85.15384615384616 50 L 92.25 50" fill-rule="evenodd"></path><g id="SvgjsG3129" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0"></g></g><g id="SvgjsG3130" class="apexcharts-datalabels" data:realIndex="0"></g></g><g id="SvgjsG3136" class="apexcharts-grid-borders" style="display: none;"></g><line id="SvgjsLine3150" x1="0" y1="0" x2="92.25" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine3151" x1="0" y1="0" x2="92.25" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG3152" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG3153" class="apexcharts-xaxis-texts-g" transform="translate(0, 4)"></g></g><g id="SvgjsG3169" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG3170" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG3171" class="apexcharts-point-annotations"></g></g></svg></div></div>
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                                <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-50px me-3">
                                                                    <img src="assets/media/stock/600x600/img-48.jpg" class="" alt="">
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">9 Degree</a>
                                                                    <span class="text-gray-400 fw-semibold d-block fs-7">Savannah Nguyen</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <span class="text-gray-600 fw-bold fs-6">$183,300</span>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <!--begin::Label-->
                                                            <span class="badge badge-light-danger fs-base">
                                                            <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>0.4%</span>
                                                            <!--end::Label-->
                                                        </td>
                                                        <td class="text-end pe-12">
                                                            <span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
                                                        </td>
                                                        <td class="text-end pe-0">
                                                            <div id="kt_table_widget_14_chart_5" class="h-50px mt-n8 pe-7" data-kt-chart-color="danger" style="min-height: 50px;"><div id="apexchartsbltige8k" class="apexcharts-canvas apexchartsbltige8k apexcharts-theme-light" style="width: 92.25px; height: 50px;"><svg id="SvgjsSvg3172" width="92.25" height="50" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="92.25" height="50"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 25px;"></div></foreignObject><g id="SvgjsG3220" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG3174" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs3173"><clipPath id="gridRectMaskbltige8k"><rect id="SvgjsRect3177" width="98.25" height="52" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskbltige8k"></clipPath><clipPath id="nonForecastMaskbltige8k"></clipPath><clipPath id="gridRectMarkerMaskbltige8k"><rect id="SvgjsRect3178" width="96.25" height="54" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG3185" class="apexcharts-grid"><g id="SvgjsG3186" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine3189" x1="0" y1="0" x2="92.25" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3190" x1="0" y1="5" x2="92.25" y2="5" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3191" x1="0" y1="10" x2="92.25" y2="10" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3192" x1="0" y1="15" x2="92.25" y2="15" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3193" x1="0" y1="20" x2="92.25" y2="20" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3194" x1="0" y1="25" x2="92.25" y2="25" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3195" x1="0" y1="30" x2="92.25" y2="30" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3196" x1="0" y1="35" x2="92.25" y2="35" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3197" x1="0" y1="40" x2="92.25" y2="40" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3198" x1="0" y1="45" x2="92.25" y2="45" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine3199" x1="0" y1="50" x2="92.25" y2="50" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG3187" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine3201" x1="0" y1="50" x2="92.25" y2="50" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine3200" x1="0" y1="1" x2="0" y2="50" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG3179" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG3180" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath3183" d="M 0 50 L 0 47.5C 2.483653846153846 47.5 4.612500000000001 30.833333333333332 7.096153846153847 30.833333333333332C 9.579807692307693 30.833333333333332 11.708653846153847 49.166666666666664 14.192307692307693 49.166666666666664C 16.67596153846154 49.166666666666664 18.804807692307694 34.166666666666664 21.28846153846154 34.166666666666664C 23.772115384615386 34.166666666666664 25.90096153846154 47.5 28.384615384615387 47.5C 30.868269230769233 47.5 32.997115384615384 35.83333333333333 35.48076923076923 35.83333333333333C 37.96442307692308 35.83333333333333 40.09326923076924 47.5 42.57692307692308 47.5C 45.06057692307692 47.5 47.18942307692308 42.5 49.67307692307693 42.5C 52.156730769230776 42.5 54.28557692307693 29.166666666666664 56.769230769230774 29.166666666666664C 59.252884615384616 29.166666666666664 61.38173076923077 46.666666666666664 63.86538461538462 46.666666666666664C 66.34903846153847 46.666666666666664 68.47788461538462 48.333333333333336 70.96153846153847 48.333333333333336C 73.44519230769231 48.333333333333336 75.57403846153846 35 78.0576923076923 35C 80.54134615384615 35 82.67019230769232 29.166666666666664 85.15384615384616 29.166666666666664C 87.6375 29.166666666666664 89.76634615384616 47.5 92.25 47.5C 92.25 47.5 92.25 47.5 92.25 50M 92.25 47.5z" fill="rgba(255,255,255,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskbltige8k)" pathTo="M 0 50 L 0 47.5C 2.483653846153846 47.5 4.612500000000001 30.833333333333332 7.096153846153847 30.833333333333332C 9.579807692307693 30.833333333333332 11.708653846153847 49.166666666666664 14.192307692307693 49.166666666666664C 16.67596153846154 49.166666666666664 18.804807692307694 34.166666666666664 21.28846153846154 34.166666666666664C 23.772115384615386 34.166666666666664 25.90096153846154 47.5 28.384615384615387 47.5C 30.868269230769233 47.5 32.997115384615384 35.83333333333333 35.48076923076923 35.83333333333333C 37.96442307692308 35.83333333333333 40.09326923076924 47.5 42.57692307692308 47.5C 45.06057692307692 47.5 47.18942307692308 42.5 49.67307692307693 42.5C 52.156730769230776 42.5 54.28557692307693 29.166666666666664 56.769230769230774 29.166666666666664C 59.252884615384616 29.166666666666664 61.38173076923077 46.666666666666664 63.86538461538462 46.666666666666664C 66.34903846153847 46.666666666666664 68.47788461538462 48.333333333333336 70.96153846153847 48.333333333333336C 73.44519230769231 48.333333333333336 75.57403846153846 35 78.0576923076923 35C 80.54134615384615 35 82.67019230769232 29.166666666666664 85.15384615384616 29.166666666666664C 87.6375 29.166666666666664 89.76634615384616 47.5 92.25 47.5C 92.25 47.5 92.25 47.5 92.25 50M 92.25 47.5z" pathFrom="M -1 50 L -1 50 L 7.096153846153847 50 L 14.192307692307693 50 L 21.28846153846154 50 L 28.384615384615387 50 L 35.48076923076923 50 L 42.57692307692308 50 L 49.67307692307693 50 L 56.769230769230774 50 L 63.86538461538462 50 L 70.96153846153847 50 L 78.0576923076923 50 L 85.15384615384616 50 L 92.25 50"></path><path id="SvgjsPath3184" d="M 0 47.5C 2.483653846153846 47.5 4.612500000000001 30.833333333333332 7.096153846153847 30.833333333333332C 9.579807692307693 30.833333333333332 11.708653846153847 49.166666666666664 14.192307692307693 49.166666666666664C 16.67596153846154 49.166666666666664 18.804807692307694 34.166666666666664 21.28846153846154 34.166666666666664C 23.772115384615386 34.166666666666664 25.90096153846154 47.5 28.384615384615387 47.5C 30.868269230769233 47.5 32.997115384615384 35.83333333333333 35.48076923076923 35.83333333333333C 37.96442307692308 35.83333333333333 40.09326923076924 47.5 42.57692307692308 47.5C 45.06057692307692 47.5 47.18942307692308 42.5 49.67307692307693 42.5C 52.156730769230776 42.5 54.28557692307693 29.166666666666664 56.769230769230774 29.166666666666664C 59.252884615384616 29.166666666666664 61.38173076923077 46.666666666666664 63.86538461538462 46.666666666666664C 66.34903846153847 46.666666666666664 68.47788461538462 48.333333333333336 70.96153846153847 48.333333333333336C 73.44519230769231 48.333333333333336 75.57403846153846 35 78.0576923076923 35C 80.54134615384615 35 82.67019230769232 29.166666666666664 85.15384615384616 29.166666666666664C 87.6375 29.166666666666664 89.76634615384616 47.5 92.25 47.5" fill="none" fill-opacity="1" stroke="#f1416c" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskbltige8k)" pathTo="M 0 47.5C 2.483653846153846 47.5 4.612500000000001 30.833333333333332 7.096153846153847 30.833333333333332C 9.579807692307693 30.833333333333332 11.708653846153847 49.166666666666664 14.192307692307693 49.166666666666664C 16.67596153846154 49.166666666666664 18.804807692307694 34.166666666666664 21.28846153846154 34.166666666666664C 23.772115384615386 34.166666666666664 25.90096153846154 47.5 28.384615384615387 47.5C 30.868269230769233 47.5 32.997115384615384 35.83333333333333 35.48076923076923 35.83333333333333C 37.96442307692308 35.83333333333333 40.09326923076924 47.5 42.57692307692308 47.5C 45.06057692307692 47.5 47.18942307692308 42.5 49.67307692307693 42.5C 52.156730769230776 42.5 54.28557692307693 29.166666666666664 56.769230769230774 29.166666666666664C 59.252884615384616 29.166666666666664 61.38173076923077 46.666666666666664 63.86538461538462 46.666666666666664C 66.34903846153847 46.666666666666664 68.47788461538462 48.333333333333336 70.96153846153847 48.333333333333336C 73.44519230769231 48.333333333333336 75.57403846153846 35 78.0576923076923 35C 80.54134615384615 35 82.67019230769232 29.166666666666664 85.15384615384616 29.166666666666664C 87.6375 29.166666666666664 89.76634615384616 47.5 92.25 47.5" pathFrom="M -1 50 L -1 50 L 7.096153846153847 50 L 14.192307692307693 50 L 21.28846153846154 50 L 28.384615384615387 50 L 35.48076923076923 50 L 42.57692307692308 50 L 49.67307692307693 50 L 56.769230769230774 50 L 63.86538461538462 50 L 70.96153846153847 50 L 78.0576923076923 50 L 85.15384615384616 50 L 92.25 50" fill-rule="evenodd"></path><g id="SvgjsG3181" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0"></g></g><g id="SvgjsG3182" class="apexcharts-datalabels" data:realIndex="0"></g></g><g id="SvgjsG3188" class="apexcharts-grid-borders" style="display: none;"></g><line id="SvgjsLine3202" x1="0" y1="0" x2="92.25" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine3203" x1="0" y1="0" x2="92.25" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG3204" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG3205" class="apexcharts-xaxis-texts-g" transform="translate(0, 4)"></g></g><g id="SvgjsG3221" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG3222" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG3223" class="apexcharts-point-annotations"></g></g></svg></div></div>
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                                <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end: Card Body-->
                                </div>
                                <!--end::Table widget 14-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row g-5 g-xl-10">
                            <!--begin::Col-->
                            <div class="col-xl-4">
                                <!--begin::Engage widget 1-->
                                <div class="card h-md-100" dir="ltr">
                                    <!--begin::Body-->
                                    <div class="card-body d-flex flex-column flex-center">
                                        <!--begin::Heading-->
                                        <div class="mb-2">
                                            <!--begin::Title-->
                                            <h1 class="fw-semibold text-gray-800 text-center lh-lg">Have your tried
                                            <br>new
                                            <span class="fw-bolder">Invoice Manager?</span></h1>
                                            <!--end::Title-->
                                            <!--begin::Illustration-->
                                            <div class="py-10 text-center">
                                                <img src="assets/media/svg/illustrations/easy/2.svg" class="theme-light-show w-200px" alt="">
                                                <img src="assets/media/svg/illustrations/easy/2-dark.svg" class="theme-dark-show w-200px" alt="">
                                            </div>
                                            <!--end::Illustration-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Links-->
                                        <div class="text-center mb-1">
                                            <!--begin::Link-->
                                            <a class="btn btn-sm btn-primary me-2" data-bs-target="#kt_modal_new_address" data-bs-toggle="modal">Try Now</a>
                                            <!--end::Link-->
                                            <!--begin::Link-->
                                            <a class="btn btn-sm btn-light" href="../../demo1/dist/apps/user-management/users/view.html">Learn More</a>
                                            <!--end::Link-->
                                        </div>
                                        <!--end::Links-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Engage widget 1-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-8">
                                <!--begin::Timeline Widget 4-->
                                <div class="card h-md-100">
                                    <!--begin::Card header-->
                                    <div class="card-header position-relative py-0 border-bottom-1">
                                        <!--begin::Card title-->
                                        <h3 class="card-title text-gray-800 fw-bold">Active Tasks</h3>
                                        <!--end::Card title-->
                                        <!--begin::Tabs-->
                                        <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-4" role="tablist">
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <a class="nav-link btn btn-color-gray-400 flex-center px-3 active" data-kt-timeline-widget-4="tab" data-bs-toggle="tab" href="#kt_timeline_widget_4_tab_day" aria-selected="true" role="tab">
                                                    <!--begin::Title-->
                                                    <span class="nav-text fw-semibold fs-4 mb-3">Day</span>
                                                    <!--end::Title-->
                                                    <!--begin::Bullet-->
                                                    <span class="bullet-custom position-absolute z-index-2 w-100 h-1px top-100 bottom-n100 bg-primary rounded"></span>
                                                    <!--end::Bullet-->
                                                </a>
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <a class="nav-link btn btn-color-gray-400 flex-center px-3" data-kt-timeline-widget-4="tab" data-bs-toggle="tab" href="#kt_timeline_widget_4_tab_week" aria-selected="false" tabindex="-1" role="tab">
                                                    <!--begin::Title-->
                                                    <span class="nav-text fw-semibold fs-4 mb-3">Week</span>
                                                    <!--end::Title-->
                                                    <!--begin::Bullet-->
                                                    <span class="bullet-custom position-absolute z-index-2 w-100 h-1px top-100 bottom-n100 bg-primary rounded"></span>
                                                    <!--end::Bullet-->
                                                </a>
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <a class="nav-link btn btn-color-gray-400 flex-center px-3" data-kt-timeline-widget-4="tab" data-bs-toggle="tab" href="#kt_timeline_widget_4_tab_month" aria-selected="false" tabindex="-1" role="tab">
                                                    <!--begin::Title-->
                                                    <span class="nav-text fw-semibold fs-4 mb-3">Month</span>
                                                    <!--end::Title-->
                                                    <!--begin::Bullet-->
                                                    <span class="bullet-custom position-absolute z-index-2 w-100 h-1px top-100 bottom-n100 bg-primary rounded"></span>
                                                    <!--end::Bullet-->
                                                </a>
                                            </li>
                                            <!--end::Nav item-->
                                            <!--begin::Nav item-->
                                            <li class="nav-item p-0 ms-0" role="presentation">
                                                <a class="nav-link btn btn-color-gray-400 flex-center px-3" data-kt-timeline-widget-4="tab" data-bs-toggle="tab" href="#kt_timeline_widget_4_tab_2022" aria-selected="false" tabindex="-1" role="tab">
                                                    <!--begin::Title-->
                                                    <span class="nav-text fw-semibold fs-4 mb-3">2022</span>
                                                    <!--end::Title-->
                                                    <!--begin::Bullet-->
                                                    <span class="bullet-custom position-absolute z-index-2 w-100 h-1px top-100 bottom-n100 bg-primary rounded"></span>
                                                    <!--end::Bullet-->
                                                </a>
                                            </li>
                                            <!--end::Nav item-->
                                        </ul>
                                        <!--end::Tabs-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pb-0">
                                        <!--begin::Tab content-->
                                        <div class="tab-content">
                                            <!--begin::Tab pane-->
                                            <div class="tab-pane active blockui" id="kt_timeline_widget_4_tab_day" role="tabpanel" aria-labelledby="day-tab" data-kt-timeline-widget-4-blockui="true" style="">
                                                <div class="table-responsive pb-10">
                                                    <!--begin::Timeline-->
                                                    <div id="kt_timeline_widget_4_1" class="vis-timeline-custom h-350px min-w-700px" data-kt-timeline-widget-4-image-root="assets/media/" style="position: relative;"><div class="vis-timeline vis-bottom vis-ltr" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); visibility: visible; height: 354px;"><div class="vis-panel vis-background" style="height: 354px; width: 769px; left: 0px; top: 0px;"></div><div class="vis-panel vis-background vis-vertical" style="height: 354px; width: 642px; left: 129px; top: 0px;"><div class="vis-axis" style="top: 304px; left: 0px;"><div class="vis-group"></div><div class="vis-group"></div><div class="vis-group"></div><div class="vis-group"></div></div><div class="vis-time-axis vis-background"><div class="vis-grid vis-vertical vis-minor vis-h10  vis-today  vis-even" style="width: 206.531px; height: 330px; transform: translate(-81.8166px, -1px);"></div><div class="vis-grid vis-vertical vis-minor vis-h11  vis-today  vis-odd" style="width: 206.531px; height: 330px; transform: translate(124.714px, -1px);"></div><div class="vis-grid vis-vertical vis-minor vis-h12  vis-today  vis-even" style="width: 206.531px; height: 330px; transform: translate(331.244px, -1px);"></div><div class="vis-grid vis-vertical vis-minor vis-h13  vis-today  vis-odd" style="width: 206.531px; height: 330px; transform: translate(537.775px, -1px);"></div></div></div><div class="vis-panel vis-background vis-horizontal" style="height: 305px; width: 769px; left: 0px; top: -1px;"></div><div class="vis-panel vis-center" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); height: 305px; width: 642px; left: 128px; top: -1px;"><div class="vis-content" style="left: 0px; transform: translateY(0px);"><div class="vis-itemset" style="height: 303px;"><div class="vis-background"><div class="vis-group" style="height: 0px;"><div style="visibility: hidden; position: absolute;"></div></div><div class="vis-group" style="height: 75px;"><div style="visibility: hidden; position: absolute;"></div></div><div class="vis-group" style="height: 75px;"><div style="visibility: hidden; position: absolute;"></div></div><div class="vis-group" style="height: 75px;"><div style="visibility: hidden; position: absolute;"></div></div><div class="vis-group" style="height: 78px;"><div style="visibility: hidden; position: absolute;"></div></div></div><div class="vis-foreground"><div class="vis-group" style="height: 75px;"><div class="vis-item vis-range vis-readonly" style="transform: translateX(11.2042px); width: 309.796px; top: 17.5px;"><div class="vis-item-overflow"><div class="vis-item-content" style="transform: translateX(0px);"><div class="rounded-pill bg-light-primary d-flex align-items-center position-relative h-40px w-100 p-2 overflow-hidden">
        <div class="position-absolute rounded-pill d-block bg-primary start-0 top-0 h-100 z-index-1" style="width:60%;"></div>

        <div class="d-flex align-items-center position-relative z-index-2">
            <div class="symbol-group symbol-hover flex-nowrap me-3">
                <div class="symbol symbol-circle symbol-25px"><img alt="" src="assets/media/avatars/300-6.jpg"></div><div class="symbol symbol-circle symbol-25px"><img alt="" src="assets/media/avatars/300-1.jpg"></div>
            </div>

            <a href="#" class="fw-bold text-white text-hover-dark">Meeting</a>
        </div>

        <div class="d-flex flex-center bg-body rounded-pill fs-7 fw-bolder ms-auto h-100 px-3 position-relative z-index-2">
            60%
        </div>
    </div>        
    </div></div><div class="vis-item-visible-frame"></div></div></div><div class="vis-group" style="height: 75px;"><div class="vis-item vis-range vis-readonly" style="transform: translateX(217.735px); width: 206.531px; top: 17.5px;"><div class="vis-item-overflow"><div class="vis-item-content" style="transform: translateX(0px);"><div class="rounded-pill bg-light-success d-flex align-items-center position-relative h-40px w-100 p-2 overflow-hidden">
        <div class="position-absolute rounded-pill d-block bg-success start-0 top-0 h-100 z-index-1" style="width:47%;"></div>

        <div class="d-flex align-items-center position-relative z-index-2">
            <div class="symbol-group symbol-hover flex-nowrap me-3">
                <div class="symbol symbol-circle symbol-25px"><img alt="" src="assets/media/avatars/300-2.jpg"></div>
            </div>

            <a href="#" class="fw-bold text-white text-hover-dark">Testing</a>
        </div>

        <div class="d-flex flex-center bg-body rounded-pill fs-7 fw-bolder ms-auto h-100 px-3 position-relative z-index-2">
            47%
        </div>
    </div>        
    </div></div><div class="vis-item-visible-frame"></div></div></div><div class="vis-group" style="height: 75px;"><div class="vis-item vis-range vis-readonly" style="transform: translateX(114.469px); width: 413.061px; top: 17.5px;"><div class="vis-item-overflow"><div class="vis-item-content" style="transform: translateX(0px);"><div class="rounded-pill bg-light-danger d-flex align-items-center position-relative h-40px w-100 p-2 overflow-hidden">
        <div class="position-absolute rounded-pill d-block bg-danger start-0 top-0 h-100 z-index-1" style="width:55%;"></div>

        <div class="d-flex align-items-center position-relative z-index-2">
            <div class="symbol-group symbol-hover flex-nowrap me-3">
                <div class="symbol symbol-circle symbol-25px"><img alt="" src="assets/media/avatars/300-5.jpg"></div><div class="symbol symbol-circle symbol-25px"><img alt="" src="assets/media/avatars/300-20.jpg"></div>
            </div>

            <a href="#" class="fw-bold text-white text-hover-dark">Landing page</a>
        </div>

        <div class="d-flex flex-center bg-body rounded-pill fs-7 fw-bolder ms-auto h-100 px-3 position-relative z-index-2">
            55%
        </div>
    </div>        
    </div></div><div class="vis-item-visible-frame"></div></div></div><div class="vis-group" style="height: 78px;"><div class="vis-item vis-range vis-readonly" style="transform: translateX(321px); width: 309.796px; top: 18px;"><div class="vis-item-overflow"><div class="vis-item-content" style="transform: translateX(0px);"><div class="rounded-pill bg-light-info d-flex align-items-center position-relative h-40px w-100 p-2 overflow-hidden">
        <div class="position-absolute rounded-pill d-block bg-info start-0 top-0 h-100 z-index-1" style="width:75%;"></div>

        <div class="d-flex align-items-center position-relative z-index-2">
            <div class="symbol-group symbol-hover flex-nowrap me-3">
                <div class="symbol symbol-circle symbol-25px"><img alt="" src="assets/media/avatars/300-23.jpg"></div><div class="symbol symbol-circle symbol-25px"><img alt="" src="assets/media/avatars/300-12.jpg"></div><div class="symbol symbol-circle symbol-25px"><img alt="" src="assets/media/avatars/300-9.jpg"></div>
            </div>

            <a href="#" class="fw-bold text-white text-hover-dark">Products module</a>
        </div>

        <div class="d-flex flex-center bg-body rounded-pill fs-7 fw-bolder ms-auto h-100 px-3 position-relative z-index-2">
            75%
        </div>
    </div>        
    </div></div><div class="vis-item-visible-frame"></div></div></div></div></div></div><div class="vis-shadow vis-top" style="visibility: hidden;"></div><div class="vis-shadow vis-bottom" style="visibility: hidden;"></div></div><div class="vis-panel vis-left" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); height: 305px; left: 0px; top: -1px;"><div class="vis-content" style="left: 0px; top: 0px;"><div class="vis-labelset"><div class="vis-label vis-group-level-0" title="" style="height: 75px;"><div class="vis-inner">Research</div></div><div class="vis-label vis-group-level-0" title="" style="height: 75px;"><div class="vis-inner">Phase 2.6 QA</div></div><div class="vis-label vis-group-level-0" title="" style="height: 75px;"><div class="vis-inner">UI Design</div></div><div class="vis-label vis-group-level-0" title="" style="height: 78px;"><div class="vis-inner">Development</div></div></div></div><div class="vis-shadow vis-top" style="visibility: hidden;"></div><div class="vis-shadow vis-bottom" style="visibility: hidden;"></div></div><div class="vis-panel vis-right" style="height: 305px; left: 770px; top: -1px;"><div class="vis-content" style="left: 0px; top: 0px;"></div><div class="vis-shadow vis-top" style="visibility: hidden;"></div><div class="vis-shadow vis-bottom" style="visibility: hidden;"></div></div><div class="vis-panel vis-top" style="width: 642px; left: 128px; top: 0px;"></div><div class="vis-panel vis-bottom" style="width: 642px; left: 128px; top: 304px;"><div class="vis-time-axis vis-foreground" style="height: 50px;"><div class="vis-text vis-minor vis-measure" style="position: absolute;">0</div><div class="vis-text vis-major vis-measure" style="position: absolute;">0</div><div class="vis-text vis-minor vis-h10  vis-today  vis-even" style="transform: translate(-81.3166px, 0px); width: 206.531px;">10:00</div><div class="vis-text vis-minor vis-h11  vis-today  vis-odd" style="transform: translate(125.214px, 0px); width: 206.531px;">11:00</div><div class="vis-text vis-minor vis-h12  vis-today  vis-even" style="transform: translate(331.744px, 0px); width: 206.531px;">12:00</div><div class="vis-text vis-major vis-h13  vis-today  vis-odd" style="transform: translate(0px, 25px);"><div>Fri 2 August</div></div><div class="vis-text vis-minor vis-h13  vis-today  vis-odd" style="transform: translate(538.275px, 0px); width: 206.531px;">13:00</div></div></div><div class="vis-rolling-mode-btn" style="visibility: hidden;"></div></div></div>
                                                    <!--end::Timeline-->
                                                </div>
                                            </div>
                                            <!--end::Tab pane-->
                                            <!--begin::Tab pane-->
                                            <div class="tab-pane blockui" id="kt_timeline_widget_4_tab_week" role="tabpanel" aria-labelledby="week-tab" data-kt-timeline-widget-4-blockui="true" style="overflow: hidden;">
                                                <div class="table-responsive pb-10">
                                                    <!--begin::Timeline-->
                                                    <div id="kt_timeline_widget_4_2" class="vis-timeline-custom h-350px min-w-700px" data-kt-timeline-widget-4-image-root="assets/media/"></div>
                                                    <!--end::Timeline-->
                                                </div>
                                            <div class="blockui-overlay bg-body" style="z-index: 1;"><span class="spinner-border text-primary"></span></div></div>
                                            <!--end::Tab pane-->
                                            <!--begin::Tab pane-->
                                            <div class="tab-pane blockui" id="kt_timeline_widget_4_tab_month" role="tabpanel" aria-labelledby="month-tab" data-kt-timeline-widget-4-blockui="true" style="overflow: hidden;">
                                                <div class="table-responsive pb-10">
                                                    <!--begin::Timeline-->
                                                    <div id="kt_timeline_widget_4_3" class="vis-timeline-custom h-350px min-w-700px" data-kt-timeline-widget-4-image-root="assets/media/"></div>
                                                    <!--end::Timeline-->
                                                </div>
                                            <div class="blockui-overlay bg-body" style="z-index: 1;"><span class="spinner-border text-primary"></span></div></div>
                                            <!--end::Tab pane-->
                                            <!--begin::Tab pane-->
                                            <div class="tab-pane blockui" id="kt_timeline_widget_4_tab_2022" role="tabpanel" aria-labelledby="week-tab" data-kt-timeline-widget-4-blockui="true" style="overflow: hidden;">
                                                <div class="table-responsive pb-10">
                                                    <!--begin::Timeline-->
                                                    <div id="kt_timeline_widget_4_4" class="vis-timeline-custom h-350px min-w-700px" data-kt-timeline-widget-4-image-root="assets/media/"></div>
                                                    <!--end::Timeline-->
                                                </div>
                                            <div class="blockui-overlay bg-body" style="z-index: 1;"><span class="spinner-border text-primary"></span></div></div>
                                            <!--end::Tab pane-->
                                        </div>
                                        <!--end::Tab content-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Timeline Widget 1-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Content container-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Content wrapper-->
            <!--begin::Footer-->
            <div id="kt_app_footer" class="app-footer">
                <!--begin::Footer container-->
                <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                    <!--begin::Copyright-->
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">2023©</span>
                        <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
                    </div>
                    <!--end::Copyright-->
                    <!--begin::Menu-->
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                        <li class="menu-item">
                            <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
                        </li>
                        <li class="menu-item">
                            <a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
                        </li>
                        <li class="menu-item">
                            <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
                        </li>
                    </ul>
                    <!--end::Menu-->
                </div>
                <!--end::Footer container-->
            </div>
            <!--end::Footer-->
        </div>
    @endcan

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Include ChartDataLabels plugin -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>

<script>
    // Prepare your data
    const data = @json($data);
    console.log(data);
    // Set up the chart
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Inactive','Active'],
            datasets: [{
                label: 'Projects Status',
                data: [data.inactive, data.active],
                backgroundColor: ['orange ','blue'],
                borderColor: ['#FFFFFF', '#FFFFFF'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 20,
                        padding: 15,
                        font: {
                            size: 10
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.label}: ${tooltipItem.raw} (${((tooltipItem.raw / (data.inactive + data.active)) * 100).toFixed(2)}%)`;
                        }
                    }
                },
                datalabels: {
                    color: '#000000',
                    
                    align: 'bottom',
                   
                    font: {
                        weight: 'bold'
                    }
                }
            }
        },
        plugins: [ChartDataLabels] // Include ChartDataLabels plugin if needed
    });

    // Load the ChartDataLabels plugin if it's not already included
    if (!Chart.plugins.getAll().some(plugin => plugin.id === 'datalabels')) {
        const ChartDataLabels = (function() {
            // Data Labels plugin code here or include via CDN
            // You can find the ChartDataLabels plugin at: https://github.com/chartjs/chartjs-plugin-datalabels
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js';
            script.onload = function() {
                Chart.register(ChartDataLabels);
            };
            document.head.appendChild(script);
        })();
    }
</script>
@endpush
</x-default-layout>
