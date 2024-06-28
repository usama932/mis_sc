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
            "order": [[1, 'desc']],
            "dom": 'lfBrtip',
            "buttons": getButtons(),
            "responsive": false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "bLengthChange": false,
            "paging": true,
            "bInfo": false,
            "info": true,
            "ajax": {
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
                filename: 'Project_Profile_Data_export_',
                text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                title: 'Thematic area Data export',
                className: 'badge badge-outline-success mb-2',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                extend: 'csvHtml5',
                filename: 'Project_Profile_Data_CSV_',
                text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
                title: 'Thematic area Data',
                className: 'badge badge-outline-success mb-2',
                exportOptions: {
                    columns: [0, 1, 2]
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
