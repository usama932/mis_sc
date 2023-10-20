<x-default-layout>

    @section("stylesheets")
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link href="{{asset("assets/plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css" />
    @endsection
    
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="card-title m-5">
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success  p-5 rounded">
                            <h1 class="m-5">Total FRM =>
                            
                                {{$total_frm ?? ''}}
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-primary p-5 rounded">
                            <h1 class="m-5">Open FRM =>
                            
                                {{$open_frm ?? ''}}
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning p-5 rounded">
                            <h1 class="m-5">Close FRM =>
                            
                                {{$close_frm ?? ''}}
                            </h1>
                        </div>
                    </div>
                </div>
             
            </div>
            
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h2><i class="fa-solid fa-filter mx-4"></i>Filters</h2>
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card-header border-0 pt-6">
                            <div class="row mb-5">
                                <div class="col-md-6 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required" >Response #id</span>
                                    </label>
                                    <input type="text" name="response_id" id="response_id" class="form-control" value="">
                                </div>
                                <div class="col-md-6 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required" >Date Received</span>
                                    </label>
                                    <input type="text" name="date_received" id="date_recieved_id" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                                </div>
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Staff Name</span>
                                    </label>
                                    <select name="name_of_registrar" id="name_of_registrar" aria-label="Select a Registrar Name" data-control="select2" data-placeholder="Select a Registrar Name..." class="form-select form-select-solid" >
                                        <option  value="">Select a Registrar Name</option>
                                        <option  value="None" >All</option>
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
                                </div>
                              
            
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Feedback Channel</span>
                                    </label>
                                    <select name="feedback_channel" id="feedback_channel" aria-label="Select a Feedback Channel" data-control="select2" data-placeholder="Select a Feedback Channel..." class="form-select form-select-solid">
                                        <option  value="" selected>Select Option</option>
                                        <option  value="None" >All</option>
                                        @foreach($feedbackchannels as $feedbackchannel)
                                            <option  value="{{$feedbackchannel->id}}">{{$feedbackchannel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Age</span>
                                    </label>
                                    <select name="age" aria-label="Select a Age" data-control="select2" data-placeholder="Select a age..." class="form-select form-select-solid" id="age_id" >
                                        <option  value="">Select Option</option>
                                        <option  value="None" >All</option>
                                        <option value="Less than 18 years">Less than 18 years</option>
                                        <option value="19-50 years">19-50 years</option>
                                        <option value="Above 50 years">Above 50 years</option>
                                    </select>
            
                                </div>
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Gender</span>
                                    </label>
                                    <select name="gender" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a Gender..." class="form-select form-select-solid" id="gender" >
                                        <option  value="">Select Option</option>
                                        <option  value="None" >All</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Boy">Boy</option>
                                        <option value="Girl">Girl</option>
                                    </select>
            
                                </div>
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Province</span>
                                    </label>
                                    <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select form-select-solid">
                                        <option value="" selected>Select Province</option>
                                        <option  value="None" >All</option>
                                        <option value='4'>Sindh</option>
                                        <option value='2'>KPK</option>
                                        <option value='3'>Balochistan</option>
                                    </select>
            
                                </div>
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">District</span>
                                    </label>
                                    <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select form-select-solid">
            
                                    </select>
                                </div>
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Status</span>
                                    </label>
                                    <select   name="type_of_client" id="type_of_client" aria-label="Select a Status" data-control="select2" data-placeholder="Select a Status" class="form-select form-select-solid">
                                        <option value="" selected>Select Status</option>
                                        <option  value="None" >All</option>
                                        <option value="Open" >Open</option>
                                        <option value="Close" >Close</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Project</span>
                                    </label>
                                    <select name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select form-select-solid">
                                        <option value="" selected>Select Project</option>
                                          <option  value="None" >All</option>
                                        @foreach($projects as $project)
                                            <option  value="{{$project->id}}">{{$project->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
            
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
               
            </div>
         
            <div class="card-body pt-0 overflow-*">


                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="frm" style="width:100%">
                    <thead>
                        <tr>
                            <th>#S.No</th>
                            <th>Response.#</th>
                            <th>Name of Registrar</th>
                            <th>Date Recieved</th>
                            <th>Feedback Channel</th>
                            <th>Name</th>
                            <th>Type of Client</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Province</th>
                            <th>District</th>
                            <th>Tehsil</th>
                            {{-- <th>Union Council</th>
                            <th>Village</th>
                            <th>PWD/CLWD</th> --}}
                            <th>Client Contact.# </th>
                            <th>Feedback Category</th>
                            <th>Theme</th>
                            <th>Project</th>
                            <th>Date of Reffered</th>
                            <th>Refferal Name</th>
                            <th>Refferal Position</th>
                            <th>Satisfiction</th>
                            <th>Status</th>
                            {{-- <th>Feedback Summary</th> --}}
                            <th>Update Response</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @push("scripts")
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <!--end::Page Vendors-->
    <script>
        $('#date_recieved_id,#date_feedback_referred,#date_feedback_referred_id').flatpickr({
            altInput: true,
            dateFormat: "y-m-d",
            maxDate: "today"
		});
        $(document).on('click', 'th input:checkbox', function () {

           var that = this;
           $(this).closest('table').find('tr td:first-child input:checkbox')
               .each(function () {
                   this.checked = that.checked;
                   $(this).closest('tr').toggleClass('selected');
               });
        });
        var frm = $('#frm').DataTable( {
            "order": [
                [1, 'desc']
            ],
            responsive: true, // Enable responsive mode
            "processing": true,
            "serverSide": true,
            "searching": false,
            "responsive": false,
            'info': true,
           "ajax": {
               "url":"{{route('admin.getFrms')}}",
               "dataType":"json",
               "type":"POST",
               "data":{"_token":"<?php echo csrf_token() ?>"}
           },
            "columns":[
               {"data":"id","searchable":false,"orderable":false},
               {"data":"response_id" ,"searchable":false,"orderable":false},
               {"data":"name_of_registrar" },
               {"data":"date_received"},
               {"data":"feedback_channel","searchable":false,"orderable":false },
               {"data":"name_of_client"},
               {"data":"type_of_client"},
               {"data":"gender"},
               {"data":"age" },
               {"data":"province","searchable":false,"orderable":false },
               {"data":"district" ,"searchable":false,"orderable":false},
               {"data":"tehsil" ,"searchable":false,"orderable":false},
            //    {"data":"uc" ,"searchable":false,"orderable":false},
            //    {"data":"village","searchable":false,"orderable":false },
            //    {"data":"pwd_clwd","searchable":false,"orderable":false },
               {"data":"client_contact"},
               {"data":"feedback_category","searchable":false,"orderable":false },
               {"data":"theme" ,"searchable":false,"orderable":false},
               {"data":"project_name" ,"searchable":false,"orderable":false},
               {"data":"date_ofreferral" ,"searchable":false,"orderable":false},
               {"data":"referral_name" ,"searchable":false,"orderable":false},
               {"data":"referral_position"  ,"searchable":false,"orderable":false},
               {"data":"type_ofaction_taken" ,"searchable":false,"orderable":false},
               {"data":"status"},
            //  {"data":"feedback_summary" ,"searchable":false,"orderable":false},
               {"data":"update_response" ,"searchable":false,"orderable":false},
               {"data":"action","searchable":false,"orderable":false},
           ]
        });


        $("#response_id,#date_recieved_id,#kt_select2_district,#kt_select2_province,#feedback_channel,#name_of_registrar,#age_id,#gender,#type_of_client,#project_name").change(function () {
            var table = $('#frm').DataTable();
            table.destroy();
            var name_of_registrar = document.getElementById("name_of_registrar").value ?? '1';
            var date_received = document.getElementById("date_recieved_id").value
            var kt_select2_district = document.getElementById("kt_select2_district").value ?? '1';
            var kt_select2_province = document.getElementById("kt_select2_province").value ?? '1';
            var feedback_channel = document.getElementById("feedback_channel").value ?? '1';
            var age_id = document.getElementById("age_id").value ?? '1';
            var type_of_client = document.getElementById("type_of_client").value ?? '1';
            var project_name = document.getElementById("project_name").value ?? '1';
            var response_id = document.getElementById("response_id").value ?? '1';
            var gender = document.getElementById("gender").value ?? '1';

            var clients = $('#frm').DataTable( {
                "order": [
                    [1, 'asc']
                ],

                responsive: true, // Enable responsive mode
                "info": false,

                "processing": true,
                "serverSide": true,
                "searching": false,
                "responsive": false,
                'info': true,
                "ajax": {
                    "url":"{{ route('admin.getFrms') }}",
                    "dataType":"json",
                    "type":"POST",
                    "data":{"_token":"<?php echo csrf_token() ?>",
                            'name_of_registrar':name_of_registrar,
                            'date_received':date_received,
                            'kt_select2_district':kt_select2_district,
                            'kt_select2_province':kt_select2_province,
                            'feedback_channel':feedback_channel,
                            'age_id':age_id,
                            'type_of_client':type_of_client,
                            'project_name':project_name,
                            'response_id':response_id,
                            'gender':gender
                            }
                },
                "columns":[
                            {"data":"id","searchable":false,"orderable":false},
                            {"data":"response_id" ,"searchable":false,"orderable":false},
                            {"data":"name_of_registrar" },
                            {"data":"date_received","searchable":false,"orderable":false},
                            {"data":"feedback_channel","searchable":false,"orderable":false },
                            {"data":"name_of_client"},
                            {"data":"type_of_client"},
                            {"data":"gender"},
                            {"data":"age" },
                            {"data":"province","searchable":false,"orderable":false },
                            {"data":"district" ,"searchable":false,"orderable":false},
                            {"data":"tehsil" ,"searchable":false,"orderable":false},
                            // {"data":"uc" ,"searchable":false,"orderable":false},
                            // {"data":"village","searchable":false,"orderable":false },
                            // {"data":"pwd_clwd","searchable":false,"orderable":false },
                            {"data":"client_contact"},
                            {"data":"feedback_category","searchable":false,"orderable":false },
                            {"data":"theme" ,"searchable":false,"orderable":false},
                            {"data":"project_name" ,"searchable":false,"orderable":false},
                            {"data":"date_ofreferral" ,"searchable":false,"orderable":false},
                            {"data":"referral_name"},
                            {"data":"referral_position" },
                            {"data":"type_ofaction_taken" ,"searchable":false,"orderable":false},
                            {"data":"status"},
                            //  {"data":"feedback_summary" ,"searchable":false,"orderable":false},
                            {"data":"update_response" ,"searchable":false,"orderable":false},
                            {"data":"action","searchable":false,"orderable":false},
                        ]

            });
        });
        $('#date_recieved_id').flatpickr({
            altInput: true,
            mode: "range",
            dateFormat: "Y-m-d",
         
		});
        $("#kt_select2_province").change(function () {

            var value = $(this).val();
            csrf_token = $('meta[name="csrf-token"]').attr('content');

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
    </script>
    <!--end::Vendors Javascript-->
    @endpush


</x-default-layout>
