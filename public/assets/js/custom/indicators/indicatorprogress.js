$(document).ready(function () {
    // Get CSRF token from the meta tag
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    var table = $('#indicatorprogress').DataTable({
        processing: true,
        serverSide: true, // Set this to true for server-side processing
        ajax: {
            url: "/indicator-progress", // Adjust this route as necessary
            type: 'POST', // Use POST method for AJAX
            headers: {
                'X-CSRF-TOKEN': csrfToken // Add CSRF token for Laravel security
            },
            data: function (d) {
                // Optional: Pass additional parameters for filtering
                d.project = $('#project_name').val();
                
            }
        },
        columns: [
            { data: 'project', name: 'project' },
            { data: 'indicator', name: 'indicator' },
            { data: 'indicator_lop_target', name: 'indicator_lop_target' },
            { data: 'activity_lop_target', name: 'activity_lop_target' },
            { data: 'total_women_target', name: 'total_women_target' },
            { data: 'total_men_target', name: 'total_men_target' },
            { data: 'total_girls_target', name: 'total_girls_target' },
            { data: 'total_boys_target', name: 'total_boys_target' },
            { data: 'total_pwd_target', name: 'total_pwd_target' },
        ],
        order: [[0, 'asc']], // Default ordering
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search indicators..."
        }
    });

    // Apply filters and redraw table on filter change
    $('#project_name').on('change', function () {
        table.draw(); // Redraw the table when filters change
    });
});