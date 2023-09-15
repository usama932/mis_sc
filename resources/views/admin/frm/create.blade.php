<x-default-layout>
    @push('stylesheets')
    <link rel="stylesheet" href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.bundle.css')}}">
    @endpush
    @section('title')
        Add Feedback Registry Form
    @endsection

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
        <form class="form" action="{{route('frm-managements.store')}}" method="post">
            @csrf
            <div class="card-body py-4">
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Information Receiver::</h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Staff Name</span>
                        </label>
                        <input class="form-control"  @error('name_of_registrar') is-invalid @enderror placeholder="Enter Staff Name" name="name_of_registrar" value="" required />
                        @error('name_of_registrar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Date Received</span>
                        </label>
                        <input type="text"  @error('date_received') is-invalid @enderror name="date_received" id="date_recieved_id" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="" required>
                        @error('date_received')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3 mb-2">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Channel</span>
                        </label>
                        <select name="feedback_channel" aria-label="Select a Feedback Channel" data-control="select2" data-placeholder="Select a Country..." class="form-select form-select-solid" required  @error('feedback_channel') is-invalid @enderror>
                            <option  value="">Select Option</option>
                            <option  >Hotline</option>
                            <option  >SMS</option>
                            <option  >Feedback Form</option>
                            <option  >Email</option>
                            <option >Field Monitoring</option>
                            <option  >Post Distribution Monitoring</option>
                            <option  >Medical Exit Interview</option>
                            <option >Community meeting</option>

                        </select>
                        @error('feedback_channel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="card-title  border-2 my-4 ">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                <h5 class="fw-bold m-3">Information about the people who shared feedback::</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Name</span>
                        </label>
                        <input class="form-control"  @error('name_of_client') is-invalid @enderror placeholder="Enter Client Name" name="name_of_client" value="" required/>
                        @error('name_of_client')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Type</span>
                        </label>
                        <select   name="type_of_client" aria-label="Select a Type of Client" data-control="select2" data-placeholder="Select a Type of Client..." class="form-select form-select-solid"  @error('type_of_client') is-invalid @enderror required>
                            <option value="">Select Client</option>
                            <option>Direct Beneficiary</option>
                            <option>Indirect Beneficiary</option>
                            <option>Non-Beneficiary</option>
                            <option>Partner Staff</option>
                            <option>Save the Children Staff</option>
                        </select>
                        @error('type_of_client')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Gender</span>
                        </label>
                        <select   name="gender"  @error('gender') is-invalid @enderror aria-label="Select a Gender" data-control="select2" data-placeholder="Select a Gender..." class="form-select form-select-solid genderit" required>
                            <option value="">Select Gender</option>
                            <option  value="Boy">Boy</option>
                            <option  value="Girl">Girl</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Age</span>
                        </label>
                        <select   name="age"  @error('age') is-invalid @enderror aria-label="Select a Gender" data-control="select2" data-placeholder="Select a age..." class="form-select form-select-solid" id="age_id" required>

                        </select>
                        @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Province</span>
                        </label>
                        <select   name="province" id="kt_select2_province" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a age..." class="form-select form-select-solid"   @error('province') is-invalid @enderror required>
                            <option value="">Select Province</option>
                            {{-- <option value='1'>Punjab</option> --}}
                            <option value='4'>Sindh</option>
                            <option value='2'>KPK</option>
                            {{-- <option value='4'>Balochistan</option> --}}
                        </select>
                        @error('province')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">District</span>
                        </label>
                        <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select form-select-solid"  @error('district') is-invalid @enderror required>

                        </select>
                        @error('district')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Tehsil</span>
                        </label>
                        <select id="kt_select2_tehsil"  @error('tehsil') is-invalid @enderror name="tehsil" aria-label="Select a Tehsil" data-control="select2" data-placeholder="Select a Tehsil..." class="form-select form-select-solid" required>

                        </select>
                        @error('tehsil')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Union Counsil</span>
                        </label>
                        <select id="kt_select2_union_counsil"  @error('union_counsil') is-invalid @enderror name="union_counsil" aria-label="Select a UC" data-control="select2" data-placeholder="Select a Uc..." class="form-select form-select-solid" required>

                        </select>
                        @error('union_counsil')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Village</span>
                        </label>
                        <input class="form-control "  @error('village') is-invalid @enderror placeholder="Enter Village" name="village" value="" / required>
                        @error('village')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">PWD/CLWD</span>
                        </label>
                        <div class="form-check form-check-custom form-check-solid   mt-4">
                            <!--begin::Input-->
                            <input class="form-check-input"  @error('pwd_clwd') is-invalid @enderror name="pwd_clwd" type="radio" value="Yes"/ required>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800 ">Yes</div>
                            </label>
                            <input class="form-check-input"   @error('pwd_clwd') is-invalid @enderror name="pwd_clwd" type="radio" value="No"/ required >
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800">No</div>
                            </label>
                            <!--end::Label-->
                            @error('pwd_clwd')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Allow Contact</span>
                        </label>
                        <div class="form-check form-check-custom form-check-solid mt-4">
                            <!--begin::Input-->
                            <input class="form-check-input contact_id"  @error('allow_contact') is-invalid @enderror name="allow_contact" type="radio" value="Yes"/ required>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800 ">Yes</div>
                            </label>
                            <input  @error('allow_contact') is-invalid @enderror class="form-check-input contact_id" name="allow_contact" type="radio" value="No"/ required>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800">No</div>
                            </label>
                            <!--end::Label-->
                            @error('allow_contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 mt-3 contact_div">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Contact Number</span>
                        </label>
                        <input type="number"  @error('contact_number') is-invalid @enderror class="form-control " placeholder="Enter Contact Number" name="contact_number" value="" />
                        @error('contact_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-9 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description (Write Brief Narration)</span>
                        </label>
                        <textarea type="number"  @error('feedback_description') is-invalid @enderror class="form-control "  name="feedback_description" / required></textarea>
                        @error('feedback_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-9 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">FeedBack Category </span>
                        </label>
                        <select   name="feedback_category"  @error('feedback_category') is-invalid @enderror aria-label="Select a Feedback Category" data-control="select2" data-placeholder="Select a Feedback Category" class="form-select form-select-solid categoryit" required>
                            <option>Select Option</option>
                            <option>Category-0 Thank you message/ Positive Feedback</option>
                            <option>Category-1 Request for Information</option>
                            <option>Category-2 Request for Assistance</option>
                            <option>Category-3 Minor Dissatisfaction with activities or suggestion for improvement</option>
                            <option>Category-4 Major Dissatisfaction; non-payment of salary to SCI representative staff with activities or suggestion for improvement </option>
                            <option>Category-5 Breach of CSP & PESA including Fraud concerns; unsafe programming; security threats by SCI or its representative staff</option>
                            <option>Category-6 Negative feedback related to other organizations</option>
                        </select>
                        @error('feedback_category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3 " id="show_datix">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Datix Number</span>
                        </label>
                        <input type="number" class="form-control"  @error('datix_number') is-invalid @enderror placeholder="Enter Datix Number" name="datix_number" value="" />
                        @error('datix_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Theme</span>
                        </label>
                        <select   name="theme"  @error('theme') is-invalid @enderror aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme" class="form-select form-select-solid" required>
                            <option>Select Theme</option>
                            <option>Education</option>
                            <option>Child Protection</option>
                            <option>Food Security & Livelihood</option>
                            <option>Health & Nutrition</option>
                            <option>Shelter/NFIs</option>
                            <option>Water Sanitation & Hygiene</option>
                        </select>
                        @error('theme')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Activity</span>
                        </label>
                        <input class="form-control"  @error('feedback_activity') is-invalid @enderror placeholder="Enter Feedback Activity" name="feedback_activity" value="" / required>
                        @error('feedback_activity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Project</span>
                        </label>
                        <select   name="project_name"  @error('project_name') is-invalid @enderror aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select form-select-solid">
                            <option>Select Theme</option>
                            <option value="DRA">DRA</option>
                            <option value="CDP">CDP</option>
                            <option  value="Connect">Connect</option>
                            <option  value="Pak Dec">Pak Dec</option>
                            <option value="Hum Fund">Hum Fund</option>
                            <option  value="DEC-2">DEC-2</option>
                            <option value="Pak SB2S CONNECT">Pak SB2S CONNECT</option>
                            <option  value="ECHO HIP">ECHO HIP</option>
                            <option   value="EU/FPI">EU/FPI</option>
                            <option   value="HBCC-II">HBCC-II</option>
                            <option  value="HC Canada">HC Canada</option>
                            <option value="Hunger Fund">Hunger Fund</option>
                            <option value="Pak SwS">Pak SwS</option>
                            <option value="SWS-II">SWS-II</option>
                            <option  value="VaC-RIEP">VaC-RIEP</option>
                            <option  value="Pak SCC Appeal Fund">Pak SCC Appeal Fund</option>
                            <option  value="Pak HF Afghan Refugee">Pak HF Afghan Refugee</option>
                            <option  value="MCIC">MCIC</option>
                            <option   value="UNIFOR">UNIFOR</option>
                            <option  value="HKDRF">HKDRF</option>
                        </select>
                        @error('project_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="card-title  border-0 my-4"">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                <h5 class="fw-bold m-3">Information about the referring,
                                    actioning and closing of the feedback loop::</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Referred or Shared</span>
                        </label>
                        <select name="feedback_referredorshared"  @error('feedback_referredorshared') is-invalid @enderror aria-label="Select a Option" data-placeholder="Select a Statut..." class="form-select form-select-solid shareid"  required>
                            <option value="">Select Option</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        @error('feedback_referredorshared')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required"> Date of feedback Referred </span>
                        </label>
                        <input type="text"  @error('date_feedback_referred') is-invalid @enderror name="date_feedback_referred" id="date_recieved_id" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()"  data-provide="datepicker" value="">
                        @error('date_feedback_referred')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Reffered To(Name)</span>
                        </label>
                        <input type="text"  @error('refferal_name') is-invalid @enderror name="refferal_name" placeholder="Enter Reffered To (Name)"  class="form-control " value="">
                        @error('refferal_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Reffered To(Position)</span>
                        </label>
                        <input type="text" name="refferal_position"   @error('refferal_position') is-invalid @enderror placeholder="Enter Reffered To (Position)"  class="form-control " value="">
                        @error('refferal_position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description of actions undertaken to resolve the feedback</span>
                        </label>
                        <textarea  name="feedback_summary"   @error('feedback_summary') is-invalid @enderror  class="form-control"></textarea>
                        @error('feedback_summary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3 no_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Status</span>
                        </label>
                        <select   name="status" aria-label="Select a Status"  @error('status') is-invalid @enderror data-control="select2" data-placeholder="Select a Statut..." class="form-select form-select-solid statusid">
                            <option value="">Select Option</option>
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3 no_divs actionid " id="actionid">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Action Taken </span>
                        </label>
                        <select name="actiontaken" id="action_id" aria-label="Select a Action"  @error('actiontaken') is-invalid @enderror data-control="select2" data-placeholder="Select a Action..." class="form-select form-select-solid " >

                        </select>
                        @error('actiontaken')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" >Discard</button>
                    <button type="submit" class="btn btn-primary" >
                        Submit
                    </button>
                </div>
            </div>
        </form>

    </div>

    @push('scripts')

    {{-- <script src="{{asset("assets/js/widgets.bundle.js")}}"></script> --}}
    {{-- <script src="{{asset("assets/js/scripts.bundle.js")}}"></script> --}}
    <script>
        $(document).ready(function(){
            $(".genderit").change(function(){

                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).attr("value");

                    if(optionValue == "Girl" || optionValue == "Boy"){
                        $('#age_id').html('<option value="">Select Age</option>\<option value="Under 18">Under 18</option>');

                    }else if(optionValue == "Male" || optionValue == "Female")
                    {
                        $('#age_id').html('<option value="">Select Age</option>\<option value="19-50">19-50</option>\<option value="Above 50">Above 50</option>');
                    }
                    else{
                        $(".box").hide();
                    }
                });
            }).change();
        });
        //script for select Allow to Contact
        $(document).ready(function(){
            $('.contact_id').click(function(){

                var demo = $(this).val();
                if(demo == "Yes"){
                    $(".contact_div").show();
                }
                else{
                    $(".contact_div").hide();
                }
            });
        });
        //script for select Category and datix
        $(document).ready(function(){
            $(".categoryit").change(function(){

                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).val();

                    var test = "Category-6 Negative feedback related to other organizations";
                    var test1 ="Category-5 Breach of CSP & PESA including Fraud concerns; unsafe programming; security threats by SCI or its representative staff";



                    if(optionValue == test || optionValue == test1){

                        $("#show_datix").show();
                    }
                    else{
                        $("#show_datix").hide();
                    }
                });
            }).change();
        });
        //Script for Reffered share
        $(document).ready(function(){
            $(".shareid").change(function(){

                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).val();

                    var test = "Yes";
                    var test1 ="No";

                    if(optionValue == test ){

                        $(".yes_divs").show();
                        $(".no_divs").hide();
                    }
                    else if(optionValue == test1){
                        $(".yes_divs").hide();
                        $(".no_divs").show();
                    }
                    else{
                        $(".yes_divs").hide();
                        $(".no_divs").hide();
                    }
                });
            }).change();
        });
        //Script for Reffered Action
        $(document).ready(function(){
            $(".statusid").change(function(){

                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).val();

                    var test  = "Open";
                    var test1 = "Close";

                    if(optionValue == test1 ){

                        $(".actionid").show();
                        $('#action_id').html('<label class="font-weight-bold">Action Taken</label>\
                        \<select class="form-control " name="actiontaken_closingloop_id">\
                            \<option value="">Select Option</option>\
                            \<option>Satisfied</option>\
                            \<option>Partially Satisfied</option>\
                            \<option>Not Satisfied</option>\
                        \</select>');
                    }
                    else if(optionValue == test){
                        $(".actionid").hide();

                    }
                    else{
                        $(".actionid").hide();
                    }
                });
            }).change();
        });

        //flatpicker for date
        $('#date_recieved_id,#date_relatedto_feedback_id,#date_feedback_referred_id').flatpickr({
            altInput: true,
            dateFormat: "y-m-d",
            maxDate: "today"
		});
        //script for province, district,tehisl and uc
         ///get district cascade province
        $("#kt_select2_province").change(function () {

            var value = $(this).val();
            csrf_token = $('[name="_token"]').val();
            $.ajax({
                type: 'POST',
                url: '/getDistrict',
                data: {'province': value, _token: csrf_token },
                dataType: 'json',
                success: function (data) {
                    $("#kt_select2_district").find('option').remove();
                    $("#kt_select2_district").prepend("<option value='' >Select District</option>");
                    var selected='';
                    $.each(data, function (i, item) {

                        $("#kt_select2_district").append("<option value='" + item.district_id + "' "+selected+" >" +
                        item.district_name.replace(/_/g, ' ') + "</option>");
                    });
                    $('#kt_select2_tehsil').html('<option value="">Select Tehsil</option>');
                    $('#kt_select2_union_counsil').html('<option value=""> Select UC</option>');

                }
            });

        }).trigger('change');

        $("#kt_select2_district").change(function () {

            var value = $(this).val();
            csrf_token = $('[name="_token"]').val();
            $.ajax({
            type: 'POST',
            url: '/getTehsil',
            data: {'district_id': value, _token: csrf_token },
            dataType: 'json',
            success: function (data) {
                $("#kt_select2_tehsil").find('option').remove();
                $("#kt_select2_tehsil").prepend("<option value='' >Select Tehsil</option>");
                var selected='';
                $.each(data, function (i, item) {

                    $("#kt_select2_tehsil").append("<option value='" + item.id + "' "+selected+" >" +
                    item.tehsil_name.replace(/_/g, ' ') + "</option>");
                });
                $('#kt_select2_union_counsil').html('<option value="">Select UC</option>');

            }
            });

        }).trigger('change');
        $("#kt_select2_tehsil").change(function () {

            var value = $(this).val();
            csrf_token = $('[name="_token"]').val();
            $.ajax({
            type: 'POST',
            url: '/getUnionCouncil',
            data: {'tehsil_id': value, _token: csrf_token },
            dataType: 'json',
            success: function (data) {
            $("#kt_select2_union_counsil").find('option').remove();
            $("#kt_select2_union_counsil").prepend("<option value='' >Select UC</option>");
            var selected='';
            $.each(data, function (i, item) {

                $("#kt_select2_union_counsil").append("<option value='" + item.union_id + "' "+selected+" >" +
                item.uc_name.replace(/_/g, ' ') + "</option>");
            });


            }
            });

        }).trigger('change');
    </script>

    @endpush

</x-default-layout>
