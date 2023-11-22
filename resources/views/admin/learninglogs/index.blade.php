<x-nform-layout>

    @section('title')
        Learning Logs
    @endsection

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="card-toolbar m-5 d-flex justify-content-end">

                <!--begin::Button-->
                <a href="{{ route('learning-logs.create') }}" class="btn btn-primary btn-sm font-weight-bolder">
                New Record</a>
                <!--end::Button-->
            </div>
            
            <div class="card-body pt-0 overflow-* rounded">

                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap " id="learninglogs" style="width:100% ">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Project</th>
                            <th>Project Type</th>
                            <th>Research Type</th>
                            <th>Thumbnail</th>
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
    <script>
        var frm = $('#learninglogs').DataTable( {
            "order": [
                [1, 'desc']
            ],
           
            responsive: true, // Enable responsive mode
            "processing": true,
            "serverSide": true,
            "searching": false,
            "bLengthChange": false,
            "bInfo" : false,
            "responsive": false,
            "info": false,
           "ajax": {
               "url":"{{route('admin.get_learninglogs')}}",
               "dataType":"json",
               "type":"POST",
               "data":{"_token":"<?php echo csrf_token() ?>"}
           },
            "columns":[
                            {"data":"title","searchable":false,"orderable":false},
                            {"data":"project","searchable":false,"orderable":false},
                            {"data":"project_type","searchable":false,"orderable":false},
                            {"data":"research_type","searchable":false,"orderable":false},
                            {"data":"thumbnail","searchable":false,"orderable":false},
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
                        "Your Learning Log has been deleted.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                    window.location.href = APP_URL + "/learninglog/delete/" + id;
                }
            });
        }
 
    
    </script>
    <!--end::Vendors Javascript-->
    @endpush


</x-nform-layout>
