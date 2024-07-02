<x-nform-layout>
    @section('title')
       Add Activity Progress
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card mb-5">
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
                                        <select name="project" id="project" aria-label="Select a Project" data-control="select2" data-placeholder="Select a Project..." class="form-select" data-allow-clear="true">
                                            <option value=''>Select Project</option>
                                            @foreach($projects as $project)
                                                @if(!empty($project->detail))
                                                <option value='{{$project->id}}'>{{ucfirst($project->name)}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
            
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="dip_complete_activity" style="width:100%">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Activity Title</th>
                                <th>Sub Theme</th>
                                <th>Activity Type</th>
                                <th>Project</th>
                                <th>LOP Target</th>
                                <th>Month</th>
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push("scripts")
    <script>
          
        $(document).ready(function () {
            $('#project').change(function () {
                var table = $('#dip_complete_activity').DataTable();
                table.destroy();
                var dip_id =  $(this).val();;
                    var dip_activity = $('#dip_activity').DataTable( {
                        "order": [
                        [1, 'desc']
                    ],
                    "dom": 'lfBrtip',
                    buttons: [
                        'csv', 'excel'
                    ],
                    "responsive": true, // Enable responsive mode
                    "processing": true,
                    "serverSide": true,
                    "searching": false,
                    "bLengthChange": false,
                    "bInfo" : false,
                    "responsive": false,
                    "info": true,   
                    "ajax": {
                        "url":"{{route('admin.get_activity_dips')}}",
                        "dataType":"json",
                        "type":"POST",
                        "data":{"_token":"<?php echo csrf_token() ?>",
                                "dip_id":dip_id}
                    },
                    "columns":
                        [
                            {"data":"activity","searchable":false,"orderable":false},
                            {"data":"activity_number","searchable":false,"orderable":false},
                            {"data":"sub_theme","searchable":false,"orderable":false},
                            {"data":"activity_type","searchable":false,"orderable":false},
                            {"data":"project","searchable":false,"orderable":false},
                            {"data":"lop_target","searchable":false,"orderable":false},
                            {"data":"quarter_target","searchable":false,"orderable":false},
                            {"data":"created_by","searchable":false,"orderable":false},
                            {"data":"created_at","searchable":false,"orderable":false},
                           
                           
                        ]
                    });
            });
        });
        $(document).ready(function () {
          
            var table = $('#dip_complete_activity').DataTable();
            table.destroy();
            var dip_id =  $(this).val();;
                var dip_activity = $('#dip_complete_activity').DataTable( {
                    "order": [
                    [1, 'desc']
                ],
                "dom": 'lfBrtip',
                buttons: [
                    'csv', 'excel'
                ],
                "responsive": true, // Enable responsive mode
                "processing": true,
                "serverSide": true,
                "searching": false,
                "bLengthChange": false,
                "bInfo" : false,
                "responsive": false,
                "info": true,   
                "ajax": {
                    "url":"{{route('admin.get_activity_dips')}}",
                    "dataType":"json",
                    "type":"POST",
                    "data":{"_token":"<?php echo csrf_token() ?>",
                            "dip_id":dip_id }
                },
                "columns":
                    [
                        {"data":"activity","searchable":false,"orderable":false},
                        {"data":"activity_number","searchable":false,"orderable":false},
                        {"data":"sub_theme","searchable":false,"orderable":false},
                        {"data":"activity_type","searchable":false,"orderable":false},
                        {"data":"project","searchable":false,"orderable":false},
                        {"data":"lop_target","searchable":false,"orderable":false},
                        {"data":"quarter_target","searchable":false,"orderable":false},
                        {"data":"created_by","searchable":false,"orderable":false},
                        {"data":"created_at","searchable":false,"orderable":false},
                     
                     
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
            }).then(function(result) {
                if (result.value) {
                    Swal.fire(
                        "Deleted!",
                        "Your DIP has been deleted.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                    window.location.href = APP_URL + "/activity_dips/delete/" + id;
                }
            });
        }
    </script>
    @endpush
</x-nform-layout>
