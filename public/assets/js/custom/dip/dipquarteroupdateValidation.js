var activity_id = document.getElementById("dip_activity").value ;
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var activityQuarters = $('#activityQuarters').DataTable({
    "order": [[1, 'desc']],
   
    "responsive": true, // Enable responsive mode
    "processing": true,
    "serverSide": true,
    "searching": false,
    "bLengthChange": false,
    "bInfo" : false,
    "responsive": false,
    "info": false,   
    "ajax": {
        "url":"/activity_Quarters",
        "dataType":"json",
        "type":"POST",
        "data":{"_token":csrfToken,
                "activity_id":activity_id
        }
    },
    "columns":[
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
        {"data":"action","searchable":false,"orderable":false},
    ]
});


