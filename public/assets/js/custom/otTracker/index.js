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
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
            }
        },
        {
            extend: 'csvHtml5',
            filename: 'Output Tracker',
            text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
            title: 'Themetic area Data',
            className: 'badge badge-outline-success ',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
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
        "url":"/get_qb",
        "dataType":"json",
        "type":"POST",
        "data":{"_token":csrfToken}
    },
    "columns":[
                    {"data":"assement_code","searchable":false,"orderable":false},
                    {"data":"project_name","searchable":false,"orderable":false},
                    {"data":"partner","searchable":false,"orderable":false},
                    {"data":"province","searchable":false,"orderable":false},
                    {"data":"district","searchable":false,"orderable":false},
                    {"data":"theme","searchable":false,"orderable":false},
                    {"data":"activity_description","searchable":false,"orderable":false},
                    {"data":"village","searchable":false,"orderable":false},
                    {"data":"staff_organization","searchable":false,"orderable":false},
                    {"data":"date_visit","searchable":false,"orderable":false},
                    {"data":"qb_base","searchable":false,"orderable":false},
                    {"data":"total_qbs","searchable":false,"orderable":false},
                    {"data":"qbs_not_fully_met","searchable":false,"orderable":false},
                    {"data":"qbs_fully_met","searchable":false,"orderable":false},
                    {"data":"qb_not_applicable","searchable":false,"orderable":false},
                    {"data":"score_out","searchable":false,"orderable":false},
                    {"data":"qb_status","searchable":false,"orderable":false},
                    {"data":"attachment","searchable":false,"orderable":false},
                    {"data":"created_at" ,"searchable":false,"orderable":false},
                    {"data":"created_by" ,"searchable":false,"orderable":false},
                    {"data":"action","searchable":false,"orderable":false},
                ]
});