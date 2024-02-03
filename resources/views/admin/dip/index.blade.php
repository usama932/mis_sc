<x-default-layout>

    @section('title')
        Project List
    @endsection

        <div id="kt_app_content" class="app-content flex-column-fluid">
          
            <div class="card">
                
           
                <div class="card-body pt-3">
    
                    <div class="table-responsive overflow-*">
                        <table class="table table-striped table-bordered nowrap" id="dips" style="width:100%">
                        <thead>
                            <tr>
                                <th>Dip</th>
                                <th>Project</th>
                                <th>Provinces</th>
                                <th>Disticts</th>
                                {{-- <th>Partners</th>
                                <th>Theme</th> --}}
                                <th>Project Tenure</th>
                                {{-- <th>attachment</th> --}}
                               
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
            
            var frm = $('#dips').DataTable( {
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
                "url":"{{route('admin.get_dips')}}",
                "dataType":"json",
                "type":"POST",
                "data":{"_token":"<?php echo csrf_token() ?>"}
            },
                "columns":[
                    {"data":"dip_add","searchable":false,"orderable":false},
                                {"data":"project","searchable":false,"orderable":false},
                                {"data":"province","searchable":false,"orderable":false},
                                {"data":"district","searchable":false,"orderable":false},
                                // {"data":"partner","searchable":false,"orderable":false},
                                // {"data":"theme","searchable":false,"orderable":false},
                                {"data":"project_tenure","searchable":false,"orderable":false},
                                // {"data":"attachment","searchable":false,"orderable":false},
                              
                                {"data":"action","searchable":false,"orderable":false},
                            ]
            });[]

            
            // $("#date_visit, #kt_select2_province, #kt_select2_district, #project_name").change(function () {
            //     var table = $('#project_details').DataTable();
            //     table.destroy();
            //     var date_visit = document.getElementById("date_visit").value ?? '1';
            //     var kt_select2_district = document.getElementById("kt_select2_district").value ?? '1';
            //     var kt_select2_province = document.getElementById("kt_select2_province").value ?? '1';
            //     var project_name = document.getElementById("project_name").value ?? '1';

            //     var clients = $('#project_details').DataTable( {
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
            //                     {"data":"project","searchable":false,"orderable":false},
            //                     {"data":"province","searchable":false,"orderable":false},
            //                     {"data":"district","searchable":false,"orderable":false},
            //                     {"data":"project_tenure","searchable":false,"orderable":false},
            //                     {"data":"project_submition","searchable":false,"orderable":false},
            //                     {"data":"attachment","searchable":false,"orderable":false},
            //                     {"data":"created_by","searchable":false,"orderable":false},
            //                     {"data":"created_at","searchable":false,"orderable":false},
            //                     {"data":"action","searchable":false,"orderable":false},
            //                 ]

            //     });
            // });
        
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
                        window.location.href = APP_URL + "/dip/delete/" + id;
                    }
                });
            }
            // flatpickr("#date_visit", {
            //     mode: "range",
            //     dateFormat: "Y-m-d",
            //     maxDate: "today",
            // });
        </script>
    @endpush


</x-default-layout>
