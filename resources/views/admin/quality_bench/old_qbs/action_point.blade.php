<x-default-layout>

    @section('title')
    QB {{$qb->unique_code ?? ''}}
    @endsection

    <div id="kt_app_content" class="app-content flex-column-fluid">
    
        <div class="card">
            <input type="hidden" name="id" value="{{$qb->id}}" id="qb_id">
          
            <div class="card-body pt-3">

                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="old_action_points" style="width:100%">
                    <thead>
                        <tr>
                            <th>Unique Code</th>
                            <th>Action Point Type</th>
                            <th>Issue/Gap Identified</th>
                            <th>Action To-make</th>
                            <th>Responsible Person</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>completion Date</th>
                            <th>Comments</th>
                            <th>Remarks</th>
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
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <!--end::Page Vendors-->
    <script>
        var qb_id = document.getElementById("qb_id").value;
        var frm = $('#old_action_points').DataTable( {
            "order": [
                [1, 'desc']
            ],
            "dom": 'lfBrtip',
            buttons: [
                'csv', 'excel'
            ],
            responsive: false, // Enable responsive mode
            "processing": true,
            "serverSide": true,
            "searching": false,
            "bLengthChange": false,
            "paging": false,
            "bInfo" : false,
            "responsive": false,
            "info": false,
           "ajax": {
               "url":"{{route('admin.get_old_action_points')}}",
               "dataType":"json",
               "type":"POST",
               "data":{"_token":"<?php echo csrf_token() ?>",
                        'qb_id':qb_id }
           },
            "columns":[
                            {"data":"unique_code","searchable":false,"orderable":false},
                            {"data":"type","searchable":false,"orderable":false},
                            {"data":"issue_gap","searchable":false,"orderable":false},
                            {"data":"action_to_make","searchable":false,"orderable":false},
                            {"data":"responsible_person","searchable":false,"orderable":false},
                            {"data":"deadline","searchable":false,"orderable":false},
                            {"data":"status","searchable":false,"orderable":false},
                            {"data":"completion_date","searchable":false,"orderable":false},
                            {"data":"comments","searchable":false,"orderable":false},
                            {"data":"remarks","searchable":false,"orderable":false},
                            {"data":"created_by","searchable":false,"orderable":false},
                            {"data":"created_at","searchable":false,"orderable":false},
                           
                        ]
        });[]

        
        // $("#date_visit, #kt_select2_province, #kt_select2_district, #project_name").change(function () {
        //     var table = $('#old_action_points').DataTable();
        //     table.destroy();
        //     var date_visit = document.getElementById("date_visit").value ?? '1';
        //     var kt_select2_district = document.getElementById("kt_select2_district").value ?? '1';
        //     var kt_select2_province = document.getElementById("kt_select2_province").value ?? '1';
        //     var project_name = document.getElementById("project_name").value ?? '1';

        //     var clients = $('#get_old_action_points').DataTable( {
        //         "order": [
        //             [1, 'asc']
        //         ],

        //         responsive: true, // Enable responsive mode
        //         "info": false,

        //         "processing": true,
        //         "serverSide": true,
        //         "searching": false,
        //         "responsive": false,
        //         "bLengthChange": false,
        //         "paging": false,
        //         "bInfo" : false,
        //         'info': false,
        //         "dom": 'lfBrtip',

        //         buttons: [
        //             'csv', 'excel'
        //         ],
        //         "ajax": {
        //             "url":"{{ route('admin.get_old_qbs') }}",
        //             "dataType":"json",
        //             "type":"POST",
        //             "data":{"_token":"<?php echo csrf_token() ?>",
        //                     'date_visit':date_visit,
        //                     'kt_select2_district':kt_select2_district,
        //                     'kt_select2_province':kt_select2_province,
        //                     'project_name':project_name
        //                     }
        //         },
        //        "columns":[
        //                     {"data":"unique_code","searchable":false,"orderable":false},
        //                     {"data":"type","searchable":false,"orderable":false},
        //                     {"data":"issue_gap","searchable":false,"orderable":false},
        //                     {"data":"action_to_make","searchable":false,"orderable":false},
        //                     {"data":"responsible_person","searchable":false,"orderable":false},
        //                     {"data":"deadline","searchable":false,"orderable":false},
        //                     {"data":"status","searchable":false,"orderable":false},
        //                     {"data":"completion_date","searchable":false,"orderable":false},
        //                     {"data":"comments","searchable":false,"orderable":false},
        //                     {"data":"remarks","searchable":false,"orderable":false},
        //                     {"data":"created_by","searchable":false,"orderable":false},
        //                     {"data":"created_at","searchable":false,"orderable":false},
        //                 ]

        //     });
        // });
     
     
        flatpickr("#date_visit", {
            mode: "range",
            dateFormat: "Y-m-d",
            maxDate: "today",
        });
    </script>
    <!--end::Vendors Javascript-->
    @endpush


</x-default-layout>
