<x-default-layout>
    <style>
        .description-text, .full-text {
        display: inline;
        }
        .toggle-text {
            color: blue;
            cursor: pointer;
            margin-left: 5px;
        }
    </style>
    @section('title')
    View Project Detail
    @endsection
    <div class="card mb-4">
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
                <div id="collapseOne" class="accordion-collapse collapse mb-4" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card-header border-0">
                          @include('admin.projects.partials.project_basic_info')
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <div class="card p-3">
        <input type="hidden" id="project_id" value="{{$project->id}}">
      
      
            <ul class="nav nav-tabs mt-1 fs-6">
                
                <li class="nav-item">
                    <a class="nav-link  active " data-bs-toggle="tab" href="#thematic" >Thematic area</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " data-bs-toggle="tab" href="#partner">Implementing Partner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " data-bs-toggle="tab" href="#profile">Project Profile</a>
                </li>
                <li class="nav-item " >
                    <a class="nav-link text-success " data-bs-toggle="tab" href="#activities">Project Activities</a>
                </li>
            </ul>
           
            <div class="tab-content" id="myTabContent">
                
                
                <div class="tab-pane fade show  active " id="thematic" role="tabpanel">
                    <div  id="project_theme_table">
                     
                        <div class="table-responsive overflow-*">
                            <table class="table table-striped table-bordered nowrap" id="project_themes" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Theme</th>
                                    <th>Sub Theme</th>
                                    <th>House-Hold Target</th>
                                    <th>Individual Target</th>
                                    <th>Women Target</th>
                                    <th>Men Target</th>
                                    <th>Girls Target</th>
                                    <th>Boys Target</th>
                                    <th>PWD/CLWD Target</th>
                                    <th>PLW Target</th>
                                    <th>Other Target</th>
                                    {{-- <th>Created At</th>
                                    <th>Created By</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <div class="tab-pane fade show" id="partner" role="tabpanel">
                    <div   id="project_partner_table">
                      
                            <div class="table-responsive overflow-*">
                                <table class="table table-striped table-bordered nowrap" id="project_partners" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Theme</th>
                                        <th>Sub Theme</th>
                                        <th>Partner</th>
                                        <th>Email</th>
                                        <th>Province</th>
                                        <th>District</th>
                                        {{-- <th>Created At</th>
                                        <th>Created By</th> --}}
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                </table>
                            </div>
                       
                    </div>
                </div>
               
                <div class="tab-pane fade show" id="profile" role="tabpanel">
                    <div  id="project_partner_table">
                       
                            <div class="table-responsive overflow-*">
                                <table class="table table-striped table-bordered nowrap" id="project_profile" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Theme</th>
                                            <th>Province</th>
                                            <th>Districts</th>
                                            {{-- <th>Tehsil</th>
                                            <th>UC</th>
                                            <th>Village</th>  --}}
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        
                    </div>
                </div>
                <div class="tab-pane fade show " id="activities" role="tabpanel">
                    <div  id="project_partner_table">
                      
                        <div class="table-responsive overflow-*">
                            <table class="table table-striped table-bordered nowrap" id="dip_activity" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Activity. #</th>
                                        <th>Activity Title</th>
                                        <th>Theme</th>
                                        <th>Sub Theme</th>
                                        <th>Activity Type</th>
                                        <th>LOP Target</th>
                                        <th>Monthly Target</th>
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
        
    </div>
    @push('scripts')
    <script>
        var dip_id = document.getElementById("project_id").value ;
        var dip_activity = $('#dip_activity').DataTable( {
        buttons: [
            {
                extend: 'excelHtml5',
                filename: 'Activity Exports Data export_',
                text: '<i class="flaticon2-download"></i> Excel',
                title: 'Activity Exports',
                className: 'badge badge-success my-2',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5,6,7]
                }

            },

            {
                extend: 'csvHtml5',
                filename: 'Activity Exports CSV_',
                text: '<i class="flaticon2-download"></i> CSV',
                title: 'Activity Exports',
                className: 'badge badge-warning my-2',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5,6,7]
                }
            }
        ],
        "dom": 'lfBrtip',
        "processing": true,
        "serverSide": true,
        "searching": false,
        "bLengthChange": true,
        "aLengthMenu": [[10, 50, 100,200,300,500], [10, 50, 100,150,200,300,500]],
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
            "columns":[
                {"data":"activity","searchable":false,"orderable":false},
                {"data":"activity_number","searchable":false,"orderable":false},
                {"data":"theme","searchable":false,"orderable":false},
                {"data":"sub_theme","searchable":false,"orderable":false},
                {"data":"activity_type","searchable":false,"orderable":false},
                {"data":"lop_target","searchable":false,"orderable":false},
                {"data":"quarter_target","searchable":false,"orderable":false},
                {"data":"created_by","searchable":false,"orderable":false},
                {"data":"created_at","searchable":false,"orderable":false},
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
</x-default-layout>
