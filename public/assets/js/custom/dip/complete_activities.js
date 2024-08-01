var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
$(document).ready(function () {
    function initDataTable(dipId) {
        $('#dip_complete_activity').DataTable({
            "order": [[1, 'desc']],
            "dom": 'lfBrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    filename: 'Project Profile Data export_',
                    text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                    title: 'Themetic area Data export',
                    className: 'badge badge-outline-success mb-4',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                {
                extend: 'csvHtml5',
                filename: 'Project Profile Data CSV_',
                text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
                title: 'Themetic area Data',
                className: 'badge badge-outline-success',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7]
                }
                }
            ],
            "processing": true,
            "serverSide": true,
            "searching": false,
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
                {"data": "activity", "searchable": false, "orderable": false},
                {"data": "activity_number", "searchable": false, "orderable": false},
                {"data": "sub_theme", "searchable": false, "orderable": false},
                {"data": "activity_type", "searchable": false, "orderable": false},
                {"data": "project", "searchable": false, "orderable": false},
                {"data": "lop_target", "searchable": false, "orderable": false},
                {"data": "quarter_target", "searchable": false, "orderable": false},
                {"data": "created_by", "searchable": false, "orderable": false},
                {"data": "created_at", "searchable": false, "orderable": false},
                {"data": "action", "searchable": false, "orderable": false}
            ]
        });
    }

    $('#project').change(function () {
            var table = $('#dip_complete_activity').DataTable();
            table.destroy();
            var dipId = $(this).val();
            initDataTable(dipId);
        });

    initDataTable($('#project').val());
});