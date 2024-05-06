<x-default-layout>
    @section('title')
    Add/Edit Project Details
    @endsection

    <div id="kt_app_content" class="app-content flex-column-fluid">

        
        <div class="card mb-4">
            @role('administrator')
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="d-flex align-items-center">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-50px me-5">
                                    <span class="symbol-label bg-light-danger">
                                        <i class="ki-duotone ki-filter-search fs-2x text-danger">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div class="d-flex flex-column">
                                    <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bold">Apply Filters</a>
                                </div>
                                <!--end::Text-->
                            </div>
                        </button>
                    </h3>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card-header border-0">
                                <div class="row mb-5">
                                    <div class="col-md-12 mt-3">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span>Project</span>
                                        </label>
                                        <select name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select form-select-solid">
                                            <option value="">Select Project</option>
                                            @foreach($projects as $project)
                                            <option value="{{$project->id}}">{{$project->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
        </div>
        <div class="card"> 
            <div class="card-body pt-3">
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="project_details">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Type</th>
                                <th>SOF</th>
                                <th>Provinces</th>
                                <th>Districts</th>
                                <th>Project Tenure</th>
                                <th>Actions</th>
                                <th>Extract DIP</th>
                                <th>Review Meeting</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    
    </div>

    @push("scripts")
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <script>
        var project = $('#project_details').DataTable({
            "dom": 'lfBrtip',
          
            buttons: [

                {

                    extend: 'excelHtml5',

                    filename: 'Identificatoin Data export_',

                    text: '<i class="flaticon2-download"></i> Excel',

                    title: '',

                    className: 'btn btn-outline-success',

                    exportOptions: {

                        columns: [1, 2, 3, 4, 5, 6, 7]

                    }

                },

                {

                    extend: 'csvHtml5',

                    filename: 'Identificatoin Data CSV_',

                    text: '<i class="flaticon2-download"></i> CSV',

                    title: '',

                    className: 'btn btn-outline-success',

                    exportOptions: {

                        columns: [1, 2, 3, 4, 5, 6, 7]

                    }

                }

            ],

            "processing": true,
            "serverSide": true,
            "searching": false,
            "bLengthChange": false,
            "paging": true,
            "bInfo": false,
            "responsive": false,
            "info": false,
            "ajax": {
                "url": "{{route('admin.get_project_details')}}",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?php echo csrf_token() ?>"
                }
            },
            "columns": [{
                    "data": "project",
                    "searchable": false,
                    "orderable": false,
                    "sorting": false
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
                    "data": "province",
                    "searchable": false,
                    "orderable": false
                },
                {
                    "data": "district",
                    "searchable": false,
                    "orderable": false
                },
                {
                    "data": "project_tenure",
                    "searchable": false,
                    "orderable": false
                },
                {
                    "data": "action",
                    "searchable": false,
                    "orderable": false
                },
                {
                "data": "project_activities",
                "searchable": false,
                "orderable": false
                },
                {
                    "data": "review_meeting",
                    "searchable": false,
                    "orderable": false
                },
                
            ]
                
        });
        project.order([]);
        $("#project_name").change(function() {

            var table = $('#project_details').DataTable();
            table.destroy();

            var project = document.getElementById("project_name").value ?? '1';

            var projects = $('#project_details').DataTable({

                "dom": 'lfBrtip',
                buttons: [
                    'csv', 'excel'
                ],
                "processing": true,
                "serverSide": true,
                "searching": false,
                "bLengthChange": false,
                "paging": true,
                "bInfo": false,
                "responsive": false,
                "info": false,

                "ajax": {
                    "url": "{{ route('admin.get_project_details') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        "_token": "<?php echo csrf_token() ?>",
                        'project': project
                    }
                },
                "columns": [{
                        "data": "project",
                        "searchable": false,
                        "orderable": false,
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
                        "data": "province",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "district",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "project_tenure",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "action",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "project_activities",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "review_meeting",
                        "searchable": false,
                        "orderable": false
                    },
                   
                ]

            });
            projects.order([]);
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
                        "Your Project has been deleted.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                    window.location.href = APP_URL + "/dip/delete/" + id;
                }
            });
        }
    </script>
    @endpush
</x-default-layout>
