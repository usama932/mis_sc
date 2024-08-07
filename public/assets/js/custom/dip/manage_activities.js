var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


$(document).ready(function () {
    var table = $('#dip_activity').DataTable();
    table.destroy();
    var dip_id =  $(this).val();;
        var dip_activity = $('#dip_activity').DataTable( {
            "order": [
            [1, 'desc']
        ],
        "dom": 'lfBrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            filename: 'Project Profile Data export_',
            text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
            title: 'Themetic area Data export',
            className: 'badge badge-outline-success',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
            }
        },
        {
            extend: 'csvHtml5',
            filename: 'Project Profile Data CSV_',
            text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
            title: 'Themetic area Data',
            className: 'badge badge-outline-success ',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
            }
        }
    ],
    "responsive": true, // Enable responsive mode
    "processing": true,
    "serverSide": true,
    "searching": false,
    "bLengthChange": true,
    "aLengthMenu": [[10, 50, 100, 250], [10, 50, 100, 250]],
    "bInfo" : true,
    "responsive": false,
    "info": true,
        "ajax": {
            "url":"/get_activity_dips",
            "dataType":"json",
            "type":"POST",
            "data":{"_token":csrfToken,
                    "dip_id":dip_id,
                    "url":"quarter_progress"}
        },
        "columns":
            [
                {"data":"activity","searchable":false,"orderable":false},
                {"data":"activity_number","searchable":false,"orderable":false},
                {"data":"sub_theme","searchable":false,"orderable":false},
                {"data":"activity_type","searchable":false,"orderable":false},
                {"data":"project","searchable":false,"orderable":false},
                {"data":"lop_target","searchable":false,"orderable":false},
                {"data":"quarter_target","searchable":false,"orderable":false},
                {"data":"created_by","searchable":false,"orderable":false},
                {"data":"created_at","searchable":false,"orderable":false},
                {"data":"update_progress","searchable":false,"orderable":false},
                {"data":"action","searchable":false,"orderable":false},
            ]
        });
   
});

//dip_activity
$("#subtheme_id, #project" ).change(function () {
    var table = $('#dip_activity').DataTable();
    table.destroy();
    var theme_id = document.getElementById("theme_id").value;
    var subtheme_id = document.getElementById("subtheme_id").value;
    var dip_id =  document.getElementById("project").value;
    var dip_activity = $('#dip_activity').DataTable( {
        "dom": 'lfBrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                filename: 'Activities export',
                text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                title: 'Themetic area Data export',
                className: 'badge badge-outline-success',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                }
            },
            {
            extend: 'csvHtml5',
            filename: 'Activities export',
            text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
            title: 'Themetic area Data',
            className: 'badge badge-outline-success',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
            }
         }
        ],
        "processing": true,
        "serverSide": true,
        "searching": false,
        "bLengthChange": true,
        "aLengthMenu": [[10, 50, 100, 250], [10, 50, 100, 250]],
        "bInfo" : false,
        "responsive": false,
        "info": true,

        "ajax": {
            "url":"/get_activity_dips",
            "dataType":"json",
            "type":"POST",
            "data":{"_token":csrfToken,
                    'theme_id':theme_id,
                    'subtheme_id':subtheme_id,
                    "dip_id":dip_id,
                    }
        },
        "columns":
            [
                {"data":"activity","searchable":false,"orderable":false},
                {"data":"activity_number","searchable":false,"orderable":false},
                {"data":"sub_theme","searchable":false,"orderable":false},
                {"data":"activity_type","searchable":false,"orderable":false},
                {"data":"project","searchable":false,"orderable":false},
                {"data":"lop_target","searchable":false,"orderable":false},
                {"data":"quarter_target","searchable":false,"orderable":false},
                {"data":"created_by","searchable":false,"orderable":false},
                {"data":"created_at","searchable":false,"orderable":false},
                {"data":"update_progress","searchable":false,"orderable":false},
                {"data":"action","searchable":false,"orderable":false},
            ]
        });
});

// AJAX call on theme change
document.getElementById('themeloader').style.display = 'none';
$("#theme_id").change(function() {
    document.getElementById('themeloader').style.display = 'block';
    var value = $(this).val();
    csrf_token = $('[name="_token"]').val();
    $.ajax({
        type: 'POST',
        url: '/getactivitySubTheme',
        data: {
            'theme_id': value,
            _token: csrfToken,
            
        },
        dataType: 'json',
        success: function(data) {
            document.getElementById('themeloader').style.display = 'none';
            $("#subtheme_id").find('option').remove();
            $("#subtheme_id").prepend("<option value=''>Select Sub-Theme</option>");
            var selected = '';
            $.each(data, function(i, item) {

                $("#subtheme_id").append("<option value='" + item.id + "' " + selected + " >" +
                    item.name.replace(/_/g, ' ') + "</option>");
            });
        }
    });
});