<x-nform-layout>
    @section('title')
        Add Monitoring Visit
    @endsection
    <style>
        .square-switch {
            position: relative;
            margin: 0 auto;
            display: inline-block;
            width: 400px;
            height: 36px;
            border: 1px solid #ccc;
            border-radius: 40px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            background-color: #fff;
            border-radius: 80px;
        }
        .slider:before, .slider:after {
            position: absolute;
            height: 34px;
            width: 200px;
            bottom: 1px;
            background-color: #fff;
            color: #333;
            text-align: center;
            line-height: 34px;
            transition: .60s;
            border-radius: 80px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-weight: 500;
        }
        .slider:before {
            content: "Non QB Base Monitoring";
            
        }
        .slider:after {
            content: "QB Base Monitoring";
            right: 1px;
        }
        input:checked + .slider:before {
            background-color:transparent;
            color: #333;
            width: 215px;
        }
        input:checked + .slider:after {
            background-color: #333;
            color: #fff;
        }
        input:not(:checked) + .slider:before {
           
            background-color: #333;
            color: #fff;
        }
        input:not(:checked) + .slider:after {
           

            background-color:transparent;
            color: #333;
            width: 220px;
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
                                        <input type="checkbox" id="toggleSwitch" name="qb_base" checked>
                                        <span class="slider round"></span>
                                    </label>
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
                                <input readonly class="form-control" name="project_type" id="project_type" >
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

                            <div class="fv-row mb-3 col-md-6">
                                <label for="activity_description" class="form-label"><span class="required">Activity visited</span></label>
                                <textarea class="form-control" rows="1" name="activity_description" id="activity_description"></textarea>
                                <div id="activity_descriptionError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-2 qb_base_div ">
                                <label for="total_qbs" class="form-label fs-7"><span class="required">Total QBs</span></label>
                                <input type="text" class="form-control" name="total_qbs" id="total_qbs">
                                <div id="total_qbsError" class="error-message"></div>
                            </div>

                            <div class="fv-row mb-3 col-md-2 qb_base_div ">
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
                                <label for="qb_filledby" class="form-label"><span class="required">Visited By</span></label>
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
                    // QB Base Monitoring is on
                    $(".qb_base_div input").prop('disabled', false);
                } else {
                    // QB Base Monitoring is off
                    $(".qb_base_div input").prop('disabled', true);
                }
            });
    
        });
    </script>
    @endpush
</x-nform-layout>
