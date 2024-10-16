<x-nform-layout>

    @section('title ')
        Add Project Activities & Targets
    @endsection
    
    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <input type="hidden" id="project_id" value="{{$project->id}}">
      
        <ul class="nav nav-tabs nav-line-tabs m-5 fs-6">
            <li class="nav-item">
                <a class="nav-link @if(session('dip_edit') != 'dip_activity') active @endif " data-bs-toggle="tab" href="#kt_tab_pane_1">Project Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(session('dip_edit') == 'dip_activity') active @endif " data-bs-toggle="tab" href="#kt_tab_pane_2">Activities</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade @if(session('dip_edit') != 'dip_activity') show active @endif px-5" id="kt_tab_pane_1" role="tabpanel">
                @include('admin.projects.partials.project_basic_info')
            </div>

            <div class="tab-pane fade @if(session('dip_edit') == 'dip_activity') show active @endif" id="kt_tab_pane_2" role="tabpanel">
                @include('admin.dip.dip_activity')
            </div>   
        </div>
       
        <div class="modal fade" id="dip_edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Dip Activity</h5>
                        <button type="button" class="edit_close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input value="{{$project->id}}" id="dip_id" name="dip_id" type="hidden">
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            var dip_id = document.getElementById("project_id").value ;
            var dip_activity = $('#dip_activity').DataTable( {
                "dom": 'lfBrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        filename: 'Project Profile Data export_',
                        text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                        title: 'Themetic area Data export',
                        className: 'badge badge-outline-success',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        filename: 'Project Profile Data CSV_',
                        text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
                        title: 'Themetic area Data',
                        className: 'badge badge-outline-success ',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                        }
                    }
                ],
              
                "processing": false,
                "serverSide": false,
                "searching": true,
                "ordering": true,
                "bLengthChange": true,
                "aLengthMenu": [[10, 50, 100, 250,500,750,1000], [10, 50,250,500,750,1000]],
                "bInfo" : true,
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
                {"data":"activity","searchable":true,"orderable":true},
                {"data":"activity_number","searchable":true,"orderable":true},
                {"data":"theme","searchable":true,"orderable":true},
                {"data":"sub_theme","searchable":true,"orderable":true},
                {"data":"activity_type","searchable":true,"orderable":true},
                {"data":"lop_target","searchable":true,"orderable":false},
                {"data":"quarter_target","searchable":true,"orderable":false},
                {"data":"created_by","searchable":true,"orderable":true},
                {"data":"created_at","searchable":true,"orderable":false},
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
                            "Your Activity has been deleted.",
                            "success"
                        );
                        var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL + "/activity_dips/delete/" + id;
                    }
                });
            }
            var project_id = document.getElementById("project_id").value ?? '1';
            var project_partners = $('#project_partners').DataTable({
                "processing": true,
                "serverSide": false,
                "searching": true,
                "ordering": true,
                "bLengthChange": true,
                "aLengthMenu": [[10, 50, 100, 250], [10, 50,250]],
                "bInfo" : true,
                "responsive": false,
                "info": true,
                "ajax": {
                    "url": "/project_partners",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "<?php echo csrf_token() ?>",
                        'project_id': project_id
                    }
                },
                "columns": [
                    {
                        "data": "themes",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": "sub_themes",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": "partner",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": "email",
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
                ]
            });
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var project_id = document.getElementById("project_id").value ?? '1';
            var project_theme = $('#project_themes').DataTable({
                "dom": 'lfBrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        filename: 'Overdue Progress Activities',
                        text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                        title: 'Overdue Progress Activities',
                        className: 'badge badge-success mb-4',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7,8]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        filename: 'Overdue Progress Activities',
                        text: '<i class="fa fa-download text-warning"></i> CSV',
                        title: 'Overdue Progress Activities',
                        className: 'badge badge-success',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7,8]
                        }
                    }
                ],
                "processing": true,
                "serverSide": false, // Disable server-side processing
                "searching": true, // Enable client-side searching
                "ordering": true, // Enable client-side sorting
                "paging": true, // Enable pagination
                "info": true, // Show table information
                "bLengthChange": true,
                "aLengthMenu": [[10, 50, 100, 250, 500, 750, 1000, 1500, 2000, 2500], [10, 50, 100, 250, 500, 750, 1000, 1500, 2000, 2500]],
            
                "ajax": {
                    "url": "/project_themes",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "<?php echo csrf_token() ?>",
                        'project_id': project_id
                    }
                },
                "columns": [
                    {
                        "data": "theme",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": "sub_theme",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": "house_hold_target",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "individual_target",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "women_target",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "men_target",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "boys_target",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "girls_target",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "pwd_target",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "plw_target",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "other",
                        "searchable": false,
                        "orderable": false
                    },
                ]
            });
            var project_profiles = $('#project_profile').DataTable({
                "order": [
                    [1, 'desc']
                ],
                "dom": 'lfBrtip',
                "dom": 'lfBrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        filename: 'Project Profile Data export_',
                        text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                        title: 'Themetic area Data export',
                        className: 'badge badge-outline-success',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        filename: 'Project Profile Data CSV_',
                        text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
                        title: 'Themetic area Data',
                        className: 'badge badge-outline-success ',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                        }
                    }
                ],
                "responsive": true, // Enable responsive mode
                "processing": true,
                "serverSide": false,
                "searching": true,
                "bLengthChange": true,
                "aLengthMenu": [[10, 50, 100, 250], [10, 50, 100, 250]],
                "bInfo" : true,
                "responsive": false,
                "info": true,
                "ajax": {

                    "url": "/project_profile",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: csrfToken,
                        'project_id': project_id
                    }
                },
                "columns": [
                    
                    {
                        "data": "theme",
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
                    // {
                    //     "data": "tehsil",
                    //     "searchable": false,
                    //     "orderable": false
                    // },
                    // {
                    //     "data": "uc",
                    //     "searchable": false,
                    //     "orderable": false
                    // },
                    // {
                    //     "data": "village",
                    //     "searchable": false,
                    //     "orderable": false
                    // },
                    
                    {
                        "data": "action",
                        "searchable": false,
                        "orderable": false
                    },
                ]
            });
            
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const shortDescription = document.getElementById('short-description');
                const fullDescription = document.getElementById('full-description');
                const toggleButton = document.getElementById('toggle-button');
        
                toggleButton.addEventListener('click', function () {
                    if (fullDescription.style.display === 'none') {
                        fullDescription.style.display = 'block';
                        shortDescription.style.display = 'none';
                        toggleButton.textContent = 'Show Less';
                    } else {
                        fullDescription.style.display = 'none';
                        shortDescription.style.display = 'block';
                        toggleButton.textContent = 'Show More';
                    }
                });
            });
        </script>
        
    @endpush

</x-nform-layout>
