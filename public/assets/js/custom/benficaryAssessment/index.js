$(document).ready(function () {
    // Get CSRF token from the meta tag
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    var table = $('#beneficary_list').DataTable({
        processing: true,
        serverSide: false, // Set this to false for client-side processing
        ajax: {
            url: "/beneficiaryAssessments", // Adjust this route as necessary
            type: 'POST', // Use POST method for AJAX
            headers: {
                'X-CSRF-TOKEN': csrfToken // Add CSRF token for Laravel security
            },
        },
        columns: [
            { data: 'form_no', name: 'form_no' },
            { data: 'project', name: 'project' },
            { data: 'name_of_beneficiary', name: 'name_of_beneficiary' },
            { data: 'gender', name: 'gender' },
            { data: 'age', name: 'age' },
            { data: 'contact_number', name: 'contact_number' },
            { data: 'cash_assistance', name: 'cash_assistance' },
            { data: 'assessment_officer', name: 'assessment_officer' },
            { data: 'vc_representative_name', name: 'vc_representative_name' },
            { data: 'status', name: 'status' },
            { data: 'created_by', name: 'created_by'},
            { data: 'created_at', name: 'created_at'},
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
