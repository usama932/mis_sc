$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
    var projectsTable = initializeDataTable();

    flatpickr("#start_date, #end_date", {
        dateFormat: "Y-m-d",
        maxDate: "today",
    });

    $("#project_name, #start_date, #end_date, #type, #status").change(function() {
        projectsTable.ajax.reload();
    });

    $("#reset-date").click(function() {
        $('#project_name, #start_date, #end_date, #type, #status').val('').trigger('change');
        projectsTable.ajax.reload(null, false).draw(false);
    });

    function initializeDataTable() {
        return $('#projects').DataTable({
            "dom": 'lfBrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    filename: 'Project list',
                    text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                    title: 'Project detail list',
                    className: 'badge badge-outline-success',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                    }
                },
                {
                    extend: 'csvHtml5',
                    filename: 'Project list',
                    text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
                    title: 'Project detail list',
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
            "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
            "bInfo" : true,
            "responsive": false,
        "info": true,
                "url": "/get_projects",
                "type": "POST",
                "data": function(d) {
                    d._token = csrfToken;
                    d.project = $('#project_name').val() || '';
                    d.startdate = $('#start_date').val() || '';
                    d.enddate = $('#end_date').val() || '';
                    d.type = $('#type').val() || '';
                    d.status = $('#status').val() || '';
                }
            },
            "columns": getColumns()
        });
    }

    function getButtons() {
        return [
            {
                extend: 'excelHtml5',
                filename: 'Project export',
                text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                title: 'Thematic area Data export',
                className: 'badge badge-outline-success mb-2',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6,7,8,9]
                }
            },
            {
                extend: 'csvHtml5',
                filename: 'Project ',
                text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
                title: 'Thematic area Data',
                className: 'badge badge-outline-success mb-2',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6,7,8,9]
                }
            }
        ];
    }

    function getColumns() {
        return [
            {"data": "project"},
            {"data": "type"},
            {"data": "sof"},
            {"data": "donor"},
            {"data": "focal_person"},
            {"data": "budgetholder"},
            {"data": "awardsfp"},
            {"data": "start_date"},
            {"data": "end_date"},
            {"data": "created_by"},
            {"data": "created_at"},
            {
                "data": null,
                "orderable": false,
                "searchable": false,
                "className": "text-center",
                "render": function (data, type, row, meta) {
                    var editUrl = row.edit_url;
                    var showUrl = row.show_url;
                    var deleteUrl = "/projects/" + row.id; // Replace with your delete URL

                    var actionsHtml = `
                        <div>
                            <a class="btn-icon mx-1" href="${showUrl}">
                                <i class="fa fa-eye text-success"></i>
                            </a>
                            <a class="btn-icon mx-1" href="${editUrl}" target="_blank">
                                <i class="fa fa-pencil text-warning"></i>
                            </a>
                            <a class="btn-icon mx-1 delete-record" data-id="${row.id}" href="#">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </div>
                    `;
                    return actionsHtml;
                }
            }
        ];
    }
});
