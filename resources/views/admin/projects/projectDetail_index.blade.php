<x-default-layout>

    @section('title')
       Manage Project List    {{ auth()->user()->rolehas}}
    @endsection

        <div id="kt_app_content" class="app-content flex-column-fluid">
            
            <div class="card">
                @role('administrator')
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
                                            <div class="col-md-12 mt-3">
                                                <label class="fs-6 fw-semibold form-label mb-2">
                                                    <span class="required">Project</span>
                                                </label>
                                                <select name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select form-select-solid" >
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
                <div class="card-body pt-3">
    
                    <div class="table-responsive overflow-*">
                        <table class="table table-striped table-bordered nowrap" id="project_details" style="width:100%">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>SOF</th>
                                <th>Provinces</th>
                                <th>Disticts</th>
                                <th>Project Tenure</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
    
                </div>
            </div>
        </div>

    </div>
  

    @push("scripts")
        <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
        <script>
            
            var project = $('#project_details').DataTable( {
                "order": [
                    [1, 'desc']
                ],
                "dom": 'lfBrtip',
                buttons: [
                    'csv', 'excel'
                ],
                "processing": true,
                "serverSide": true,
                "searching": false,
                "bLengthChange": false,
                "paging": true,
                "bInfo" : false,
                "responsive": false,
                "info": false,
                "ajax": {
                    "url":"{{route('admin.get_project_details')}}",
                    "dataType":"json",
                    "type":"POST",
                    "data":{"_token":"<?php echo csrf_token() ?>"}
                },
                "columns":[
                                {"data":"project","searchable":false,"orderable":false},
                                {"data":"sof","searchable":false,"orderable":false},
                                {"data":"province","searchable":false,"orderable":false},
                                {"data":"district","searchable":false,"orderable":false},
                                {"data":"project_tenure","searchable":false,"orderable":false},
                              
                                {"data":"action","searchable":false,"orderable":false},
                            ]
            });[]

            $("#project_name").change(function () {
               ;
                var table = $('#project_details').DataTable();
                table.destroy();
                
                var project = document.getElementById("project_name").value ?? '1';
            
                var projects = $('#project_details').DataTable( {
                    "order": [
                        [1, 'desc']
                    ],
                    "dom": 'lfBrtip',
                    buttons: [
                        'csv', 'excel'
                    ],
                    "processing": true,
                    "serverSide": true,
                    "searching": false,
                    "bLengthChange": false,
                    "paging": true,
                    "bInfo" : false,
                    "responsive": false,
                    "info": false,
                    
                    "ajax": {
                        "url":"{{ route('admin.get_project_details') }}",
                        "dataType":"json",
                        "type":"POST",
                        "data":{"_token":"<?php echo csrf_token() ?>",
                            
                                'project':project
                                }
                    },
                "columns":[    {"data":"project","searchable":false,"orderable":false},
                                {"data":"sof","searchable":false,"orderable":false},
                                {"data":"province","searchable":false,"orderable":false},
                                {"data":"district","searchable":false,"orderable":false},
                                {"data":"project_tenure","searchable":false,"orderable":false},
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
