<x-nform-layout>
 
    @section('title')
        Edit Detail Implementation Plan
        
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
    
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-line-tabs m-5 fs-6">
                <li class="nav-item">
                    <a class="nav-link @if(session('active') == 'basic_info') active @endif " data-bs-toggle="tab" href="#kt_tab_pane_1">DIP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(session('active') == 'dip_activity') active @endif " data-bs-toggle="tab" href="#kt_tab_pane_2">DIP Activities</a>
                </li>
               
            </ul>
            
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade   @if(session('active') == 'basic_info') show active @endif" id="kt_tab_pane_1" role="tabpanel">
                   @include('admin.dip.edit_dip')
                </div>
                <div class="tab-pane fade @if(session('active') == 'dip_activity') show active @endif" id="kt_tab_pane_2" role="tabpanel">
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
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <script>
        var dip_id = document.getElementById("dip_id").value;
        
        var dip_activity = $('#dip_activity').DataTable( {
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
            "url":"{{route('admin.get_activity_dips')}}",
            "dataType":"json",
            "type":"POST",
            "data":{"_token":"<?php echo csrf_token() ?>",
                        dip_id:dip_id  }
            },
            "columns":[
                            {"data":"activity_number","searchable":false,"orderable":false},
                            {"data":"detail","searchable":false,"orderable":false},
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
                            "Your DIP Activity has been deleted.",
                            "success"
                        );
                        var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL + "/activity_dips/delete/" + id;
                    }
                });
            }
            function editInfo(id) {

                var CSRF_TOKEN = '{{ csrf_token() }}';
                $.post("{{ route('admin.edit_activity_dips') }}", {
                    _token: CSRF_TOKEN,
                    id: id
                }).done(function(response) {
                    $('.modal-body').html(response);
                    $('#dip_edit').modal('show');

                });
        }
        $('.edit_close').click(function() {
            $('#dip_edit').modal('hide');
        });
        $('.create_close').click(function() {
            $('.bd-example-modal-lg').modal('hide');
        });
    </script>

    @endpush

</x-nform-layout>
