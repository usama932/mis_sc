<x-nform-layout>
    @section('title')
        {{$review->meeting_title}}/ Review Meetings Action Points
    @endsection
    <ol class="breadcrumb text-muted fs-6 fw-semibold mb-5">
        <li class="breadcrumb-item"><a href="{{route('get_project_index')}}" class="">Project Details</a></li>
        <li class="breadcrumb-item"><a href=" {{route('projectreviews.show',$review->project_id)}}">{{$review->meeting_title}}</a></li>
        <li class="breadcrumb-item text-muted"> Meetings Action Points</li>
    </ol>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        
        <div class="card-body pt-0 overflow-*">
            <input type="hidden"  value="{{$id}}" id="review_id" />
            <div class="table-responsive overflow-*">
                <table class="table table-striped table-bordered nowrap" id="project_reviews_action_point" style="width:100%">
                <thead>
                    <tr>
                        <th>#S.No</th>
                        <th>Action Point</th>
                        <th>Responsble Person</th>
                        <th>Action Agree</th> 
                        <th>Deadline</th> 
                        <th>Status</th>
                        <th>Created By</th> 
                        <th>Created At</th> 
                        <th>Action</th>
                    </tr>
                </thead>
                </table>
            </div>

        </div>
    </div>
    @push('scripts')
   <script>
        var baseURL = window.location.origin;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var review_id = document.getElementById("review_id").value ?? '1';
        var reviews = $('#project_reviews_action_point').DataTable( {
                    
            "dom": 'lfBrtip',
            buttons: [
                'csv', 'excel'
            ],
            "responsive": true, // Enable responsive mode
            "processing": true,
            "serverSide": true,
            "searching": false,
            "bLengthChange": true,
            "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
            "bInfo" : true,
            "responsive": false,
            "info": true,
            "ajax": {
                "url":"/project_reviews_actionpoint",
                "dataType":"json",
                "type":"POST",
                "data":{"_token":csrfToken,
                'review_id':review_id}
            },
            "columns":[
                            {"data":"id","searchable":false,"orderable":false},
                            {"data":"action_point","searchable":false,"orderable":false},
                            {"data":"responsible_person","searchable":false,"orderable":false},
                            {"data":"agreed_action" ,"searchable":false,"orderable":false},
                            {"data":"deadline" ,"searchable":false,"orderable":false},
                            {"data":"status" ,"searchable":false,"orderable":false},
                            {"data":"created_by" ,"searchable":false,"orderable":false},
                            {"data":"created_at" ,"searchable":false,"orderable":false},
                            {"data":"action","searchable":false,"orderable":false},
                        ]
        });
   </script>
   @endpush
</x-nform-layout>
