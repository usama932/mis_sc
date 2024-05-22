<x-nform-layout>
    @section('title')
        Add Monitoring Visit
    @endsection
    <style>
        .error-message {
           color: red;
           font-size: 12px;
           margin-top: 5px;
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
                <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Summary</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" data-bs-toggle="tab" href="#kt_tab_pane_2" >QBs Not Fully Met</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" data-bs-toggle="tab" href="#kt_tab_pane_3">Action Point Details</a>
            </li>
			<li class="nav-item">
                <a class="nav-link disabled" data-bs-toggle="tab" href="#kt_tab_pane_4">Comments and Attachment</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                <form class="form" id="qb_form"  novalidate="novalidate" data-kt-redirect-url="{{ route('quality-benchs.index') }}" action="{{ route('quality-benchs.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
						    <div class="fv-row col-md-3 ">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Project</span>
                                </label>
                                <select   name="project_name" id="project_name" aria-label="Select Project" data-control="select2" data-placeholder="Select Project" class="form-select">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach
                                </select>
                                <div id="project_nameError" class="error-message "></div>
                            </div>
						    <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                    <span class="required">Project Type</span>
                                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="projectloader"></span>
                                </label>
                                <input type="text" name="project_type" id="project_type" class="form-control" />
                              
                                <div id="project_typeError" class="error-message "></div>
                            </div>
							<div class="fv-row col-sm-3 col-md-3 col-lg-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Partner</span>
                                  
                                </label>
                                <select   name="partner" id="partner" aria-label="Select a Partner Name" data-control="select2" data-placeholder="Select a Partner" class="form-select">
                                    <option value="">Select Partner Name</option>
                                    @foreach($partners as $partner)
                                    <option value="{{$partner->id}}">{{$partner->slug}}</option>
                                    @endforeach
                                </select>
                                
                                <div id="partnerError" class="error-message "></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">QB Monitor Visit</span>                           
                                </label>
                                <div class="foallow_contactrm-check form-check-custom form-check-solid mt-4">
                                    <!--begin::Input-->
                                    <input class="form-check-input qb_base" name="qb_base" id="allow_qb_base_yes" type="radio" value="Yes"/ checked>
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label me-5">
                                        <div class="fw-bold text-gray-800 ">Yes</div>
                                    </label>
                                    <input class="form-check-input qb_base" name="qb_base" id="allow_qb_base_no"  id="qb_base" type="radio" value="No"/ required>
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label me-5">
                                        <div class="fw-bold text-gray-800">No</div>
                                    </label>
                                    <!--end::Label-->
                                   
                                </div>
                                <div id="allow_contactError" class="error-message "></div>
                            </div>
                        </div>
                      
                        <div class="row mt-3">
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Province</span>
                                </label>
                                <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select ">
                                
                                    <option value="">Select Province</option>
                                    {{-- <option value='1'>Punjab</option> --}}
                                    <option value="">Select Province</option>
                                    <option value='4'>Sindh</option>
                                    <option  value='2'>KPK</option>
                                    <option value='3'>Balochistan</option>
                                 
                                </select>
                                <div id="kt_select2_provinceError" class="error-message "></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                    <span class="required">District</span>
                                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
                                </label>
                                <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select ">

                                </select>
                                <div id="kt_select2_districtError" class="error-message "></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                    <span class="required">Tehsil</span>
                                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="tehsilloader"></span>
                                </label>
                                <select id="kt_select2_tehsil" name="tehsil" aria-label="Select a Tehsil" data-control="select2" data-placeholder="Select a Tehsil..." class="form-select ">

                                </select>
                                <div id="kt_select2_tehsilError" class="error-message "></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                    <span class="required">UC</span>
                                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="ucloader"></span>
                                </label>
                                <select id="kt_select2_union_counsil" name="union_counsil" aria-label="Select a UC" data-control="select2" data-placeholder="Select a Uc..." class="form-select ">

                                </select>
                                <div id="kt_select2_union_counsilError" class="error-message "></div>
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Village</span>
                                </label>
                                <input class="form-control" id="vilage" placeholder="Enter Village" name="village" value="">
                                <div id="villageError" class="error-message "></div>
                            </div>
							<div class="fv-row col-sm-3 col-md-3 col-lg-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Theme</span>
                                </label>
                                <select name="theme" id="theme" aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme" class="form-select">
                                    <option value="">Select Theme</option>
                                    @foreach($themes as $theme)
                                        <option value="{{$theme->id}}">{{$theme->name}}</option>
                                    @endforeach
                                </select>
                                <div id="themeError" class="error-message"></div>
                            </div>
							<div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Type of visit</span>
                                </label>
                                <select   name="type_of_visit" id="type_of_visit"  aria-label="Select a Type of Visit " data-control="select2" data-placeholder="Select a Type of Visit" class="form-select">
                                    <option value="">Select Project Type</option>
                                    <option value="Independent">Independent</option>
                                    <option value="Joint">Joint</option>
                                </select>
                                <div id="type_of_visitError" class="error-message "></div>
                            </div>
							<div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Accompanied By</span>
                                </label>
                                <select name="accompanied_by" id="accompanied_by" aria-label="Select a Registrar Name" data-control="select2" data-placeholder="Select a Accompanied By..." class="form-select ">
                                    
                                </select>
                                <div id="accompanied_byError" class="error-message"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Monitoring Type</span>
                                </label>
                                <select   name="monitoring_type" id="monitoring_type"  aria-label="Select a Type of Visit " data-control="select2" data-placeholder="Select a Monitoring Type" class="form-select">
                                    <option value="">Select Monitoring Type</option>
                                    <option value="Process and output monitoring">Process and output monitoring</option>
                                    <option value="Distribution">Distribution</option>
                                    <option value="Joint outcome monitoring">Joint outcome monitoring</option>
                                </select>
                                <div id="monitoring_typeError" class="error-message"></div>
                            </div>
                            <div class="fv-row col-md-6">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Activity visited</span>
                                </label>
                                <textarea  rows="1" class="form-control" id="activity_description"  name="activity_description"></textarea>
                                <div id="activity_descriptionError" class="error-message"></div>
                            </div>
							<div class="fv-row col-sm-3 col-md-1 col-lg-1 qb_base_div ">
                                <label class="fs-9 fw-semibold form-label mb-2">
                                    <span class="required">Total QBs</span>
                                </label>
                                <input type="text" class="form-control " id="total_qbs"  name="total_qbs" value="">
                                <div id="total_qbsError" class="error-message"></div>
                            </div>
                            <div class="fv-row col-md-1 qb_base_div">
                                <label class="fs-9 fw-semibold form-label mb-2">
                                    <span class="required">Fully Met</span>
                                </label>
                                <input type="text" class="form-control" id="qbs_fully_met" name="qbs_fully_met" value="">
                                <div id="qbs_fully_metError" class="error-message"></div>
                            </div>
                            <div class="fv-row col-md-1 qb_base_div">
                                <label class="fs-9 fw-semibold form-label mb-2">
                                    <span class="required">Not Applicable</span>
                                </label>
                                <input type="text" class="form-control" name="qb_not_applicable" id="qb_not_applicable" value="">
                                <div id="qb_not_applicableError" class="error-message"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Date of monitoring visit  </span>
                                </label>
                                <input type="text" name="date_visit" id="date_visit" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="" required>
                                <div id="date_visitError" class="error-message"></div>
                            </div>
							<div class="fv-row col-sm-3 col-md-3 col-lg-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">QB Filled By</span>
                                </label>
                                <input type="text" class="form-control" id="qb_filledby"  name="qb_filledby" value="" placeholder="Enter Filled By">
                              
                                <div id="qb_filledbyError" class="error-message"></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Staff Organization</span>
                                </label>
                                <select name="staff_organization" id="staff_organization" aria-label="Select a Visit Staff Name" data-control="select2" data-placeholder="Select a Registrar Name..." class="form-select " >
                                    <option  value="">Select Option</option>
                                    <option  value="SC Staff" >SC Staff</option>
                                    <option  value="SRSP Staff" >SRSP Staff</option>
                                    <option  value="LRF Staff" >LRF Staff</option>
                                    <option  value="TKF Staff" >TKF Staff</option>
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
        var mindate ='{{$record->qb_close_upto}}';

        $('#date_visit').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d",
            maxDate: new Date().fp_incr(+0),
            minDate: new Date("2024-04-01"),
        });
        $(document).ready(function(){
        $('.qb_base').click(function(){
            
            var demo = $(this).val();
            if(demo == "Yes"){
                $(".qb_base_div").show();
            }
            else{
                $(".qb_base_div").hide();
            }
        });
        });
    </script>
    @endpush

</x-nform-layout>
