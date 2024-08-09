var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

$(document).ready(function () {
    function initDataTable(dipId, user, subtheme) {
        $('#dip_due_activity').DataTable({
            "dom": 'lfBrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    filename: 'Overdue Progress Activities',
                    text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                    title: 'Overdue Progress Activities',
                    className: 'badge badge-success mb-4',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'csvHtml5',
                    filename: 'Overdue Progress Activities',
                    text: '<i class="fa fa-download text-warning"></i> CSV',
                    title: 'Overdue Progress Activities',
                    className: 'badge badge-success',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
                "url": "/getActivityDue",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d._token = csrfToken;
                    d.dip_id = dipId;
                    d.user = user;
                    d.subtheme = subtheme;
                }
            },
            "columns": [
                {"data": "activity", "searchable": true, "orderable": true},
                {"data": "activity_title", "searchable": true, "orderable": true},
                {"data": "sub_theme", "searchable": true, "orderable": true},
                {"data": "activity_type", "searchable": true, "orderable": true},
                {"data": "project", "searchable": true, "orderable": true},
                {"data": "lop_target", "searchable": true, "orderable": true},
                {"data": "quarter_target", "searchable": true, "orderable": true},
                {"data": "created_by", "searchable": true, "orderable": true},
                {"data": "created_at", "searchable": true, "orderable": true},
                {"data": "action", "searchable": false, "orderable": false}
            ]
        });
    }


    
    $('#project, #user, #subtheme').change(function () {
        var dipId = $('#project').val();
        var user = $('#user').val();
        var subtheme = $('#subtheme').val();
        var table = $('#dip_due_activity').DataTable();
        table.destroy();
        initDataTable(dipId, user, subtheme);
    });

    var initialDipId = $('#project').val();
    var initialUser = $('#user').val();
    var initialSubtheme = $('#subtheme').val();
    initDataTable(initialDipId, initialUser, initialSubtheme);


});
