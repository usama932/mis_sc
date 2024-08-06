var csrfToken = $('meta[name="csrf-token"]').attr('content');
function initializeDataTable(projectId = null) {
    return $('#project_details').DataTable({
        dom: 'lfBrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                filename: 'project Data export',
                text: '<i class="flaticon2-download"></i> Excel',
                title: 'project Data export',
                className: 'badge badge-success',
                exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7] }
            },
            {
                extend: 'csvHtml5',
                filename: 'Project Data CSV',
                text: '<i class="flaticon2-download"></i> CSV',
                title: '',
                className: 'badge badge-warning',
                exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7] }
            }
        ],
        processing: true,
        serverSide: true,
        searching: false,
        bLengthChange: false,
        paging: true,
        bInfo: false,
        responsive: false,
        info: false,
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
            { data: "project", searchable: false, orderable: false },
            { data: "type", searchable: false, orderable: false },
            { data: "sof", searchable: false, orderable: false },
            { data: "province", searchable: false, orderable: false },
            { data: "district", searchable: false, orderable: false },
            { data: "project_tenure", searchable: false, orderable: false },
            {
                data: "action", searchable: false, orderable: false,
                render: function(data, type, row) {
                    var actionHtml = '';
                    if (row.role === 'f_p') {
                        actionHtml += `<a class="btn-icon mx-1" href="{{ route('project.detail', ':id') }}" title="Edit Project"><i class="fas fa-pencil-alt text-warning"></i></a>`;
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
            var APP_URL = json_encode(url('/'));
            window.location.href = APP_URL + "/dip/delete/" + id;
        }
    });
}