<x-default-layout>

    @section("stylesheets")
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link href="{{asset("assets/plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css" />
    @endsection
    
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            {{-- <div class="card-title m-5">
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
            <div class="card-header border-0 pt-6">
                <div class="row mb-5">
                    <div class="col-md-3 my-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Staff Name</span>
                        </label>
                        <select name="name_of_registrar" id="name_of_registrar" aria-label="Select a Registrar Name" data-control="select2" data-placeholder="Select a Registrar Name..." class="form-select form-select-solid" >
                            <option  value="" selected>Select Option</option>
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
                            <span class="required" >Date Received</span>
                        </label>
                        <input type="text" name="date_received" id="date_recieved_id" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                    </div>

                    <div class="col-md-3 my-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Channel</span>
                        </label>
                        <select name="feedback_channel" id="feedback_channel" aria-label="Select a Feedback Channel" data-control="select2" data-placeholder="Select a Feedback Channel..." class="form-select form-select-solid">
                            <option  value="" selected>Select Option</option>
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
                            <option value="Less than 18 years">Less than 18 years</option>
                            <option value="19-50 years">19-50 years</option>
                            <option value="Above 50 years">Above 50 years</option>
                        </select>

                    </div>
                    <div class="col-md-3 my-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Province</span>
                        </label>
                        <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select form-select-solid">
                            <option value="" selected>Select Province</option>
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
                            @foreach($projects as $project)
                                <option  value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div> --}}
            <div class="card-body pt-0 overflow-*">


                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="quality_bench" style="width:100%">
                    <thead>
                        <tr>
                            <th>#S.No</th>
                            <th>Name of Staff</th>
                            <th>Date Visit</th>
                            <th>Accompanied By</th>
                            <th>Type of Visit</th>
                            <th>Province</th>
                            <th>District</th>
                            <th>Project Type</th>
                            <th>Project</th>
                            <th>Monitoring By</th>
                            <th>Created At</th>
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
        var frm = $('#quality_bench').DataTable( {
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
               "url":"{{route('admin.get_qbs')}}",
               "dataType":"json",
               "type":"POST",
               "data":{"_token":"<?php echo csrf_token() ?>"}
           },
            "columns":[
                            {"data":"id","searchable":false,"orderable":false},
                            {"data":"visit_staff_name"},
                            {"data":"date_visit","searchable":false,"orderable":false},
                            {"data":"accompanied_by" },
                            {"data":"type_of_visit"},
                            {"data":"province"},
                            {"data":"district"},
                            {"data":"project_type" },
                            {"data":"project_name"},
                            {"data":"created_at" ,"searchable":false,"orderable":false},
                            {"data":"action","searchable":false,"orderable":false},
                        ]
        });


        // $("#date_recieved_id,#kt_select2_district,kt_select2_province,#feedback_channel,#name_of_registrar,#age_id,#type_of_client,#project_name").change(function () {
        //     var table = $('#frm').DataTable();
        //     table.destroy();
        //     var name_of_registrar = document.getElementById("name_of_registrar").value ?? '1';
        //     var date_received = document.getElementById("date_recieved_id").value
        //     var kt_select2_district = document.getElementById("kt_select2_district").value ?? '1';
        //     var kt_select2_province = document.getElementById("kt_select2_province").value ?? '1';
        //     var feedback_channel = document.getElementById("feedback_channel").value ?? '1';
        //     var age_id = document.getElementById("age_id").value ?? '1';
        //     var type_of_client = document.getElementById("type_of_client").value ?? '1';
        //     var project_name = document.getElementById("project_name").value ?? '1';

        //     var clients = $('#frm').DataTable( {
        //         "order": [
        //             [1, 'asc']
        //         ],

        //         responsive: true, // Enable responsive mode
        //         "info": false,

        //         "processing": true,
        //         "serverSide": true,
        //         "searching": false,
        //         "responsive": false,
        //         'info': true,
        //         "ajax": {
        //             "url":"{{ route('admin.getFrms') }}",
        //             "dataType":"json",
        //             "type":"POST",
        //             "data":{"_token":"<?php echo csrf_token() ?>",
        //                     'name_of_registrar':name_of_registrar,
        //                     'date_received':date_received,
        //                     'kt_select2_district':kt_select2_district,
        //                     'kt_select2_province':kt_select2_province,
        //                     'feedback_channel':feedback_channel,
        //                     'age_id':age_id,
        //                     'type_of_client':type_of_client,
        //                     'project_name':project_name
        //                     }
        //         },
        //         "columns":[
        //                     {"data":"id","searchable":false,"orderable":false},
        //                     {"data":"visit_staff_name"},
        //                     {"data":"date_visit","searchable":false,"orderable":false},
        //                     {"data":"accompanied_by" },
        //                     {"data":"type_of_visit"},
        //                     {"data":"province"},
        //                     {"data":"district"},
        //                     {"data":"project_type" },
        //                     {"data":"project_name"},
        //                     {"data":"created_at" ,"searchable":false,"orderable":false},
        //                     {"data":"action","searchable":false,"orderable":false},
        //                 ]

        //     });
        // });
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