<x-default-layout>

    @section('title')
      Before October'23 QB's
    @endsection

    <div id="kt_app_content" class="app-content flex-column-fluid">
    
        <div class="card">
            
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
                               
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required" >Date Visit</span>
                                    </label>
                                    <input  data-allow-clear="true"  class="form-control form-control-solid" aria-label="Pick date range"  placeholder="Pick date range" id="date_visit" name="date_visit" value=" ">
                                </div>
                               
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Province</span>
                                    </label>
                                    <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select form-select-solid"  data-allow-clear="true" >
                                        <option value="" selected>Select Province</option>
                                        <option  value="None" >All</option>
                                        <option value='Sindh'>Sindh</option>
                                        <option value='KP'>KP</option>
                                        <option value='Balochistan'>Balochistan</option>
                                    </select>
            
                                </div>
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">District</span>
                                    </label>
                                    <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select form-select-solid"  data-allow-clear="true" >
                                        <option  value=""  selected>Select District</option>
                                        <option  value="Chaman" >Chaman</option>
                                        <option  value="Dadu" >Dadu</option>
                                        <option  value="Jacobabad" >Jacobabad</option>
                                        <option  value="Khairpur" >Khairpur</option>
                                        <option  value="Naseerabad" >Naseerabad</option>
                                        <option  value="Peshawar" >Peshawar</option>
                                        <option  value="Quetta" >Quetta</option>
                                        <option  value="Sanghar" >Sanghar</option>
                                        <option  value="Shikarpur" >Shikarpur</option>
                                        <option  value="Swat" >Swat</option>
                                        <option  value="Thatta" >Thatta</option>
                                        

                                    </select>
                                </div>
                               
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Project</span>
                                    </label>
                                    <select name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select form-select-solid" >
                                    <option value="" selected>Select Project</option>
                                        <option  value="None" >All</option>
                                        <option  value="DEC II" >DEC II</option>
                                        <option  value="ECHO Project" >ECHO Project</option>
                                        <option  value="EU" >EU</option>
                                        <option  value="Hunger Fund" >Hunger Fund</option>
                                        <option  value="SWS II" >SWS II</option>
                                        <option  value="SWS II" >All</option>
                                        <option  value="DEC" >DEC</option>
                                        <option  value="CONNECT-II" >CONNECT-II</option>
                                        <option  value="VaC-RIEP" >VaC-RIEP</option>
                                        <option  value="HC Canada" >HC Canada</option>
                                        <option  value="HUM Response 2022" >HUM Response 2022</option>
                                        <option  value="HBCC II" >HBCC II</option>
                                        <option  value="HBCC II" >HBCC II</option>
                                        <option  value="HKDRF" >HKDRF</option>
                                        <option  value="UNIFOR" >UNIFOR</option>
                                        <option  value="MCIC" >MCIC</option>
                                        <option  value="SWS" >SWS</option>
                                        <option  value="CDP" >CDP</option>
                                    </select>
                                </div>
            
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
               
            </div>
            <div class="card-body pt-3">

                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="old_quality_bench" style="width:100%">
                    <thead>
                        <tr>
                            <th>Unique Code</th>
                            <th>QB Moniterized</th>
                            <th>Project</th>
                            <th>Partner Name</th>
                            <th>Province</th>
                            <th>District</th>
                            <th>theme</th>
                            <th>Sub Theme</th>
                            <th>Activity</th>
                            <th>GeoLocations</th>
                            <th>Date Visit</th>
                            <th>Total QBs</th>
                            <th>QBs Not Fully Met</th>
                            <th>QBs  Fully Met</th>
                            <th>QBs  Not Applicable</th>
                            <th>Score Out</th>
                            <th>QBs Status</th>
                            <th>Completed By</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Action Points/GB</th>
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
        
        var frm = $('#old_quality_bench').DataTable( {
            "order": [
                [1, 'desc']
            ],
            "dom": 'lfBrtip',
            buttons: [
                'csv', 'excel'
            ],
            responsive: true, // Enable responsive mode
            "processing": true,
            "serverSide": true,
            "searching": false,
            "bLengthChange": false,
            "paging": false,
            "bInfo" : false,
            "responsive": false,
            "info": false,
           "ajax": {
               "url":"{{route('admin.get_old_qbs')}}",
               "dataType":"json",
               "type":"POST",
               "data":{"_token":"<?php echo csrf_token() ?>"}
           },
            "columns":[
                            {"data":"unique_code","searchable":false,"orderable":false},
                            {"data":"qb_moniterized","searchable":false,"orderable":false},
                            {"data":"project","searchable":false,"orderable":false},
                            {"data":"partner","searchable":false,"orderable":false},
                            {"data":"province","searchable":false,"orderable":false},
                            {"data":"district","searchable":false,"orderable":false},
                            {"data":"theme","searchable":false,"orderable":false},
                            {"data":"sub-theme","searchable":false,"orderable":false},
                            {"data":"activity","searchable":false,"orderable":false},
                            {"data":"village","searchable":false,"orderable":false},
                            {"data":"date_visit","searchable":false,"orderable":false},
                            {"data":"total_qbs","searchable":false,"orderable":false},
                            {"data":"total_qbs_not_met","searchable":false,"orderable":false},
                            {"data":"total_qbs_met","searchable":false,"orderable":false},
                            {"data":"not_applicable","searchable":false,"orderable":false},
                            {"data":"score_out","searchable":false,"orderable":false},
                            {"data":"qb_status","searchable":false,"orderable":false},
                            {"data":"completed_by","searchable":false,"orderable":false},
                            {"data":"created_at" ,"searchable":false,"orderable":false},
                            {"data":"created_by" ,"searchable":false,"orderable":false},
                            {"data":"action","searchable":false,"orderable":false},
                        ]
        });[]

        
        $("#date_visit, #kt_select2_province, #kt_select2_district, #project_name").change(function () {
            var table = $('#old_quality_bench').DataTable();
            table.destroy();
            var date_visit = document.getElementById("date_visit").value ?? '1';
            var kt_select2_district = document.getElementById("kt_select2_district").value ?? '1';
            var kt_select2_province = document.getElementById("kt_select2_province").value ?? '1';
            var project_name = document.getElementById("project_name").value ?? '1';

            var clients = $('#old_quality_bench').DataTable( {
                "order": [
                    [1, 'asc']
                ],

                responsive: true, // Enable responsive mode
                "info": false,

                "processing": true,
                "serverSide": true,
                "searching": false,
                "responsive": false,
                "bLengthChange": false,
                "paging": false,
                "bInfo" : false,
                'info': false,
                "dom": 'lfBrtip',

                buttons: [
                    'csv', 'excel'
                ],
                "ajax": {
                    "url":"{{ route('admin.get_old_qbs') }}",
                    "dataType":"json",
                    "type":"POST",
                    "data":{"_token":"<?php echo csrf_token() ?>",
                            'date_visit':date_visit,
                            'kt_select2_district':kt_select2_district,
                            'kt_select2_province':kt_select2_province,
                            'project_name':project_name
                            }
                },
               "columns":[
                {"data":"unique_code","searchable":false,"orderable":false},
                            {"data":"qb_moniterized","searchable":false,"orderable":false},
                            {"data":"project","searchable":false,"orderable":false},
                            {"data":"partner","searchable":false,"orderable":false},
                            {"data":"province","searchable":false,"orderable":false},
                            {"data":"district","searchable":false,"orderable":false},
                            {"data":"theme","searchable":false,"orderable":false},
                            {"data":"sub-theme","searchable":false,"orderable":false},
                            {"data":"activity","searchable":false,"orderable":false},
                            {"data":"village","searchable":false,"orderable":false},
                            {"data":"date_visit","searchable":false,"orderable":false},
                            {"data":"total_qbs","searchable":false,"orderable":false},
                            {"data":"total_qbs_not_met","searchable":false,"orderable":false},
                            {"data":"total_qbs_met","searchable":false,"orderable":false},
                            {"data":"not_applicable","searchable":false,"orderable":false},
                            {"data":"score_out","searchable":false,"orderable":false},
                            {"data":"qb_status","searchable":false,"orderable":false},
                            {"data":"completed_by","searchable":false,"orderable":false},
                            {"data":"created_at" ,"searchable":false,"orderable":false},
                            {"data":"created_by" ,"searchable":false,"orderable":false},
                            {"data":"action","searchable":false,"orderable":false},
                        ]

            });
        });
     
     
        flatpickr("#date_visit", {
            mode: "range",
            dateFormat: "Y-m-d",
            maxDate: "today",
        });
    </script>
    <!--end::Vendors Javascript-->
    @endpush


</x-default-layout>
