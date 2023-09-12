<x-default-layout>
    @push('stylesheets')
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @endpush
    @section('title')
        Add Feedback Registry Form
    @endsection

    <div class="card">
        <form class="form">
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
                        <input class="form-control " placeholder="Enter Staff Name" name="profile_email" value="" />
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required"> Date Received</span>
                        </label>
                        <input type="date" name="date_recieved_id" id="date_recieved_id" placeholder="Select date"  class="form-control " onkeydown="event.preventDefault()"  data-provide="datepicker"
                        value=""   required>

                    </div>
                    <div class="col-md-4 mt-3 mb-2">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Channel</span>
                        </label>
                        <select name="feedbackchannel" aria-label="Select a Feedback Channel" data-control="select2" data-placeholder="Select a Country..." class="form-select form-select-solid">
                            <option  value="">Select Option</option>
                            <option  >Hotline</option>
                            <option  >SMS</option>
                            <option  >FeedBack Form</option>
                            <option  >Email</option>
                            <option >Field Monitoring</option>
                            <option  >Post Distribution Monitoring</option>
                            <option  >Medical Exit Interview</option>
                            <option >Community meeting</option>

                        </select>
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
                        <input class="form-control " placeholder="Enter Client Name" name="client_name" value="" />
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Type</span>
                        </label>
                        <select   name="typeofClient" aria-label="Select a Type of Client" data-control="select2" data-placeholder="Select a Type of Client..." class="form-select form-select-solid">
                            <option value="">Select Client</option>
                            <option>Direct Beneficiary</option>
                            <option>Indirect Beneficiary</option>
                            <option>Non-Beneficiary</option>
                            <option>Partner Staff</option>
                            <option>Save the Children Staff</option>
                        </select>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Gender</span>
                        </label>
                        <select   name="gender" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a Gender..." class="form-select form-select-solid genderit">
                            <option value="">Select Gender</option>
                            <option  value="Boy">Boy</option>
                            <option  value="Girl">Girl</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Age</span>
                        </label>
                        <select   name="age" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a age..." class="form-select form-select-solid" id="age_id">

                        </select>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Province</span>
                        </label>
                        <select   name="province" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a age..." class="form-select form-select-solid">
                            <option value="">Select Province</option>
                            <option value='1'>Punjab</option>
                            <option value='2'>Sindh</option>
                            <option value='3'>KPK</option>
                            <option value='4'>Balochistan</option>
                        </select>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">District</span>
                        </label>
                        <select   name="district" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a age..." class="form-select form-select-solid">

                        </select>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Tehsil</span>
                        </label>
                        <input class="form-control " placeholder="Enter Tehsil" name="tehsil" value="" />
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Union Counsil</span>
                        </label>
                        <input class="form-control " placeholder="Enter Union Counsil" name="union_counsil" value="" />
                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Village</span>
                        </label>
                        <input class="form-control " placeholder="Enter Village" name="village" value="" />
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">PWD/CLWD</span>
                        </label>
                        <div class="form-check form-check-custom form-check-solid  mt-4">
                            <!--begin::Input-->
                            <input class="form-check-input" name="pwd_clwd" type="radio" value="Yes"/>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800 ">Yes</div>
                            </label>
                            <input class="form-check-input" name="pwd_clwd" type="radio" value="No"/>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800">No</div>
                            </label>
                            <!--end::Label-->
                        </div>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Allow Contact</span>
                        </label>
                        <div class="form-check form-check-custom form-check-solid mt-4">
                            <!--begin::Input-->
                            <input class="form-check-input contact_id" name="allow_contact" type="radio" value="Yes"/>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800 ">Yes</div>
                            </label>
                            <input class="form-check-input contact_id" name="allow_contact" type="radio" value="No"/>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800">No</div>
                            </label>
                            <!--end::Label-->
                        </div>
                    </div>
                    <div class="col-md-3 mt-3 contact_div">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Contact Number</span>
                        </label>
                        <input type="number" class="form-control " placeholder="Enter Contact Number" name="contact_number" value="" />
                    </div>
                    <div class="col-md-9 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description (Write Brief Narration)</span>
                        </label>
                        <textarea type="number" class="form-control " placeholder="Enter Contact Number" name="description" value="" /></textarea>
                    </div>
                    <div class="col-md-9 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">FeedBack Category </span>
                        </label>
                        <select   name="feedback_category" aria-label="Select a Feedback Category" data-control="select2" data-placeholder="Select a Feedback Category" class="form-select form-select-solid categoryit">
                            <option>Select Option</option>
                            <option>Category-0 Thank you message/ Positive Feedback</option>
                            <option>Category-1 Request for Information</option>
                            <option>Category-2 Request for Assistance</option>
                            <option>Category-3 Minor Dissatisfaction with activities or suggestion for improvement</option>
                            <option>Category-4 Major Dissatisfaction; non-payment of salary to SCI representative staff with activities or suggestion for improvement </option>
                            <option>Category-5 Breach of CSP & PESA including Fraud concerns; unsafe programming; security threats by SCI or its representative staff</option>
                            <option>Category-6 Negative feedback related to other organizations</option>
                        </select>
                    </div>
                    <div class="col-md-3 mt-3 " id="show_datix">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Datix Number</span>
                        </label>
                        <input type="number" class="form-control"  placeholder="Enter Datix Number" name="datix_number" value="" />
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Theme</span>
                        </label>
                        <select   name="theme" aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme" class="form-select form-select-solid">
                            <option>Select Theme</option>
                            <option>Education</option>
                            <option>Child Protection</option>
                            <option>Food Security & Livelihood</option>
                            <option>Health & Nutrition</option>
                            <option>Shelter/NFIs</option>
                            <option>Water Sanitation & Hygiene</option>

                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Activity</span>
                        </label>
                        <input class="form-control " placeholder="Enter Feedback Activity" name="feedback_activity" value="" />
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Project</span>
                        </label>
                        <select   name="project" aria-label="Select a Project" data-control="select2" data-placeholder="Select a Project" class="form-select form-select-solid">
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
                        <div class="form-check form-check-custom form-check-solid  mt-4">
                            <!--begin::Input-->
                            <input class="form-check-input share_id" name="feedback_reforshared_id" type="radio" value="Yes" />
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800 ">Yes</div>
                            </label>
                            <input class="form-check-input share_id" name="feedback_reforshared_id" type="radio" value="No"/>
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label me-5">
                                <div class="fw-bold text-gray-800">No</div>
                            </label>
                            <!--end::Label-->
                        </div>
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required"> Date of feedback Referred </span>
                        </label>
                        <input type="date" name="date_feedback_referred_id " id="date_recieved_id" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()"  data-provide="datepicker" value=""   required>
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Reffered To(Name)</span>
                        </label>
                        <input type="text" name="refferal_name" placeholder="Enter Reffered To (Name)"  class="form-control " value=""   required>
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Reffered To(Position)</span>
                        </label>
                        <input type="text" name="refferal_postion" placeholder="Enter Reffered To (Name)"  class="form-control " value=""   required>
                    </div>
                    <div class="col-md-8 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description of actions undertaken to resolve the feedback</span>
                        </label>
                        <textarea  name="feedback_summary"   class="form-control" required></textarea>
                    </div>
                    <div class="col-md-4 mt-3 no_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Status</span>
                        </label>
                        <select   name="status" aria-label="Select a Status" data-control="select2" data-placeholder="Select a Statut..." class="form-select form-select-solid">
                            <option value="">Select Option</option>
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                        </select>
                    </div>
                    <div class="col-md-4 mt-3 no_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Action Taken </span>
                        </label>
                        <select   name="status" aria-label="Select a Status" data-control="select2" data-placeholder="Select a Statut..." class="form-select form-select-solid">

                        </select>
                    </div>
                </div>
            </div>
        </form>

    </div>

    @push('scripts')
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}

        //script for selecta Age
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
                $('.share_id').click(function(){
                    if(share == "Yes"){
                    $(".no_divs").hide();
                    $(".yes_divs").show();
                    }
                    else if(share == "No"){
                        $(".yes_divs").hide();
                        $(".no_divs").show();
                    }
                });

            });
            //datepicker
            $(document).ready(function() {
                $('#date_recieved_id,#date_relatedto_feedback_id,#date_feedback_referred_id').datepicker({
                    // minDate: 0, maxDate: '2y',
                        // startDate: new Date(), //will select the current day date
                        endDate: new Date() ,
                    todayHighlight: true,
                    autoclose: true,
                    format: 'mm/dd/yyyy',
                    orientation: "bottom",
                    templates: {
                        leftArrow: '<i class="la la-angle-left"></i>',
                        rightArrow: '<i class="la la-angle-right"></i>',
                    },
                });
            });


        </script>

    @endpush

</x-default-layout>
