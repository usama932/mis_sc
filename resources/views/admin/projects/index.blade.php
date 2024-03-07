<x-default-layout>

    @section('title', 'Projects')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card-toolbar m-5 d-flex justify-content-end">
            @can('create projects')
                <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm font-weight-bolder">
                    <span class="svg-icon svg-icon-primary svg-icon-1x mx-1">
                        <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                                <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/>
                            </g>
                        </svg>
                    </span>Add Project
                </a>
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
                                    <div class="col-md-3 mt-3">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="">Project</span>
                                        </label>
                                        <select name="project" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select form-select-solid" data-allow-clear="true">
                                            <option value="">Select Project</option>
                                            @foreach($projects as $project)
                                                <option value="{{$project->id}}">{{$project->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <label class="fs-6 fw-semibold form-label mb-2 ">
                                            <span class="required"> Start Date</span>
                                        </label>
                                        <div class="input-group ">
                                            <input type="text" name="startdate" id="start_date" placeholder="Select date" class="form-control" data-provide="datepicker" value="">
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                            <span class="required"> End Date</span>
                                        </label>
                                        <div class="input-group ">
                                            <input type="text" name="enddate" id="end_date" placeholder="Select date" class="form-control" data-provide="datepicker" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-5">
                                        <button id="reset-date" class="btn btn-primary btn-sm mt-5">Reset</button>

                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="projects" style="width:100%">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Type</th>
                                <th>SOF</th>
                                <th>Donor</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Created By</th>
                                <th>Creation Date/Time</th>
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
            var projects = $('#projects').DataTable({
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
                "paging": true,
                "bInfo": false,
                "responsive": false,
                "info": false,
                "ajax": {
                    "url": "{{route('admin.get_projects')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        "_token": "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                        "data": "project",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "type",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "sof",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "donor",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "start_date",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "end_date",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "created_by",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "created_at",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "action",
                        "searchable": false,
                        "orderable": false
                    },
                ]
            });
          
            flatpickr("#start_date", {
                dateFormat: "Y-m-d",
                maxDate: "today",
            });
            flatpickr("#end_date", {
                dateFormat: "Y-m-d",
            });

            $('#clearStartDate').click(function () {
                $('#start_date').val('');
            });

            $('#clearEndDate').click(function () {
                $('#end_date').val('');
            });

            $("#project_name,#start_date,#end_date").change(function () {
            
            var table = $('#projects').DataTable();
            table.destroy();
            
            var project = document.getElementById("project_name").value ?? '1';
            var start_date = document.getElementById("start_date").value ?? '1';
            var end_date = document.getElementById("end_date").value ?? '1';
         
            var projects = $('#projects').DataTable( {
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
                "paging": true,
                "bInfo" : false,
                "responsive": false,
                "info": false,
              
                "ajax": {
                    "url":"{{ route('admin.get_projects') }}",
                    "dataType":"json",
                    "type":"POST",
                    "data":{"_token":"<?php echo csrf_token() ?>",
                        
                            'project':project,
                            'startdate':start_date,
                            'enddate':end_date
                            }
                },
               "columns":[
                            {"data":"project","searchable":false,"orderable":false},
                            {"data":"type","searchable":false,"orderable":false},
                            {"data":"sof","searchable":false,"orderable":false},
                            {"data":"donor","searchable":false,"orderable":false},
                            {"data":"start_date","searchable":false,"orderable":false},
                            {"data":"end_date","searchable":false,"orderable":false},
                            {"data":"created_by","searchable":false,"orderable":false},
                            {"data":"created_at","searchable":false,"orderable":false},
                            {"data":"action","searchable":false,"orderable":false},
                        ]

            });
            });

            function del(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire(
                            "Deleted!",
                            "Your Project has been deleted.",
                            "success"
                        );
                        var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL + "/project/delete/" + id;
                    }
                });
            }
            $("#reset-date").click(function(){
                $('#project_name').val(null).trigger('change'),
                $('#start_date').val("");
                $('#end_date').val("").trigger('change');
                if (typeof projects !== 'undefined' && $.fn.DataTable.isDataTable(projects)) {
                    projects.ajax.reload(null, false).draw(false);
                } else {
                    console.error('Error: DataTables instance "projects" is either not defined or not properly initialized.');
                }
            })
        </script>
        <!--end::Vendors Javascript-->
    @endpush

</x-default-layout>
