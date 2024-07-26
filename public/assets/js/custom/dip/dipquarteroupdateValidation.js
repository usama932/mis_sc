var activity_id = document.getElementById("dip_activity").value ;
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var activityQuarters = $('#activityQuarters').DataTable({
        "dom": 'lfBrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                filename: 'Activity Progress Detail',
                text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                title: 'Activity Progress Detail',
                className: 'badge badge-success',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                }
            },
            {
            extend: 'csvHtml5',
            filename: 'Activity Progress Detail',
            text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
            title: 'Activity Progress Detail',
            className: 'badge badge-success',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
            }
         }
        ],
        "processing": true,
        "serverSide": true,
        "searching": false,
        "bLengthChange": true,
        "aLengthMenu": [[10, 50, 100], [10, 50, 100]],
        "bInfo" : false,
        "responsive": false,
        "info": true,
    "ajax": {
        "url":"/activity_Quarters",
        "dataType":"json",
        "type":"POST",
        "data":{"_token":csrfToken,
                "activity_id":activity_id
        }
    },
    "columns":[
        {"data":"action","searchable":false,"orderable":false},
        {"data":"quarter","searchable":false,"orderable":false},
        {"data":"activity_target","searchable":false,"orderable":false},
        {"data":"activity_acheive","searchable":false,"orderable":false},
        {"data":"benefit_target","searchable":false,"orderable":false},
        {"data":"women_target","searchable":false,"orderable":false},
        {"data":"men_target","searchable":false,"orderable":false},
        {"data":"girls_target","searchable":false,"orderable":false},
        {"data":"boys_target","searchable":false,"orderable":false},
        {"data":"pwd_target","searchable":false,"orderable":false},
        {"data":"status","searchable":false,"orderable":false},
        {"data":"completion_date","searchable":false,"orderable":false},
        {"data":"completed_date","searchable":false,"orderable":false},
        {"data":"image","searchable":false,"orderable":false},
        {"data":"attachment","searchable":false,"orderable":false},
        {"data":"remarks","searchable":false,"orderable":false},
        {"data":"created_at","searchable":false,"orderable":false},
        {"data":"created_by","searchable":false,"orderable":false},
      
    ]
});


