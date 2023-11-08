<x-nform-layout>
    @section('title')
        Create Monitoring Quality Benchmarks
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
       
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                <form class="form" id="qb_form"  novalidate="novalidate" data-kt-redirect-url="{{ route('quality-benchs.index') }}" action="{{ route('quality-benchs.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="fv-row col-sm-3 col-md-3 col-lg-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">QB Filled By</span>
                                </label>
                                <input type="text" class="form-control" id="qb_filledby"  name="qb_filledby" value="" placeholder="Enter Filled By">
                              
                                <div id="qb_filledbyError" class="error-message"></div>
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
                            <div class="fv-row col-sm-3 col-md-3 col-lg-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Sub Theme</span>
                                </label>
                                <input type="text" class="form-control" id="sub_theme"  name="sub_theme" value="" placeholder="Enter Sub-theme">
                              
                                <div id="sub_themeError" class="error-message"></div>
                            </div>
                            <div class="fv-row col-sm-3 col-md-3 col-lg-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Project</span>
                                </label>
                                <select   name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Theme" class="form-select">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach
                                </select>
                                <div id="project_nameError" class="error-message "></div>
                            </div>
                          
                           
                        </div>
                        <div class="row mt-3">
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Province</span>
                                </label>
                                <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select ">
                                    @if(auth()->user()->permissions_level == 'province-wide' || auth()->user()->permissions_level == 'district-wide')
                                    <option value="">Select Province</option>
                                    {{-- <option value='1'>Punjab</option> --}}
                                    <option @if(auth()->user()->province == '4') selected @endif value='4'>Sindh</option>
                                    <option  @if(auth()->user()->province == '2') selected @endif value='2'>KPK</option>
                                    <option   @if(auth()->user()->province == '3') selected @endif value='3'>Balochistan</option>
                                    @else
                                    <option value="">Select Province</option>
                                    {{-- <option value='1'>Punjab</option> --}}
                                    <option value='4'>Sindh</option>
                                    <option  value='2'>KPK</option>
                                    <option value='3'>Balochistan</option>
                                    @endif
                                </select>
                                <div id="kt_select2_provinceError" class="error-message "></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">District</span>
                                </label>
                                <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select ">

                                </select>
                                <div id="kt_select2_districtError" class="error-message "></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Tehsil</span>
                                </label>
                                <select id="kt_select2_tehsil" name="tehsil" aria-label="Select a Tehsil" data-control="select2" data-placeholder="Select a Tehsil..." class="form-select ">

                                </select>
                                <div id="kt_select2_tehsilError" class="error-message "></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">UC</span>
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
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Project Type</span>
                                </label>
                                <select name="project_type" id="project_type" aria-label="Select a Project Type" data-control="select2" data-placeholder="Select a Project Type" class="form-select">
                                    <option value="">Select Project Type</option>
                                    <option value="Humanitarian">Humanitarian</option>
                                    <option value="Development">Development</option>
                                </select>
                                <div id="project_typeError" class="error-message "></div>
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
                            <div class="fv-row col-sm-3 col-md-3 col-lg-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Partner</span>
                                </label>
                                <select   name="partner" id="partner" aria-label="Select a Partner Name" data-control="select2" data-placeholder="Select a Partner" class="form-select">
                                    <option value="">Select Partner Name</option>
                                    <option  value="LRF" >LRF</option>
                                    <option  value="NRSP" >NRSP</option>
                                    <option  value="PPHI" >PPHI</option>
                                    <option  value="SRSP" >SRSP</option>
                                    <option  value="TKF" >TKF</option>
                                </select>
                                <div id="partnerError" class="error-message "></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="fv-row col-md-4">
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
                            <div class="fv-row col-md-4">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Accompanied By</span>
                                </label>
                                <select name="accompanied_by" id="accompanied_by" aria-label="Select a Registrar Name" data-control="select2" data-placeholder="Select a Accompanied By..." class="form-select ">
                                    <option value="">Select Option</option>
                                    <option value="Project Staff">Project Staff</option>
                                    <option value="Govt Officials">Govt Officials</option>
                                    <option  value="Donor">Donor</option>
                                    <option  value="NA">NA</option>
                                </select>
                                <div id="accompanied_byError" class="error-message"></div>
                            </div>
                            <div class="fv-row col-md-4">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Activity visited</span>
                                </label>
                                <textarea  rows="1" class="form-control" id="activity_description"  name="activity_description"></textarea>
                                <div id="activity_descriptionError" class="error-message"></div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Date of monitoring visit </span>
                                </label>
                                <input type="text" name="date_visit" id="date_visit" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="" required>
                                <div id="date_visitError" class="error-message"></div>
                            </div>
                            <div class="fv-row col-sm-3 col-md-1 col-lg-1">
                                <label class="fs-9 fw-semibold form-label mb-2">
                                    <span class="required">Total QBs</span>
                                </label>
                                <input type="text" class="form-control" id="total_qbs"  name="total_qbs" value="">
                                <div id="total_qbsError" class="error-message"></div>
                            </div>
                            <div class="fv-row col-md-1">
                                <label class="fs-9 fw-semibold form-label mb-2">
                                    <span class="required">Fully Met</span>
                                </label>
                                <input type="text" class="form-control" id="qbs_fully_met" name="qbs_fully_met" value="">
                                <div id="qbs_fully_metError" class="error-message"></div>
                            </div>
                            <div class="fv-row col-md-1">
                                <label class="fs-9 fw-semibold form-label mb-2">
                                    <span class="required">Not Applicable</span>
                                </label>
                                <input type="text" class="form-control" name="qb_not_applicable" id="qb_not_applicable" value="">
                                <div id="qb_not_applicableError" class="error-message"></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Visit Staff Name</span>
                                </label>
                                <select name="visit_staff_name" id="visit_staff_name" aria-label="Select a Visit Staff Name" data-control="select2" data-placeholder="Select a Registrar Name..." class="form-select ">
                                    <option  value="">Select Option</option>
                                    @foreach($users as $user)
                                    <option  value="{{$user->name}}" >{{$user->name}}</option>
                                    @endforeach
                                    <option  value="Ruqaiya Bibi" >Ruqaiya Bibi</option>
                                    <option  value="Mehnaz" >Mehnaz</option>
                                    <option  value="Musarrat Bibi" >Musarrat Bibi</option>
                                    <option  value="Shaista Mir" >Shaista Mir</option>
                                    <option  value="Shama" >Shama</option>
                                    <option  value="Zahid Ali Khan" >Zahid Ali Khan</option>
                                </select>
                                <div id="visit_staff_nameError" class="error-message"></div>
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
                        <div class="separator my-10"></div>
                        
                        <div class="text-center pt-15">
                            <button type="submit" id="kt_qb_submit" class="btn btn-primary">
                                @include('partials/general/_button-indicator', ['label' => 'Submit'])
                            </button>
                            
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
   
  


    @endpush

</x-nform-layout>
