<x-nform-layout>
    @section('title')
        Add Monitoring Visit
    @endsection
    <style>
         .square-switch {
            position: relative;
            display: inline-block;
            width: 100px;
            height: 34px;
        }
        .square-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
        }
        .slider:before {
            position: absolute;
            content: "OFF";
            height: 34px;
            width: 50px;
            left: 0;
            bottom: 0;
            background-color: white;
            color: black;
            text-align: center;
            line-height: 34px;
            transition: .4s;
        }
        input:checked + .slider {
            background-color: #2196F3;
        }
        input:checked + .slider:before {
            transform: translateX(50px);
            content: "ON";
            background-color: #2196F3;
            color: white;
        }
        .slider.round {
            border-radius: 0;
        }
        .slider.round:before {
            border-radius: 0;
        }
        .fade-text {
            opacity: 0.3;
            transition: opacity 0.5s;
        }
        .visible-text {
            opacity: 1;
            transition: opacity 0.5s;
        }
        .switch-container {
            display: flex;
            align-items: center;
        }
    </style>
    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
   
        <ul class="nav nav-tabs mt-1 fs-6">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#summary">Summary</a>
            </li>
            <li class="nav-item qb_base_div">
                <a class="nav-link disabled" data-bs-toggle="tab" href="#qbs-not-fully-met">QBs Not Fully Met</a>
            </li>
            <li class="nav-item qb_base_div">
                <a class="nav-link disabled" data-bs-toggle="tab" href="#action-point-details">Action Point Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" data-bs-toggle="tab" href="#comments-attachments">Comments and Attachment</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="summary" role="tabpanel">
                <form class="form" id="qb_form" novalidate="novalidate" data-kt-redirect-url="{{ route('quality-benchs.index') }}" action="{{ route('quality-benchs.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                           
                            <div class="col-md-12">
                                <div class="mb-5 switch-container">
                                    <label class="square-switch">
                                        <input type="checkbox" id="toggleSwitch" name="qb_base" onchange="toggleText()" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    <h3 id="monitoringText" class="fade-text ms-3 required">QB Base Monitoring</h3>
                                </div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="project_name" class="form-label"><span class="required">Project</span></label>
                                <select class="form-select" name="project_name"  data-control="select2" id="project_name" aria-label="Select Project">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach
                                </select>
                                <div id="project_nameError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="project_type" class="form-label d-flex">
                                    <span class="required">Project Type</span>
                                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="projectloader"></span>
                                </label>
                                <input type="text" class="form-control" name="project_type" id="project_type">
                                <div id="project_typeError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="partner" class="form-label"><span class="required">Partner</span></label>
                                <select class="form-select" name="partner" id="partner" aria-label="Select a Partner Name"  data-control="select2">
                                    <option value="">Select Partner Name</option>
                                    @foreach($partners as $partner)
                                    <option value="{{$partner->id}}">{{$partner->slug}}</option>
                                    @endforeach
                                </select>
                                <div id="partnerError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="monitoring_type" class="form-label"><span class="required">Monitoring Type</span></label>
                                <select class="form-select" name="monitoring_type" id="monitoring_type"   data-control="select2" aria-label="Select a Type of Visit">
                                    <option value="">Select Monitoring Type</option>
                                    <option value="Process and output monitoring">Process and output monitoring</option>
                                    <option value="Distribution">Distribution</option>
                                    <option value="Joint outcome monitoring">Joint outcome monitoring</option>
                                </select>
                                <div id="monitoring_typeError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="kt_select2_province" class="form-label"><span class="required">Province</span></label>
                                <select class="form-select"  data-control="select2" name="province" id="kt_select2_province" aria-label="Select a Province">
                                    <option value="">Select Province</option>
                                    <option value='4'>Sindh</option>
                                    <option value='2'>KPK</option>
                                    <option value='3'>Balochistan</option>
                                </select>
                                <div id="kt_select2_provinceError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="kt_select2_district" class="form-label d-flex">
                                    <span class="required">District</span>
                                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
                                </label>
                                <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select "></select>
                                <div id="kt_select2_districtError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="kt_select2_tehsil" class="form-label d-flex">
                                    <span class="required">Tehsil</span>
                                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="tehsilloader"></span>
                                </label>
                                <select id="kt_select2_tehsil" name="tehsil" aria-label="Select a Tehsil" data-control="select2" data-placeholder="Select a Tehsil..." class="form-select "></select>
                                <div id="kt_select2_tehsilError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="kt_select2_union_counsil" class="form-label d-flex">
                                    <span class="required">UC</span>
                                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="ucloader"></span>
                                </label>
                                <select id="kt_select2_union_counsil" name="union_counsil" aria-label="Select a UC" data-control="select2" data-placeholder="Select a Uc..." class="form-select "></select>
                                <div id="kt_select2_union_counsilError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="village" class="form-label"><span class="required">Village</span></label>
                                <input type="text" class="form-control" name="village" id="village" placeholder="Enter Village">
                                <div id="villageError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="theme" class="form-label"><span class="required">Theme</span></label>
                                <select class="form-select" name="theme" id="theme" aria-label="Select a Theme"  data-control="select2">
                                    <option value="">Select Theme</option>
                                    @foreach($themes as $theme)
                                    <option value="{{$theme->id}}">{{$theme->name}}</option>
                                    @endforeach
                                </select>
                                <div id="themeError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="type_of_visit" class="form-label"><span class="required">Type of Visit</span></label>
                                <select class="form-select" name="type_of_visit" id="type_of_visit" aria-label="Select a Type of Visit"  data-control="select2">
                                    <option value="">Select Project Type</option>
                                    <option value="Independent">Independent</option>
                                    <option value="Joint">Joint</option>
                                </select>
                                <div id="type_of_visitError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="accompanied_by" class="form-label"><span class="required">Accompanied By</span></label>
                                <select class="form-select form-control" name="accompanied_by"  data-placeholder="Select a Accompanied By..."   data-control="select2" id="accompanied_by" aria-label="Select a Registrar Name"></select>
                                <div id="accompanied_byError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-5">
                                <label for="activity_description" class="form-label"><span class="required">Activity visited</span></label>
                                <textarea class="form-control" rows="1" name="activity_description" id="activity_description"></textarea>
                                <div id="activity_descriptionError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-1 qb_base_div ">
                                <label for="total_qbs" class="form-label fs-7"><span class="required">Total QBs</span></label>
                                <input type="text" class="form-control" name="total_qbs" id="total_qbs">
                                <div id="total_qbsError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-1 qb_base_div ">
                                <label for="qbs_fully_met" class="form-label fs-7"><span class="required">Fully Met</span></label>
                                <input type="text" class="form-control" name="qbs_fully_met" id="qbs_fully_met">
                                <div id="qbs_fully_metError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-2 qb_base_div ">
                                <label for="qb_not_applicable" class="form-label fs-7"><span class="required">Not Applicable</span></label>
                                <input type="text" class="form-control" name="qb_not_applicable" id="qb_not_applicable">
                                <div id="qb_not_applicableError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="date_visit" class="form-label"><span class="required">Date of Monitoring Visit</span></label>
                                <input type="text" class="form-control" name="date_visit" id="date_visit" placeholder="Select date" required>
                                <div id="date_visitError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="qb_filledby" class="form-label"><span class="required">QB Filled By</span></label>
                                <input type="text" class="form-control" name="qb_filledby" id="qb_filledby" placeholder="Enter Filled By">
                                <div id="qb_filledbyError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-3">
                                <label for="staff_organization" class="form-label"><span class="required">Staff Organization</span></label>
                                <select class="form-select" name="staff_organization" id="staff_organization" aria-label="Select a Visit Staff Name"  data-control="select2">
                                    <option value="">Select Option</option>
                                    <option value="SC Staff">SC Staff</option>
                                    <option value="SRSP Staff">SRSP Staff</option>
                                    <option value="LRF Staff">LRF Staff</option>
                                    <option value="TKF Staff">TKF Staff</option>
                                </select>
                                <div id="staff_organizationError" class="error-message"></div>
                            </div>
                        </div>
                        <div class="separator my-3"></div>
                        <div class="text-end">
                            <button type="submit" id="kt_qb_submit" class="btn btn-primary">
                                @include('partials/general/_button-indicator', ['label' => 'Continue'])
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
          function toggleText() {
            const checkbox = document.getElementById('toggleSwitch');
            const text = document.getElementById('monitoringText');
            if (checkbox.checked) {
                text.classList.remove('fade-text');
                text.classList.add('visible-text');
            } else {
                text.classList.remove('visible-text');
                text.classList.add('fade-text');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            var mindate = '{{$record->qb_close_upto}}';

            $('#date_visit').flatpickr({
                altInput: true,
                dateFormat: "Y-m-d",
                maxDate: new Date().fp_incr(+0),
                minDate: new Date("2024-04-01"),
            });

            $('#toggleSwitch').change(function() {
                if ($(this).is(':checked')) {
                    $(".qb_base_div").show('1000');
                } else {
                    $(".qb_base_div").hide('1000');
                }
            });

            // Placeholder for loading dynamic select options for district, tehsil, etc.
            // Add your AJAX calls here to populate the dependent select boxes

        });
    </script>
    @endpush
</x-nform-layout>
