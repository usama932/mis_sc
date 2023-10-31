<x-default-layout>
    @push('stylesheets')
    <link rel="stylesheet" href="{{asset('assets/css/style.bundle.css')}}">
    @endpush
    <style>
         .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

    </style>
    @section('title')
        Add Feedback/Complaint #.{{$response_id}}
    @endsection
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        <div class="print-error-msg ">
            <ul></ul>
        </div>
        <form class="form">
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
                    <div class="col-md-4 mt-3">
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
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Date Received</span>
                            
                        </label>
                        <input type="text"  @error('date_received') is-invalid @enderror name="date_received" id="date_recieved_id" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="" required>
                        <span id="date_recievedError" class="error-message"></span>
                    </div>
                    <div class="col-md-4 mt-3 mb-2">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Channel</span>
                            
                        </label>
                        <select name="feedback_channel" id="feedback_channel" aria-label="Select a Feedback Channel" data-control="select2" data-placeholder="Select a Feedback Channel..." class="form-select form-select-solid" required  @error('feedback_channel') is-invalid @enderror>
                            <option  value="">Select Option</option>
                            @foreach($feedbackchannels as $feedbackchannel)
                                <option value="{{$feedbackchannel->id}}">{{$feedbackchannel->name}}</option>
                            @endforeach
                        </select>
                        <span id="feedback_channelError" class="error-message "></span>
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
                            <span class="required">Complainant Name</span>
                            
                        </label>
                        <input class="form-control"  @error('name_of_client') is-invalid @enderror placeholder="Enter Client Name" name="name_of_client" id="name_of_client" value="" required/>
                        <span id="name_of_clientError" class="error-message"></span>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Type</span>
                            
                        </label>
                        <select   name="type_of_client" id="type_of_client" aria-label="Select a Type of Client" data-control="select2" data-placeholder="Select a Type of Client..." class="form-select form-select-solid"  @error('type_of_client') is-invalid @enderror required>
                            <option value="">Select Client</option>
                            <option>Direct Beneficiary</option>
                            <option>Indirect Beneficiary</option>
                            <option>Non-Beneficiary</option>
                            <option>Partner Staff</option>
                            <option>Save the Children Staff</option>
                        </select>  
                        <span id="type_of_clientError" class="error-message "></span>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Gender</span>
                            
                        </label>
                        <select   name="gender" id="gender"  @error('gender') is-invalid @enderror aria-label="Select a Gender" data-control="select2" data-placeholder="Select a Gender..." class="form-select form-select-solid genderit" required>
                            <option value="">Select Gender</option>
                            <option  value="Boy">Boy</option>
                            <option  value="Girl">Girl</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <span id="genderError" class="error-message "></span>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Age</span>
                            
                        </label>
                        <select   name="age"  @error('age') is-invalid @enderror aria-label="Select a Gender" data-control="select2" data-placeholder="Select a age..." class="form-select form-select-solid" id="age_id" required>
                            <option value="">Select Option</option>
                        </select>
                        <span id="ageError" class="error-message "></span>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Province</span>
                            
                        </label>
                        <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select form-select-solid"   @error('province') is-invalid @enderror required>
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
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">District</span>
                            
                        </label>
                        <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select form-select-solid"  @error('district') is-invalid @enderror required>

                        </select>
                        <span id="kt_select2_districtError" class="error-message "></span>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Tehsil</span>
                            
                        </label>
                        <select id="kt_select2_tehsil"  @error('tehsil') is-invalid @enderror name="tehsil" aria-label="Select a Tehsil" data-control="select2" data-placeholder="Select a Tehsil..." class="form-select form-select-solid" required>

                        </select>
                        <span id="kt_select2_tehsilError" class="error-message "></span>
                        
                    </div>
                    <div class="col-md-3 mt-3"> 
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Union Counsil</span>
                            
                        </label>
                        <select id="kt_select2_union_counsil"  @error('union_counsil') is-invalid @enderror name="union_counsil" aria-label="Select a UC" data-control="select2" data-placeholder="Select a Uc..." class="form-select form-select-solid" required>

                        </select>
                        <span id="kt_select2_union_counsilError" class="error-message "></span>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Village</span>
                           
                        </label>
                        <input class="form-control "  @error('village') is-invalid @enderror placeholder="Enter Village" name="village" id="village" value="" / required>
                        
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2 d-flex justify-content-start">
                            <span class="required">PWD/CLWD</span>
                            
                        </label>
                        <div class="form-check form-check-custom form-check-solid mt-4">
                            <!--begin::Input-->
                            <input class="form-check-input"  @error('pwd_clwd') is-invalid @enderror name="pwd_clwd" id="pwd_clwd"  type="radio" value="Yes"/ required>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800 ">Yes</div>
                            </label>
                            <input class="form-check-input"   @error('pwd_clwd') is-invalid @enderror name="pwd_clwd" id="pwd_clwd" type="radio" value="No"/ required >
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800">No</div>
                            </label>
                            
                        </div>
                        <span id="pwd_clwdError" class="error-message"></span>
                        
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Allow Contact</span>
                            
                        </label>
                        <div class="foallow_contactrm-check form-check-custom form-check-solid mt-4">
                            <!--begin::Input-->
                            <input class="form-check-input contact_id"  @error('allow_contact') is-invalid @enderror name="allow_contact" id="allow_contact" type="radio" value="Yes"/ checked  required>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800 ">Yes</div>
                            </label>
                            <input  @error('allow_contact') is-invalid @enderror class="form-check-input contact_id" name="allow_contact" id="allow_contact"  id="allow_contact" type="radio" value="No"/ required>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800">No</div>
                            </label>
                            <!--end::Label-->
                           
                        </div>
                        <div id="allow_contactError" class="error-message "></div>
                    </div>
                    <div class="col-md-3 mt-3 contact_div">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Contact Number</span>
                            
                        </label>
                        <input type="number"  @error('contact_number') is-invalid @enderror class="form-control " placeholder="Enter Contact Number" name="contact_number" id="contact_number" value="" />
                        <span id="contact_numberError" class="error-message "></span>
                    </div>
                    <div class="col-md-9 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description (Write Brief Narration)</span>
                            
                        </label>
                        <textarea type="text"  @error('feedback_description') is-invalid @enderror class="form-control "  name="feedback_description" id="feedback_description" / required></textarea>
                        <span id="feedback_descriptionError" class="error-message "></span>
                    </div>
                    <div class="col-md-9 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">FeedBack Category </span>
                        </label>
                        <select   name="feedback_category" id="feedback_category" @error('feedback_category') is-invalid @enderror aria-label="Select a Feedback Category" data-control="select2" data-placeholder="Select a Feedback Category" class="form-select form-select-solid categoryit" required>
                            <option value="">Select Option</option>
                            @foreach($feedbackcategories as $feedbackcategory)
                                <option value={{$feedbackcategory->id}}>{{$feedbackcategory->name}}-{{$feedbackcategory->description}}</option>
                            @endforeach
                        </select>
                        <span id="feedback_categoryError" class="error-message "></span>
                    </div>
                    <div class="col-md-3 mt-3 " id="show_datix">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Datix Number</span>
                            
                        </label>
                        <input type="number" class="form-control"  @error('datix_number') is-invalid @enderror placeholder="Enter Datix Number" name="datix_number" id="datix_number" value="" />
                        <span id="datix_numberError" class="error-message "></span>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Theme</span>
                            
                        </label>
                        <select   name="theme" id="theme"  @error('theme') is-invalid @enderror aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme" class="form-select form-select-solid" required>
                            <option value="">Select Theme</option>
                            @foreach($themes as $theme)
                                <option value="{{$theme->id}}">{{$theme->name}}</option>
                            @endforeach
                        </select>
                        <span id="themeError" class="error-message "></span>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Activity</span>
                            
                        </label>
                        <input class="form-control"  @error('feedback_activity') is-invalid @enderror placeholder="Enter Feedback Activity" name="feedback_activity" id="feedback_activity" value="" / required>
                        <span id="feedback_activityError" class="error-message "></span>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="">Project</span>
                            
                        </label>
                        <select   name="project_name" id="project_name"  @error('project_name') is-invalid @enderror aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Theme" class="form-select form-select-solid">
                            <option>Select Project</option>
                            @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
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
                        <select name="feedback_referredorshared" id="feedback_referredorshared" aria-label="Select a Option" data-placeholder="Select a Statut..." class="form-select form-select-solid shareid">
                            <option value="">Select Option</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <span id="feedback_referredorsharedError" class="error-message "></span>
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required"> Date of feedback Referred </span>
                        </label>
                        <input type="text"  name="date_feedback_referred" id="date_feedback_referred" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()"  data-provide="datepicker" value="">
                        <div id="date_feedback_referredError" class="error-message "></div>
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Reffered To(Name)</span>
                        </label>
                        <input type="text"  @error('refferal_name') is-invalid @enderror name="refferal_name" id="refferal_name" placeholder="Enter Reffered To (Name)"  class="form-control " value="">
                        <div id="refferal_nameError" class="error-message "></div>
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Reffered To(Position)</span>
                        </label>
                        <input type="text" name="refferal_position" id="refferal_position"  @error('refferal_position') is-invalid @enderror placeholder="Enter Reffered To (Position)"  class="form-control " value="">
                        <div id="refferal_positionError" class="error-message "></div>
                    </div>
                    <div class="col-md-8 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description of actions undertaken to resolve the feedback</span>
                        </label>
                        <textarea  name="feedback_summary" id="feedback_summary"   @error('feedback_summary') is-invalid @enderror  class="form-control"></textarea>
                        <div id="feedback_summaryError" class="error-message "></div>
                    </div>
                    <div class="col-md-4 mt-3 no_divs">
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
                    <div class="col-md-4 mt-3 no_divs actionid " id="actionid">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Action Taken </span>
                        </label>
                        <select name="actiontaken" id="action_id" aria-label="Select a Action"  @error('actiontaken') is-invalid @enderror data-control="select2" data-placeholder="Select a Action..." class="form-select form-select-solid " >

                        </select>
                        <div id="actiontakenError" class="error-message "></div>
                    </div>
                </div>
                <div class="text-center pt-15">
                    <button type="button" class="btn btn-primary me-10" id="btn-submit" >
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                   
                </div>
            </div>
        </form>

    </div>

    @push('scripts')
    <script>
        $(function () {
            $('[name="date_feedback_referred"]').change(function(){
                var date_recieved_id = $("#date_recieved_id").val();
                var date_feedback_referred =$("#date_feedback_referred").val();
                if(date_feedback_referred >= date_recieved_id) {
                    //Do something..

            }
            else{
                swal.fire({
                        text: "Sorry, Date Reffered Must be Greater Than Date Recieved.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function () {
                        KTUtil.scrollTop();

                    // $('#exampleModal').modal('hide');
                    // console.log("invalid");
                    });
            }

            });
        });
    </script>
    @include('admin.frm.frm_script');

    <script type="text/javascript">

        var button = document.querySelector("#btn-submit");    
        $("#btn-submit").click(function(e){
            
            e.preventDefault();
            if (validateForm())
            {
                button.setAttribute("data-kt-indicator", "on");
                var response_id         = $("#response_id").val();
                var token               = "<?php echo csrf_token() ?>";
                var name_of_registrar   = $("#name_of_registrar").val();
                var date_recieved_id    = $("#date_recieved_id").val();
                var feedback_channel    = $("#feedback_channel").val();
                var name_of_client      = $("#name_of_client").val();
                var type_of_client      = $("#type_of_client").val();
                var gender              = $("#gender").val();
                var age                 = $("#age_id").val();
                var kt_select2_province = $("#kt_select2_province").val();
                var kt_select2_district = $("#kt_select2_district").val();
                var kt_select2_tehsil   = $("#kt_select2_tehsil").val();
                var kt_select2_union_counsil = $("#kt_select2_union_counsil").val();
                var village             = $("#village").val();
                var pwd_clwd            = $("#pwd_clwd").val();
                var allow_contact       = $("#allow_contact").val();
                var contact_number      = $("#contact_number").val();
                var feedback_category   = $("#feedback_category").val();
                var datix_number        = $("#datix_number").val();
                var theme               = $("#theme").val();
                var feedback_activity   = $("#feedback_activity").val();
                var project_name        = $("#project_name").val();
                var refferal_name       = $("#refferal_name").val();
                var refferal_position   = $("#refferal_position").val();
                var feedback_summary    = $("#feedback_summary").val();
                var status              = $("#status").val();
                var action_id           = $("#action_id").val();
                var feedback_referredorshared   = $("#feedback_referredorshared").val();
                var date_feedback_referred      = $("#date_feedback_referred").val();
                var feedback_description        = $("#feedback_description").val();
            
            
                $.ajax({
                    type:'POST',
                    url:"{{ route('frm-managements.store') }}",
                    dataType: 'json',
                    data:{
                        _token:token,
                        response_id:response_id,
                        name_of_registrar:name_of_registrar, date_received :date_recieved_id,
                        feedback_channel:feedback_channel, name_of_client:name_of_client,
                        type_of_client:type_of_client, gender:gender,
                        age:age, province:kt_select2_province,
                        district:kt_select2_district,tehsil:kt_select2_tehsil,
                        union_counsil:kt_select2_union_counsil, village:village,
                        pwd_clwd:pwd_clwd,allow_contact:allow_contact,contact_number:contact_number,feedback_description:feedback_description,
                        feedback_category:feedback_category, datix_number:datix_number,theme:theme,
                        feedback_activity:feedback_activity, project_name:project_name,
                        feedback_referredorshared:feedback_referredorshared,date_feedback_referred:date_feedback_referred,
                        refferal_name:refferal_name,refferal_position:refferal_position, feedback_summary:feedback_summary,
                        status:status,actiontaken:action_id,
                    },
                    success:function(data){
                        button.removeAttribute("data-kt-indicator");
                        if(!$.isEmptyObject(data.success)){
                        
                            swal.fire({
                            text: "FRM Created Successfull",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light-success"
                            }
                            });
                            KTUtil.scrollTop();
                        
                        }else{
                            button.removeAttribute("data-kt-indicator");
                            $.each(data, function (i, item) {
                                $(".print-error-msg").find("ul").html('');
                                $(".print-error-msg").css({'display': 'block','margin-top': '3px','color': 'red'});
                                $(".print-error-msg").find("ul").append('<li>'+item+'</li>');
                                KTUtil.scrollTop();
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                    button.removeAttribute("data-kt-indicator");
                    if (xhr.status == 422) {
                    
                        var errors = xhr.responseJSON.errors;

                        // Loop through the errors and display them
                        $.each(errors, function(key, value) {
                            $(".print-error-msg").find("ul").html('');
                                $(".print-error-msg").css({'display': 'block','margin-top': '3px','color': 'red'});
                                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                                swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-light-primary"
                                    }
                                    });
                                KTUtil.scrollTop();
                        });
                    } else {
                        // Handle other types of errors
                    }
                }
            
                });
                
            }
            function validateForm() 
            {
              
                $('.error-message').empty();

                // Example validation (you can customize this)
                var name_of_registrar   = $("#name_of_registrar").val();
                var date_recieved_id    = $("#date_recieved_id").val();
                var feedback_channel    = $("#feedback_channel").val();
                var name_of_client      = $("#name_of_client").val();
                var type_of_client      = $("#type_of_client").val();
                var gender              = $("#gender").val();
                var age                 = $("#age_id").val();
                var kt_select2_province = $("#kt_select2_province").val();
                var kt_select2_district = $("#kt_select2_district").val();
                var kt_select2_tehsil   = $("#kt_select2_tehsil").val();
                var kt_select2_union_counsil = $("#kt_select2_union_counsil").val();
                var pwd_clwd            = $('input[name="pwd_clwd"]:checked').val();
                var allow_contact       = $('input[name="allow_contact"]:checked').val();  
                var contact_number      = $("#contact_number").val();
                var feedback_category   = $("#feedback_category").val();
                var theme               = $("#theme").val();
                var feedback_activity   = $("#feedback_activity").val();
                var feedback_referredorshared   = $("#feedback_referredorshared").val();
                var date_feedback_referred      = $("#date_feedback_referred").val();
                var feedback_description        = $("#feedback_description").val();
                var refferal_name       = $("#refferal_name").val();
                var refferal_position   = $("#refferal_position").val();
                var feedback_summary    = $("#feedback_summary").val();
                var status              = $("#status").val();
                var action_id           = $("#action_id").val();
                var isValid = true;
                
                if (name_of_registrar === '') {
                    displayError('#name_of_registrarError', 'Required', 'name_of_registrarError');
                }

                if (date_recieved_id === '') {
                    displayError('#date_recievedError', 'Required','date_recievedError');
                    isValid = false;
                }
                if (feedback_channel === '') {
                    displayError('#feedback_channelError', 'Required','feedback_channelError');
                    isValid = false;
                }
                if (name_of_client === '') {
                    displayError('#name_of_clientError', 'Required','name_of_clientError');
                    isValid = false;
                }
                if (type_of_client === '') {
                    displayError('#type_of_clientError', 'Required','type_of_clientError');
                    isValid = false;
                }
                if (gender === '') {
                    displayError('#genderError', 'Required','genderError');
                    isValid = false;
                }
                if (age === '') {
                    displayError('#ageError', 'Required','ageError');
                    isValid = false;
                }
                if (kt_select2_province === '') {
                    displayError('#kt_select2_provinceError', 'Required','kt_select2_provinceError');
                    isValid = false;
                }
                if (kt_select2_district === '') {
                    displayError('#kt_select2_districtError', 'Required','kt_select2_districtError');
                    isValid = false;
                }
                if (kt_select2_tehsil === '') {
                    displayError('#kt_select2_tehsilError', 'Required','kt_select2_tehsilError');
                    isValid = false;
                }
                if (kt_select2_union_counsil === '') {
                    displayError('#kt_select2_union_counsilError', 'Required','kt_select2_union_counsilError');
                    isValid = false;
                }
                if (!pwd_clwd) {
                    displayError('#pwd_clwdError', 'Required','pwd_clwdError');
                    isValid = false;
                }
                if (!allow_contact) {
                    displayError('#allow_contactError', 'Required','allow_contactError');
                    isValid = false;
                }
                if (allow_contact === 'Yes') {
                    
                    if (contact_number === '') {
                        displayError('#contact_numberError', 'Contact number is required', 'contact_numberError');
                        return false;
                    }
                }
                if (feedback_description === '') {
                    displayError('#feedback_descriptionError', 'Required','feedback_descriptionError');
                    isValid = false;
                }
              
                if (feedback_category === "") {
                  
                    displayError('#feedback_categoryError', 'Required','feedback_categoryError');
                    isValid = false;
                }
                if (theme === '') {
                    displayError('#themeError', 'Required','themeError');
                    isValid = false;
                }
                if (feedback_activity === '') {
                    displayError('#feedback_activityError', 'Required','feedback_activityError');
                    isValid = false;
                }
                if (feedback_referredorshared === '') {
                    displayError('#feedback_referredorsharedError', 'Required','feedback_referredorsharedError');
                    isValid = false;
                }
                if (feedback_referredorshared === 'Yes') {
                    
                    if (date_feedback_referred === '') {
                        displayError('#date_feedback_referredError', 'Required', 'date_feedback_referredError');
                        return false;
                    }
                    if (refferal_name === '') {
                        displayError('#refferal_nameError', 'Required', 'refferal_nameError');
                        return false;
                    }
                    if (refferal_position === '') {
                        displayError('#refferal_positionError', 'Required', 'refferal_positionError');
                        return false;
                    }
                    if (feedback_summary === '') {
                        displayError('#feedback_summaryError', 'Required', 'feedback_summaryError');
                        return false;
                    }
                }
                if (feedback_referredorshared === 'No') {
                    if (status === '') {
                        displayError('#statusError', 'Required', 'statusError');
                        return false;
                    }
                    if (status === 'Close') {
                        if (action_id === '') {
                        displayError('#actiontakenError', 'Required', 'actiontakenError');
                        return false;
                    }
                    }
                   
                }
                if (!isValid) {
                    // Scroll to the first element with an error message
                    $('html, body').animate({
                        scrollTop: $('.error-message:first').prev().offset().top
                    }, 1000);
                }

                return isValid;
            }

            function displayError(fieldId, message, errorId) {
                // Display error message below the specified field
                $(fieldId).html('<span id="' + errorId + '" class="error-message">' + message + '</span>');
                
            }
        });
    </script>

   



    @endpush

</x-default-layout>
