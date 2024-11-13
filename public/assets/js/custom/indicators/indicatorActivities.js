$(document).ready(function () {
    // Get CSRF token from the meta tag
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    var table = $('#indicatorActivities').DataTable({
        processing: true,
        serverSide: false, // Set this to false for client-side processing
        ajax: {
            url: "/get-indicatorActvities", // Adjust this route as necessary
            type: 'POST', // Use POST method for AJAX
            headers: {
                'X-CSRF-TOKEN': csrfToken // Add CSRF token for Laravel security
            },
        },
        columns: [
            { data: 'project', name: 'project.name' },
            { data: 'indicator_name', name: 'indicator_name' },
            { data: 'indicator_type', name: 'indicator_type' },
            { data: 'activity', name: 'activity' },
            { data: 'activity_target', name: 'activity_target' },
            { data: 'created_by', name: 'user.name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        order: [[0, 'asc']], // Default ordering
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        // Enable client-side search and ordering
        search: {
            smart: true, // Enable smart search
        },
        language: {
            search: "_INPUT_", // Customize search box
            searchPlaceholder: "Search indicators..."
        },
    });

    // Optional: If you want to add custom filters and trigger a redraw of the DataTable
    $('#project-filter, #type-filter, #status-filter').on('change', function () {
        table.draw(); // Redraw the table when filters change
    });
});


function del(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then(function(result) {
        if (result.isConfirmed) {
            Swal.fire(
                "Deleted!",
                "Your indicator activity has been deleted.",
                "success"
            );
            window.location.href = APP_URL + "/delete-indicatorActivity/" + id;
        }
    });
}

