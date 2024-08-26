var baseURL = window.location.origin;
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var QBs = $('#ottracker').DataTable( {
           
    "dom": 'lfBrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            filename: 'Output Tracker',
            text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
            title: 'Themetic area Data export',
            className: 'badge badge-outline-success',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]
            }
        },
        {
            extend: 'csvHtml5',
            filename: 'Output Tracker',
            text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
            title: 'Themetic area Data',
            className: 'badge badge-outline-success ',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]
            }
        }
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
        "url":"/get_output_tracker",
        "dataType":"json",
        "type":"POST",
        "data":{"_token":csrfToken}
    },
    "columns":[
                    {"data":"date","searchable":false,"orderable":false},
                    {"data":"reported_date","searchable":false,"orderable":false},
                    {"data":"project","searchable":false,"orderable":false},
                    {"data":"sof","searchable":false,"orderable":false},
                    {"data":"activity","searchable":false,"orderable":false},
                    {"data":"theme","searchable":false,"orderable":false},
                    {"data":"theme","searchable":false,"orderable":false},
                    {"data":"lop","searchable":false,"orderable":false},
                    {"data":"monthly_achieve","searchable":false,"orderable":false},
                    {"data":"women","searchable":false,"orderable":false},
                    {"data":"men","searchable":false,"orderable":false},
                    {"data":"total_adult","searchable":false,"orderable":false},
                    {"data":"girls","searchable":false,"orderable":false},
                    {"data":"boys","searchable":false,"orderable":false},
                    {"data":"total_child","searchable":false,"orderable":false},
                    {"data":"pwd","searchable":false,"orderable":false},
                    {"data":"total_reach","searchable":false,"orderable":false},
                    {"data":"remarks","searchable":false,"orderable":false},
                    {"data":"created_at" ,"searchable":false,"orderable":false},
                    {"data":"created_by" ,"searchable":false,"orderable":false},                    
                ]
});