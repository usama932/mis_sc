var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
$(document).ready(function () {
    function initDataTable(dipId) {
        $('#dip_complete_activity').DataTable({
            "order": [[1, 'desc']],
            "dom": 'lfBrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    filename: 'Complete Activities',
                    text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                    title: 'Themetic area Data export',
                    className: 'badge badge-outline-success mb-4',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                {
                extend: 'csvHtml5',
                filename: 'Complete Activities',
                text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
                title: 'Themetic area Data',
                className: 'badge badge-outline-success',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7]
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
            "aLengthMenu": [[10, 50, 100, 250,500,750,1000,1500,2000,2500], [10, 50, 100, 250,500,750,1000,1500,2000,2500]],
            "bInfo" : false,
            "responsive": false,
            "info": true,
            "ajax": {
                "url": "/get_complete_activity",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": csrfToken,
                    "dip_id": dipId
                }
            },
            "columns": [
                {"data": "activity", "searchable": true, "orderable": true},
                {"data": "activity_number", "searchable": true, "orderable": true},
                {"data": "sub_theme", "searchable": true, "orderable": true},
                {"data": "activity_type", "searchable": true, "orderable": true},
                {"data": "project", "searchable": true, "orderable": true},
                {"data": "lop_target", "searchable": true, "orderable": true},
                {"data": "quarter_target", "searchable": true, "orderable": true},
                {"data": "created_by", "searchable": true, "orderable": true},
                {"data": "created_at", "searchable": true, "orderable": true},
                {"data": "action", "searchable": true, "orderable": true}
            ]
        });
    }

    $('#project,').change(function () {
            var table = $('#dip_complete_activity').DataTable();
            table.destroy();
            var dipId = $(this).val();
            initDataTable(dipId);
        });

    initDataTable($('#project').val());
});