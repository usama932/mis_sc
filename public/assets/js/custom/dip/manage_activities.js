var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


$(document).ready(function () {
    var table = $('#dip_activity').DataTable();
    table.destroy();
    var dip_id =  $(this).val();;
        var dip_activity = $('#dip_activity').DataTable( {
       
        "dom": 'lfBrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                filename: 'Overdue Progress Activities',
                text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                title: 'Overdue Progress Activities',
                className: 'badge badge-success mb-4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7,8]
                }
            },
            {
                extend: 'csvHtml5',
                filename: 'Overdue Progress Activities',
                text: '<i class="fa fa-download text-warning"></i> CSV',
                title: 'Overdue Progress Activities',
                className: 'badge badge-success',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7,8]
                }
            }
        ],
        "processing": true,
        "serverSide": false, // Disable server-side processing
        "searching": true, // Enable client-side searching
        "ordering": true, // Enable client-side sorting
        "paging": true, // Enable pagination
        "info": true, // Show table information
        "bLengthChange": true,
        "aLengthMenu": [[10, 50, 100, 250, 500, 750, 1000, 1500, 2000, 2500], [10, 50, 100, 250, 500, 750, 1000, 1500, 2000, 2500]],
       
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
                {"data":"activity","searchable":true,"orderable":true},
                {"data":"activity_number","searchable":true,"orderable":true},
                {"data":"sub_theme","searchable":true,"orderable":true},
                {"data":"activity_type","searchable":true,"orderable":true},
                {"data":"project","searchable":true,"orderable":true},
                {"data":"lop_target","searchable":false,"orderable":false},
                {"data":"quarter_target","searchable":false,"orderable":false},
                {"data":"created_by","searchable":true,"orderable":true},
                {"data":"created_at","searchable":true,"orderable":true},
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
                filename: 'Overdue Progress Activities',
                text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                title: 'Overdue Progress Activities',
                className: 'badge badge-success mb-4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7,8]
                }
            },
            {
                extend: 'csvHtml5',
                filename: 'Overdue Progress Activities',
                text: '<i class="fa fa-download text-warning"></i> CSV',
                title: 'Overdue Progress Activities',
                className: 'badge badge-success',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7,8]
                }
            }
        ],
        "processing": true,
        "serverSide": false, // Disable server-side processing
        "searching": true, // Enable client-side searching
        "ordering": true, // Enable client-side sorting
        "paging": true, // Enable pagination
        "info": true, // Show table information
        "bLengthChange": true,
        "aLengthMenu": [[10, 50, 100, 250, 500, 750, 1000, 1500, 2000, 2500], [10, 50, 100, 250, 500, 750, 1000, 1500, 2000, 2500]],
       

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
                {"data":"activity","searchable":true,"orderable":true},
                {"data":"activity_number","searchable":true,"orderable":true},
                {"data":"sub_theme","searchable":true,"orderable":true},
                {"data":"activity_type","searchable":true,"orderable":true},
                {"data":"project","searchable":true,"orderable":true},
                {"data":"lop_target","searchable":false,"orderable":false},
                {"data":"quarter_target","searchable":false,"orderable":false},
                {"data":"created_by","searchable":true,"orderable":true},
                {"data":"created_at","searchable":true,"orderable":true},
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