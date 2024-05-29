<x-default-layout>

    @section('title')
    Monitoring Visits List
    @endsection

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card-toolbar m-5 d-flex justify-content-end">
            @can('create quality benchmarks')
                <!--begin::Button-->
                <a href="{{ route('quality-benchs.create') }}" class="btn btn-primary btn-sm font-weight-bolder">
                    <span class="svg-icon svg-icon-primary svg-icon-1x mx-1">
                        <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                                <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/>
                            </g>
                        </svg>
                    </span>Add Monitor Visit
                </a>
                <!--end::Button-->
            @endcan
        </div>
        
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
                                <div class="col-md-6 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Unique Code</span>
                                    </label>
                                    <input class="form-control" placeholder="Enter Assesment Code" id="assesment_code" name="assesment_code" >
                                </div>
                                <div class="col-md-6 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required" >Date Visit</span>
                                    </label>
                                    <input class="form-control" aria-label="Pick date range"  placeholder="Pick date range" id="date_visit" name="date_visit" value=" ">
                                </div>
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required"> Name of Staff</span>
                                    </label>
                                    <select name="visit_staff" id="visit_staff" aria-label="Select a Visit Staff" data-control="select2" data-placeholder="Select a  Visit Staff..." class="form-select  " data-allow-clear="true" >
                                        <option  value="" selected>Select a  Visit Staff</option>
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
                                        <span class="required">Accompanied By</span>
                                    </label>
                                    <select   name="accompanied_by" id="accompanied_by" aria-label="Select a Accompanied By" data-control="select2" data-placeholder="Select a Accompanied By" class="form-select  " data-allow-clear="true" >
                                        <option value="" selected>Select Accompanied By</option>
                                        <option  value="None" >All</option>
                                        <option  value="Project Staff">Project Staff</option>
                                        <option  value="Govt Officials">Govt Officials</option>
                                        <option  value="Donor">Donor</option>
                                        <option  value="NA">NA</option>
                                      
                                        
                                    </select>
                                </div>
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Type of Visit</span>
                                    </label>
                                    <select name="visit_type" id="visit_type" aria-label="Select a Visit Type" data-control="select2" data-placeholder="Select a Visit Type..." class="form-select  " data-allow-clear="true" >
                                        <option value="" selected>Select Visit Type</option>
                                        <option value="None">All</option>
                                        <option value="Independent">Independent</option>
                                        <option value="Joint">Joint</option>
                                    </select>
                                </div>
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Province</span>
                                    </label>
                                    <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select  " data-allow-clear="true" >
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
                                    <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select  " data-allow-clear="true" >
            
                                    </select>
                                </div>
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Project Type</span>
                                    </label>
                                    <select   name="project_type" id="project_type" aria-label="Select a Project Type" data-control="select2" data-placeholder="Select a Project Type" class="form-select  " data-allow-clear="true" >
                                        <option value="" selected>Select Project Type</option>
                                        <option  value="None" >All</option>
                                        <option value="Humanterian" >Humanterian</option>
                                        <option value="Development" >Development</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-3 my-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Staff Organization</span>
                                    </label>
                                    <select   name="partner" id="partner" aria-label="Select a Partner Name" data-control="select2" data-placeholder="Select a Partner" class="form-select" data-allow-clear="true" >
                                        <option value="">Select Partner Name</option>
                                        <option  value="LRF">LRF</option>
                                        <option  value="NRSP">NRSP</option>
                                        <option  value="PPHI">PPHI</option>
                                        <option  value="SRSP">SRSP</option>
                                        <option  value="TKF">TKF</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Project</span>
                                    </label>
                                    <select name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select  " data-allow-clear="true" >
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
                    <table class="table table-striped table-bordered nowrap" id="quality_bench" style="width:100%">
                    <thead>
                        <tr>
                            <th>#S.No</th>
                            <th>Project</th>
                            <th>Partner</th>
                            <th>Province</th>
                            <th>District</th>
                            <th>Theme</th>
                            <th>Activity</th>
                            <th>GeoLocations</th>
                            <th>Staff Organization</th>
                            <th>Date Visit</th>
                            <th class="fs-8">QB Base Monitoring</th>
                            <th>Total QBs</th>
                            <th>QBs Not Fully Met</th>
                            <th>QBs  Fully Met</th>
                            <th>QBs  Not Applicable</th>
                            <th>Score Out</th>
                            <th>QBs Status</th>
                            <th>Attachemnt</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    </table>
                </div>

            </div>
           
        </div>
        
    </div>
    <div class="modal fade" id="quality_benchmark" data-backdrop="static" tabindex="1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="quality_benchmark">Quality Bench Detail</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold close"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @push("scripts")
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <!--end::Page Vendors-->
    <script>
        var QBs = $('#quality_bench').DataTable( {
           
            "dom": 'lfBrtip',
            buttons: [
                'csv', 'excel'
            ],
            "responsive": true, // Enable responsive mode
            "processing": true,
            "serverSide": true,
            "searching": false,
            "bLengthChange": true,
            "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
            "bInfo" : true,
            "responsive": false,
            "info": true,
            "ajax": {
                "url":"{{route('admin.get_qbs')}}",
                "dataType":"json",
                "type":"POST",
                "data":{"_token":"<?php echo csrf_token() ?>"}
            },
            "columns":[
                            {"data":"assement_code","searchable":false,"orderable":false},
                            {"data":"project_name","searchable":false,"orderable":false},
                            {"data":"partner","searchable":false,"orderable":false},
                            {"data":"province","searchable":false,"orderable":false},
                            {"data":"district","searchable":false,"orderable":false},
                            {"data":"theme","searchable":false,"orderable":false},
                            {"data":"activity_description","searchable":false,"orderable":false},
                          
                            {"data":"village","searchable":false,"orderable":false},
                            {"data":"staff_organization","searchable":false,"orderable":false},
                            {"data":"date_visit","searchable":false,"orderable":false},
                            {"data":"qb_base","searchable":false,"orderable":false},
                            {"data":"total_qbs","searchable":false,"orderable":false},
                            {"data":"qbs_not_fully_met","searchable":false,"orderable":false},
                            {"data":"qbs_fully_met","searchable":false,"orderable":false},
                            {"data":"qb_not_applicable","searchable":false,"orderable":false},
                            {"data":"score_out","searchable":false,"orderable":false},
                            {"data":"qb_status","searchable":false,"orderable":false},
                            {"data":"attachment","searchable":false,"orderable":false},
                            {"data":"created_at" ,"searchable":false,"orderable":false},
                            {"data":"created_by" ,"searchable":false,"orderable":false},
                            {"data":"action","searchable":false,"orderable":false},
                        ]
        });

        function del(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    Swal.fire(
                        "Deleted!",
                        "Your Quality BenchMark` has been deleted.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                    window.location.href = APP_URL + "/qb/delete/" + id;
                }
            });
        }
        $("#date_visit,#assesment_code, #visit_staff,#partner, #accompanied_by, #visit_type, #kt_select2_province, #kt_select2_district, #project_type, #project_name").change(function () {
            var table = $('#quality_bench').DataTable();
            table.destroy();
            var date_visit = document.getElementById("date_visit").value ?? '1';
            var visit_staff = document.getElementById("visit_staff").value
            var kt_select2_district = document.getElementById("kt_select2_district").value ?? '1';
            var kt_select2_province = document.getElementById("kt_select2_province").value ?? '1';
            var accompanied_by = document.getElementById("accompanied_by").value ?? '1';
            var visit_type = document.getElementById("visit_type").value ?? '1';
            var project_type = document.getElementById("project_type").value ?? '1';
            var project_name = document.getElementById("project_name").value ?? '1';
            var partner = document.getElementById("partner").value ?? '1';
            var assesment_code = document.getElementById("assesment_code").value ?? '1';
            var qb = $('#quality_bench').DataTable( {
                "dom": 'lfBrtip',
                buttons: [
                    'csv', 'excel'
                ],
                "processing": true,
                "serverSide": true,
                "searching": false,
                "bLengthChange": true,
                "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                "bInfo" : false,
                "responsive": false,
                "info": true,

                
                "ajax": {
                    "url":"{{ route('admin.get_qbs') }}",
                    "dataType":"json",
                    "type":"POST",
                    "data":{"_token":"<?php echo csrf_token() ?>",
                            'date_visit':date_visit,
                            'visit_staff':visit_staff,
                            'kt_select2_district':kt_select2_district,
                            'kt_select2_province':kt_select2_province,
                            'accompanied_by':accompanied_by,
                            'visit_type':visit_type,
                            'project_type':project_type,
                            'project_name':project_name,
                            'partner':partner,
                            'assesment_code':assesment_code
                            }
                },
               "columns":[
                            {"data":"assement_code","searchable":false,"orderable":false},
                            {"data":"project_name","searchable":false,"orderable":false},
                            {"data":"partner","searchable":false,"orderable":false},
                            {"data":"province","searchable":false,"orderable":false},
                            {"data":"district","searchable":false,"orderable":false},
                            {"data":"theme","searchable":false,"orderable":false},
                            {"data":"activity_description","searchable":false,"orderable":false},
                            {"data":"village","searchable":false,"orderable":false},
                            {"data":"staff_organization","searchable":false,"orderable":false},
                            {"data":"date_visit","searchable":false,"orderable":false},
                            {"data":"qb_base","searchable":false,"orderable":false},
                            {"data":"total_qbs","searchable":false,"orderable":false},
                            {"data":"qbs_not_fully_met","searchable":false,"orderable":false},
                            {"data":"qbs_fully_met","searchable":false,"orderable":false},
                            {"data":"qb_not_applicable","searchable":false,"orderable":false},
                            {"data":"score_out","searchable":false,"orderable":false},
                            {"data":"qb_status","searchable":false,"orderable":false},
                            {"data":"attachment","searchable":false,"orderable":false},
                            {"data":"created_at" ,"searchable":false,"orderable":false},
                            {"data":"created_by" ,"searchable":false,"orderable":false},
                            {"data":"action","searchable":false,"orderable":false},
                        ]

            });
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
        $('.close').click(function() {
            $('#quality_benchmark').modal('hide');
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
