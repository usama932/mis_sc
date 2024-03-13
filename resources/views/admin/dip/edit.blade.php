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
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-line-tabs m-5 fs-6">
                <li class="nav-item">
                    <a class="nav-link @if(session('dip_edit') != 'dip_activity') active @endif " data-bs-toggle="tab" href="#kt_tab_pane_1">Project Information</a>
                </li>
                <li class="nav-item">
                    
                    <a class="nav-link @if(session('dip_edit') == 'dip_activity') active @endif " data-bs-toggle="tab" href="#kt_tab_pane_2"> Activities</a>
                </li>
               
            </ul>
            
            <div class="tab-content" id="myTabContent">
             
                <div class="tab-pane fade   @if(session('dip_edit') != 'dip_activity') show active   @endif" id="kt_tab_pane_1" role="tabpanel">
                   @include('admin.dip.edit_dip')
                </div>
                <div class="tab-pane fade @if(session('dip_edit') == 'dip_activity') show active @endif" id="kt_tab_pane_2" role="tabpanel">
                    @include('admin.dip.dip_activity')
                </div>   
            </div>
        </div>
        <div class="modal fade" id="dip_edit" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Dip Activity</h5>
                        <button type="button" class="edit_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input value="{{$project->id}}"id="dip_id" name="dip_id" type="hidden">
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
                "order": [
                [1, 'desc']
                ],
                "dom": 'lfBrtip',
                buttons: [
                    'csv', 'excel'
                ],
            
                "responsive": false, // Enable responsive mode
                "processing": true,
                "serverSide": true,
                "searching": false,
                "bLengthChange": false,
                "bInfo" : false,
                "info": true,   
                "ajax": {
                "url":"{{route('admin.get_activity_dips')}}",
                "dataType":"json",
                "type":"POST",
                "data":{"_token":"<?php echo csrf_token() ?>",
                        "dip_id":dip_id}
                },
                "columns":[
                    {"data":"activity_number","searchable":false,"orderable":false,"width": "10%",},
                    {"data":"sub_theme","searchable":false,"orderable":false},
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
                "bInfo": false,
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
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "sub_themes",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "partner",
                        "searchable": false,
                        "orderable": false
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
                    // {
                    //     "data": "created_at",
                    //     "searchable": false,
                    //     "orderable": false
                    // },
                    // {
                    //     "data": "created_by",
                    //     "searchable": false,
                    //     "orderable": false
                    // },
                  
                ]
            });
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var project_id = document.getElementById("project_id").value ?? '1';
            var project_theme = $('#project_themes').DataTable({
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
                "bInfo": false,
                "responsive": false,
                "info": true,
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
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "sub_theme",
                        "searchable": false,
                        "orderable": false
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
                    // {
                    //     "data": "created_at",
                    //     "searchable": false,
                    //     "orderable": false
                    // },
                    // {
                    //     "data": "created_by",
                    //     "searchable": false,
                    //     "orderable": false
                    // },
                   
                ]
            });
        </script>
    @endpush

</x-nform-layout>
