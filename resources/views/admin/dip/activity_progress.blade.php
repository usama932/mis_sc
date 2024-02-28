<x-nform-layout>
    @section('title')
       Add Activity Progress
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row my-3" >
                    <div class="fv-row col-md-4">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Project</span>
                        </label>
                        <select name="project" id="project" aria-label="Select a Project" data-control="select2" data-placeholder="Select a Project..." class="form-select" data-allow-clear="true">
                            <option value=''>Select Focal Person</option>
                            @foreach($projects as $project)
                                <option value='{{$project->id}}'>{{ucfirst($project->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="dip_activity" style="width:100%">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Sub Theme</th>
                                <th>Project</th>
                                <th>LOP Target</th>
                                <th>Quarter</th>
                                <th>Created By</th>
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
    <script>
          
        $(document).ready(function () {
            $('#project').change(function () {
                var table = $('#dip_activity').DataTable();
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
                            {"data":"activity_number","searchable":false,"orderable":false},
                            {"data":"sub_theme","searchable":false,"orderable":false},
                            {"data":"project","searchable":false,"orderable":false},
                            {"data":"lop_target","searchable":false,"orderable":false},
                            {"data":"quarter_target","searchable":false,"orderable":false},
                            {"data":"created_by","searchable":false,"orderable":false},
                            {"data":"created_at","searchable":false,"orderable":false},
                            {"data":"action","searchable":false,"orderable":false},
                        ]
                    });
            });
        });
        $(document).ready(function () {
          
            var table = $('#dip_activity').DataTable();
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
                        {"data":"activity_number","searchable":false,"orderable":false},
                        {"data":"sub_theme","searchable":false,"orderable":false},
                            {"data":"project","searchable":false,"orderable":false},
                        {"data":"lop_target","searchable":false,"orderable":false},
                        {"data":"quarter_target","searchable":false,"orderable":false},
                        
                        {"data":"created_by","searchable":false,"orderable":false},
                        {"data":"created_at","searchable":false,"orderable":false},
                        {"data":"action","searchable":false,"orderable":false},
                    ]
                });
           
        });
    </script>
    @endpush
</x-nform-layout>
