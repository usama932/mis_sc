<x-nform-layout>
    @section('title')
        Add Feedback/Complaint #.{{$response_id}}
    @endsection
    <div class="card">
        <div class="print-error-msg ">
            <ul></ul>
        </div>
        <form class="form" novalidate="novalidate" id="frm_form" data-kt-redirect-url="{{ route('frm-managements.index') }}" action="{{ route('frm-managements.store') }}">
            @csrf
            <input type="hidden" id="response_id" name="response_id" value="{{$response_id}}">
            <div class="card-body py-4">
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Information Receiver::</h5>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="fv-row col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="">Staff Name</span>
                          
                        </label>
                        <select name="name_of_registrar" id="name_of_registrar" aria-label="Select a Registrar Name" data-control="select2" data-placeholder="Select a Registrar Name..." class="form-select form-select-solid">
                            <option  value="">Select Option</option>
                            @foreach($users as $user)
                                <option  value="{{$user->name}}" >{{$user->name}}</option>
                            @endforeach
                            <option  value="Ruqaiya Bibi" >Ruqaiya Bibi</option>
                            <option  value="Dr. Kashmala" >Dr. Kashmala</option>
                            <option  value="Mehnaz" >Mehnaz</option>
                            <option  value="Musarrat Bibi" >Musarrat Bibi</option>
                            <option  value="Shaista Mir" >Shaista Mir</option>
                            <option  value="Shama" >Shama</option>
                            <option  value="Zahid Ali Khan" >Zahid Ali Khan</option>
                        </select>
                        <span id="name_of_registrarError" class="error-message"></span> 
                    </div>
                    <div class="fv-row col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Date Received</span>
                            
                        </label>
                        <input type="text" name="date_received" id="date_recieved_id" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                        <span id="date_recievedError" class="error-message"></span>
                    </div>
                    <div class="fv-row col-md-4 mt-3 mb-2">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Channel</span>
                            
                        </label>
                        <select name="feedback_channel" id="feedback_channel" aria-label="Select a Feedback Channel" data-control="select2" data-placeholder="Select a Feedback Channel..." class="form-select form-select-solid">
                            <option  value="">Select Option</option>
                            @foreach($feedbackchannels as $feedbackchannel)
                                <option value="{{$feedbackchannel->id}}">{{$feedbackchannel->name}}</option>
                            @endforeach
                        </select>
                        <span id="feedback_channelError" class="error-message "></span>
                    </div>
                    <div class="fv-row card-title  border-2 my-4 ">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                <h5 class="fw-bold m-3">Information about the people who shared feedback::</h5>
                            </div>
                        </div>
                    </div>
                    <div class="fv-row col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Complainant Name</span>
                            
                        </label>
                        <input class="form-control" placeholder="Enter Client Name" name="name_of_client" id="name_of_client" value=""/>
                        <span id="name_of_clientError" class="error-message"></span>
                    </div>
                    <div class="fv-row col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Type</span>
                            
                        </label>
                        <select   name="type_of_client" id="type_of_client" aria-label="Select a Type of Client" data-control="select2" data-placeholder="Select a Type of Client..." class="form-select form-select-solid" >
                            <option value="">Select Client</option>
                            <option>Direct Beneficiary</option>
                            <option>Indirect Beneficiary</option>
                            <option>Non-Beneficiary</option>
                            <option>Partner Staff</option>
                            <option>Save the Children Staff</option>
                        </select>  
                        <span id="type_of_clientError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Gender</span>
                            
                        </label>
                        <select   name="gender" id="gender" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a Gender..." class="form-select form-select-solid genderit">
                            <option value="">Select Gender</option>
                            <option  value="Boy">Boy</option>
                            <option  value="Girl">Girl</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <span id="genderError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                            <span class="required">Age</span>   
                            <span class="spinner-border spinner-border-sm align-middle ms-2" id="ageloader"></span>
                        </label>
                        <select   name="age" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a age..." class="form-select form-select-solid" id="age_id">
                            <option value="">Select Option</option>
                        </select>
                        <span id="ageError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Province</span>
                            
                        </label> 
                        <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select form-select-solid">
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
                        <span id="kt_select2_provinceError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                            <span class="required">District</span>
                            <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
                        </label>
                        <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select  District" class="form-select form-select-solid">
                        </select>
                        <span id="kt_select2_districtError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                            <span class="required">Tehsil</span>   
                            <span class="spinner-border spinner-border-sm align-middle ms-2" id="tehsilloader"></span>  
                        </label>
                        <select id="kt_select2_tehsil" name="tehsil" aria-label="Select a Tehsil" data-control="select2" data-placeholder="Select a Tehsil..." class="form-select form-select-solid">
                        </select>
                        <span id="kt_select2_tehsilError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-3 mt-3"> 
                        <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                            <span class="required">Union Counsil</span>
                            <span class="spinner-border spinner-border-sm align-middle ms-2" id="ucloader"></span>
                        </label>
                        <select id="kt_select2_union_counsil" name="union_counsil" aria-label="Select a UC" data-control="select2" data-placeholder="Select a Uc..." class="form-select form-select-solid" >
                        </select>
                        <span id="kt_select2_union_counsilError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-6 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Village</span>                           
                        </label>
                        <input class="form-control " placeholder="Enter Village" name="village" id="village" value="">                       
                    </div>
                    <div class="fv-row col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2 d-flex justify-content-start">
                            <span class="required">PWD/CLWD</span>                            
                        </label>
                        <div class="form-check form-check-custom form-check-solid mt-4">
                            <!--begin::Input-->
                            <input class="form-check-input" name="pwd_clwd" id="pwd_clwd"  type="radio" value="Yes"/>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800 ">Yes</div>
                            </label>
                            <input class="form-check-input"   @error('pwd_clwd') is-invalid @enderror name="pwd_clwd" id="pwd_clwd" type="radio" value="No"/>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800">No</div>
                            </label>
                            
                        </div>
                        <span id="pwd_clwdError" class="error-message"></span>
                        
                    </div>
                    <div class="fv-row col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Allow Contact</span>                           
                        </label>
                        <div class="foallow_contactrm-check form-check-custom form-check-solid mt-4">
                            <!--begin::Input-->
                            <input class="form-check-input contact_id" name="allow_contact" id="allow_contact_yes" type="radio" value="Yes"/ checked>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800 ">Yes</div>
                            </label>
                            <input class="form-check-input contact_id" name="allow_contact" id="allow_contact_no"  id="allow_contact" type="radio" value="No"/ required>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800">No</div>
                            </label>
                            <!--end::Label-->
                           
                        </div>
                        <div id="allow_contactError" class="error-message "></div>
                    </div>
                    <div class="fv-row col-md-3 mt-3 contact_div">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Contact Number</span>
                            
                        </label>
                        <input type="number" class="form-control " placeholder="Enter Contact Number" name="contact_number" id="contact_number" value="" />
                        <span id="contact_numberError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-9 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description (Write Brief Narration)</span>                          
                        </label>
                        <textarea type="text" class="form-control "  name="feedback_description" id="feedback_description" /></textarea>
                        <span id="feedback_descriptionError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-9 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">FeedBack Category </span>
                        </label>
                        <select   name="feedback_category" id="feedback_category" aria-label="Select a Feedback Category" data-control="select2" data-placeholder="Select a Feedback Category" class="form-select form-select-solid categoryit">
                            <option value="">Select Option</option>
                            @foreach($feedbackcategories as $feedbackcategory)
                                <option value={{$feedbackcategory->id}}>{{$feedbackcategory->name}}-{{$feedbackcategory->description}}</option>
                            @endforeach
                        </select>
                        <span id="feedback_categoryError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-3 mt-3 " id="show_datix">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Datix Number</span>                            
                        </label>
                        <input type="text" class="form-control" placeholder="Enter Datix Number" name="datix_number" id="datix_number" value="" />
                        <span id="datix_numberError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Theme</span>     
                        </label>
                        <select   name="theme" id="theme" aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme" class="form-select form-select-solid">
                            <option value="">Select Theme</option>
                            @foreach($themes as $theme)
                                <option value="{{$theme->id}}">{{$theme->name}}</option>
                            @endforeach
                        </select>
                        <span id="themeError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Activity</span> 
                        </label>
                        <input class="form-control" placeholder="Enter Feedback Activity" name="feedback_activity" id="feedback_activity" value="" />
                        <span id="feedback_activityError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="">Project</span>                          
                        </label>
                        <select   name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Theme" class="form-select form-select-solid">
                            <option>Select Project</option>
                            @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row card-title  border-0 my-4"">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                <h5 class="fw-bold m-3">Information about the referring,
                                    actioning and closing of the feedback loop::</h5>
                            </div>
                        </div>
                    </div>
                    <div class="fv-row col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Referred or Shared</span>                            
                        </label>
                        <select name="feedback_referredorshared" id="feedback_referredorshared" aria-label="Select a Option" data-placeholder="Select a Statut..." class="form-select form-select-solid shareid">
                            <option value="">Select Option</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <span id="feedback_referredorsharedError" class="error-message "></span>
                    </div>
                    <div class="fv-row col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required"> Date of feedback Referred </span>
                        </label>
                        <input type="text"  name="date_feedback_referred" id="date_feedback_referred" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()"  data-provide="datepicker" value="">
                        <div id="date_feedback_referredError" class="error-message "></div>
                    </div>
                    <div class="fv-row col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Reffered To(Name)</span>
                        </label>
                        <input type="text" name="refferal_name" id="refferal_name" placeholder="Enter Reffered To (Name)"  class="form-control " value="">
                        <div id="refferal_nameError" class="error-message "></div>
                    </div>
                    <div class="fv-row col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Reffered To(Position)</span>
                        </label>
                        <input type="text" name="refferal_position" id="refferal_position"  @error('refferal_position') is-invalid @enderror placeholder="Enter Reffered To (Position)"  class="form-control " value="">
                        <div id="refferal_positionError" class="error-message "></div>
                    </div>
                    <div class="fv-row col-md-8 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description of actions undertaken to resolve the feedback</span>
                        </label>
                        <textarea  name="feedback_summary" id="feedback_summary"   @error('feedback_summary') is-invalid @enderror  class="form-control"></textarea>
                        <div id="feedback_summaryError" class="error-message "></div>
                    </div>
                    <div class="fv-row col-md-4 mt-3 no_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Status</span>
                        </label>
                        <select   name="status" id="status" aria-label="Select a Status"  @error('status') is-invalid @enderror data-control="select2" data-placeholder="Select a Statut..." class="form-select form-select-solid statusid">
                            <option value="">Select Option</option>
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                        </select>
                        <div id="statusError" class="error-message "></div>
                    </div>
                    <div class="fv-row col-md-4 mt-3 no_divs actionid " id="actionid">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Action Taken </span>
                        </label>
                        <select name="actiontaken" id="action_id" aria-label="Select a Action"  @error('actiontaken') is-invalid @enderror data-control="select2" data-placeholder="Select a Action..." class="form-select form-select-solid " >

                        </select>
                        <div id="actiontakenError" class="error-message "></div>
                    </div>
                </div>
                 <div class="separator my-10"></div>
                <div class="text-center pt-15">
                    <button type="submit" id="kt_btn_submit" class="btn btn-primary">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                   
                </div>
            </div>
        </form>

    </div>

    @push('scripts')
  

    @endpush

</x-nform-layout>
