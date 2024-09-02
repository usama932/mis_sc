var csrfToken = $('meta[name="csrf-token"]').attr('content');
function initializeDataTable(projectId = null) {
    return $('#project_details').DataTable({
        "dom": 'lfBrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                filename: 'Project detail list',
                text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                title: 'Project detail list',
                className: 'badge badge-outline-success',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                }
            },
            {
                extend: 'csvHtml5',
                filename: 'Project detail list',
                text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
                title: 'Project detail list',
                className: 'badge badge-outline-success ',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                }
            }
        ],
       
        "processing": true,
        "serverSide": false,
        "searching": true,
        "bLengthChange": true,
        "aLengthMenu": [[10, 50, 100, 150], [10, 50, 100, 150]],
        "bInfo" : true,
        "responsive": false,
        "info": true,
        ajax: {
            url: "/get_project_details",
            dataType: 'json',
            type: 'POST',
            data: {
                _token: csrfToken,
                project: projectId
            }
        },
        columns: [
            { data: "project", searchable: true, orderable: true },
            { data: "type", searchable: true, orderable: true },
            { data: "sof", searchable: true, orderable: true },
            { data: "province", searchable: false, orderable: false },
            { data: "district", searchable: false, orderable: false },
            { data: "project_tenure", searchable: false, orderable: false },
            {
                data: "action", searchable: false, orderable: false,
                render: function(data, type, row) {
                    var actionHtml = '';
                    if (row.role === 'f_p') {
                        actionHtml += `<a class="btn-icon mx-1" href="${projectDetail.replace(':id', row.id)}" title="Edit Project"><i class="fas fa-pencil-alt text-warning"></i></a>`;
                    }
                  
                    if (userType === 'admin') {
                        actionHtml += `<a class="btn-icon mx-1"  target="_blank" href="${projectDetail.replace(':id', row.id)}" title="Edit Project"><i class="fas fa-pencil-alt text-warning"></i></a>`;
                        actionHtml += `<a class="btn-icon mx-1" onclick="event.preventDefault(); del(${row.id});" title="Delete Project" href="#"><i class="fas fa-trash-alt text-danger"></i></a>`;
                    }
                    actionHtml += `<a class="btn-icon mx-1" href="${projectView.replace(':id', row.id)}" target="_blank" title="Show Project"><i class="far fa-eye text-success"></i></a>`;
                    return actionHtml.replace(/:id/g, row.id);
                }
            },
            {
                data: "project_activities", searchable: false, orderable: false,
                render: function(data, type, row) {
                    return `<a class="btn" href="${projectView.replace(':id', row.id)}" title="Extract Project" target="_blank"><i class="far fa-calendar-alt text-info"></i></a>`;
                }
            },
            {
                data: "review_meeting", searchable: false, orderable: false,
                render: function(data, type, row) {
                    return `<a class="btn" href="${projectReviewsUrl.replace(':id', row.id)}"  target="_blank" title="Add/Show Review Meeting"><i class="far fa-calendar-alt text-info"></i></a>`;
                }
            }
        ],
        order: []
    });
}

var projectTable = initializeDataTable();

$("#project_name").change(function() {
    var projectId = $(this).val();
    projectTable.destroy();
    projectTable = initializeDataTable(projectId);
});

function del(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then(function(result) {
        if (result.value) {
            Swal.fire("Deleted!", "Your Project has been deleted.", "success");
            var segments = window.location.href.split('/');
            var APP_URL = segments[1];
            window.location.href = APP_URL + "/dip/delete/" + id;
        }
    });
}