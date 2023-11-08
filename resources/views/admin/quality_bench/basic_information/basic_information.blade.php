
<div>
    <form  class="form" id="qb_update_form"  novalidate="novalidate" action="{{route('quality-benchs.update',$qb->id)}}" method="post">
       
    @csrf
    @method('put')
    <div class="card-body py-4">
        {{-- <div class="card-title  border-0 my-4"">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                    <h5 class="fw-bold m-3">Basic Information::</h5>
                </div>
            </div>
        </div> --}}
        
        <div class="row">
            <div class="fv-row col-sm-3 col-md-3 col-lg-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">QB Filled By</span>
                </label>
                <input type="text" class="form-control" id="qb_filledby"  name="qb_filledby" value="{{$qb->qb_filledby ?? ''}}">
              
                <div id="qb_filledbyError" class="error-message"></div>
            </div>
            <div class="fv-row col-sm-3 col-md-3 col-lg-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Theme</span>
                </label>
                <select name="theme" id="theme" aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme" class="form-select">
                    <option value="">Select Theme</option>
                    @foreach($themes as $theme)
                        <option value="{{$theme->id}}" @if($qb->theme == $theme->id) selected @endif >{{$theme->name}}</option>
                    @endforeach
                </select>
                <div id="themeError" class="error-message"></div>
            </div>
            <div class="fv-row col-sm-3 col-md-3 col-lg-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Sub Theme</span>
                </label>
                <input type="text" class="form-control" id="sub_theme"  name="sub_theme" value="{{$qb->sub_theme ?? ''}}" placeholder="Enter Sub-theme">            
                <div id="sub_themeError" class="error-message"></div>
            </div>
            <div class="fv-row col-sm-3 col-md-3 col-lg-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Project</span>
                </label>
                <select name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Theme" class="form-select">
                    <option value="">Select Project</option>
                    @foreach($projects as $project)
                    <option value="{{$project->id}}" @if($qb->project_name == $project->id) selected @endif>{{$project->name}}</option>
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
                        <option @if($qb->province == '4') selected @endif value='4'>Sindh</option>
                        <option  @if($qb->province == '2') selected @endif value='2'>KPK</option>
                        <option   @if($qb->province == '3') selected @endif value='3'>Balochistan</option>
                    @endif
                </select>
                <div id="kt_select2_provinceError" class="error-message "></div>
            </div>
            <div class="fv-row col-md-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">District</span>
                </label>
                <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select">
                    <option value="{{$qb->district}}">{{$qb->districts?->district_name ?? $frm->district}}</option>
                </select>
                <div id="kt_select2_districtError" class="error-message "></div>
            </div>
            <div class="fv-row col-md-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Tehsil</span>
                </label>
                <select id="kt_select2_tehsil" name="tehsil" aria-label="Select a Tehsil" data-control="select2" data-placeholder="Select a Tehsil..." class="form-select ">
                    @if(!empty($qb->tehsil))
                        <option value="{{$qb->tehsil}}">{{$qb->tehsils?->tehsil_name ?? $qb->tehsil }}</option>
                    @endif
                </select>
                <div id="kt_select2_tehsilError" class="error-message "></div>
            </div>
            <div class="fv-row col-md-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">UC</span>
                </label>
                <select id="kt_select2_union_counsil" name="union_counsil" aria-label="Select a UC" data-control="select2" data-placeholder="Select a Uc..." class="form-select">
                    @if(!empty($qb->union_counsil))
                        <option value="{{$qb->union_counsil}}">{{$qb->uc?->uc_name ?? $frm->union_counsil}}</option>
                    @endif
                </select>
                <div id="kt_select2_union_counsilError" class="error-message "></div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="fv-row col-md-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Village</span>
                </label>
                <input class="form-control" id="vilage" placeholder="Enter Village" name="village" value="{{$qb->village ?? ''}}">
                <div id="villageError" class="error-message "></div>
            </div>
            <div class="fv-row col-md-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Project Type</span>
                </label>
                <select name="project_type" id="project_type" aria-label="Select a Project Type" data-control="select2" data-placeholder="Select a Project Type" class="form-select">
                    <option value="">Select Project Type</option>
                    <option value="Humanitarian" @if($qb->project_type == "Humanitarian") selected @endif>Humanitarian</option>
                    <option value="Development"  @if($qb->project_type == "Development") selected @endif>Development</option>
                </select>
                <div id="project_typeError" class="error-message "></div>
            </div>
            <div class="fv-row col-md-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Type of visit</span>
                </label>
                <select   name="type_of_visit" id="type_of_visit"  aria-label="Select a Type of Visit " data-control="select2" data-placeholder="Select a Type of Visit" class="form-select">
                    <option value="">Select Project Type</option>
                    <option value="Independent" @if($qb->type_of_visit == "Independent") selected @endif>Independent</option>
                    <option value="Joint" @if($qb->type_of_visit == "Joint") selected @endif>Joint</option>
                </select>
                <div id="type_of_visitError" class="error-message "></div>
            </div>
            <div class="fv-row col-sm-3 col-md-3 col-lg-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Partner</span>
                </label>
                <select   name="partner" id="partner" aria-label="Select a Partner Name" data-control="select2" data-placeholder="Select a Partner" class="form-select">
                    <option value="">Select Partner Name</option>
                    <option  value="LRF"  @if($qb->partner == "LRF") selected @endif>LRF</option>
                    <option  value="NRSP" @if($qb->partner == "NRSP") selected @endif>NRSP</option>
                    <option  value="PPHI" @if($qb->partner == "PPHI") selected @endif>PPHI</option>
                    <option  value="SRSP" @if($qb->partner == "SRSP") selected @endif>SRSP</option>
                    <option  value="TKF"  @if($qb->partner == "TKF") selected @endif>TKF</option>
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
                    <option value="Process and output monitoring"  @if($qb->monitoring_type == "Process and output monitoring") selected @endif>Process and output monitoring</option>
                    <option value="Distribution" @if($qb->monitoring_type == "Distribution") selected @endif>Distribution</option>
                    <option value="Joint outcome monitoring" @if($qb->monitoring_type == "Joint outcome monitoring") selected @endif>Joint outcome monitoring</option>
                </select>
                <div id="monitoring_typeError" class="error-message"></div>
            </div>
            <div class="fv-row col-md-4">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Accompanied By</span>
                </label>
                <select name="accompanied_by" id="accompanied_by" aria-label="Select a Registrar Name" data-control="select2" data-placeholder="Select a Accompanied By..." class="form-select">
                    <option value="">Select Option</option>
                    <option value="Project Staff" @if($qb->accompanied_by == "Project Staff") selected @endif>Project Staff</option>
                    <option value="Govt Officials" @if($qb->accompanied_by == "Govt Officials") selected @endif>Govt Officials</option>
                    <option  value="Donor" @if($qb->accompanied_by == "Donor") selected @endif>Donor</option>
                    <option  value="NA" @if($qb->accompanied_by == "NA") selected @endif>NA</option>
                </select>
                <div id="accompanied_byError" class="error-message"></div>
            </div>
            <div class="fv-row col-md-4">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Activity visited</span>
                </label>
                <textarea  rows="1" class="form-control" id="activity_description"  name="activity_description">{{$qb->activity_description ?? ''}}</textarea>
                <div id="activity_descriptionError" class="error-message"></div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="fv-row col-md-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Date of monitoring visit</span>
                </label>
                <input type="text" name="date_visit" id="date_visit" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="{{date('Y-m-d', strtotime($qb->date_visit ?? ''))}}">
                <div id="date_visitError" class="error-message"></div>
            </div>
            <div class="fv-row col-sm-3 col-md-1 col-lg-1">
                <label class="fs-9 fw-semibold form-label mb-2">
                    <span class="required">Total QBs</span>
                </label>
                <input type="text" class="form-control fs-9" id="total_qbs"  name="total_qbs" value="{{$qb->total_qbs ?? ''}}">
                <div id="total_qbsError" class="error-message"></div>
            </div>
            <div class="fv-row col-md-1">
                <label class="fs-9 fw-semibold form-label mb-2">
                    <span class="required">Fully Met</span>
                </label>
                <input type="text" class="form-control fs-9" id="qbs_fully_met" name="qbs_fully_met" value="{{$qb->qbs_fully_met ?? ''}}">
                <div id="qbs_fully_metError" class="error-message"></div>
            </div>
            <div class="fv-row col-md-1">
                <label class="fs-9 fw-semibold form-label mb-2">
                    <span class="required">Not Applicable</span>
                </label>
                <input type="text" class="form-control fs-9" name="qb_not_applicable" id="qb_not_applicable" value="{{$qb->qb_not_applicable ?? ''}}">
                <div id="qb_not_applicableError" class="error-message"></div>
            </div>
            <div class="fv-row col-md-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Visit Staff Name</span>
                </label>
                <select name="visit_staff_name" id="visit_staff_name" aria-label="Select a Visit Staff Name" data-control="select2" data-placeholder="Select a Registrar Name..." class="form-select">
                    <option  value="">Select Option</option>
                    @foreach($users as $user)
                    <option  value="{{$user->name}}" @if($qb->visit_staff_name == $user->name ) selected @endif>{{$user->name}}</option>
                    @endforeach
                    <option  value="Ruqaiya Bibi" @if($qb->visit_staff_name == "Ruqaiya Bibi" ) selected @endif >Ruqaiya Bibi</option>
                    <option  value="Mehnaz" @if($qb->visit_staff_name == "Mehnaz" ) selected @endif>Mehnaz</option>
                    <option  value="Musarrat Bibi" @if($qb->visit_staff_name == "Musarrat Bibi" ) selected @endif >Musarrat Bibi</option>
                    <option  value="Shaista Mir" @if($qb->visit_staff_name == "Shaista Mir" ) selected @endif >Shaista Mir</option>
                    <option  value="Shama" @if($qb->visit_staff_name == "Shama" ) selected @endif>Shama</option>
                    <option  value="Zahid Ali Khan" @if($qb->visit_staff_name == "Zahid Ali Khan" ) selected @endif >Zahid Ali Khan</option>
                </select>
                <div id="visit_staff_nameError" class="error-message"></div>
            </div>
            <div class="fv-row col-md-3">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Staff Organization</span>
                </label>
                <select name="staff_organization" id="staff_organization" aria-label="Select a Visit Staff Name" data-control="select2" data-placeholder="Select a Registrar Name..." class="form-select" >
                    <option  value=""  @if($qb->staff_organization == "" ) selected @endif>Select Option</option>
                    <option  value="SC Staff"  @if($qb->staff_organization == "SC Staff" ) selected @endif >SC Staff</option>
                    <option  value="SRSP Staff" @if($qb->staff_organization == "SRSP Staff" ) selected @endif>SRSP Staff</option>
                    <option  value="LRF Staff" @if($qb->staff_organization == "LRF Staff" ) selected @endif >LRF Staff</option>
                    <option  value="TKF Staff" @if($qb->staff_organization == "TKF Staff" ) selected @endif >TKF Staff</option>
                </select>
                <div id="staff_organizationError" class="error-message"></div>
            </div>

        </div>
        <div class="separator my-10"></div>
        <div class="text-center pt-15">
            <button type="submit" id="kt_qb_update_submit" class="btn btn-primary">
                @include('partials/general/_button-indicator', ['label' => 'Update'])
            </button>
            
        </div>
    </div>
    </form>
</div>