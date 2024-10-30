var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


$(document).ready(function () {
    function updateTabCounts() {
        $.ajax({
            url: '/tab-count', // Replace with your endpoint
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                // Assuming response contains an object with counts for each status
                $('#all-count').text(response.allCount);
                $('#to-be-reviewed-count').text(response.toBeReviewedCount);
                $('#returned-count').text(response.returnedCount);
                $('#reviewed-count').text(response.reviewedCount);
                $('#posted-count').text(response.postedCount);
                $('#pending-count').text(response.pendingCount);
            },
            error: function (error) {
                console.error('Error fetching counts:', error);
            }
        });
    }
    function initDataTable(dipId, user, subtheme, status) {
        $('#dip_complete_activity').DataTable({
            "order": [[1, 'desc']],
            "dom": 'lfBrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    filename: 'Complete Activities',
                    text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                    title: 'Thematic area Data export',
                    className: 'badge badge-outline-success mb-4',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'csvHtml5',
                    filename: 'Complete Activities',
                    text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
                    title: 'Thematic area Data',
                    className: 'badge badge-outline-success',
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
            "responsive": false,
            "ajax": {
                "url": "/get_complete_activity",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": csrfToken,
                    "dip_id": dipId,
                    "user": user,
                    "subtheme": subtheme,
                    "status": status  // Pass the status parameter
                }
            },
            "columns": [
                {"data": "action", "searchable": false, "orderable": false},
                {"data": "project", "searchable": true, "orderable": true},
                {"data": "activity_title", "searchable": true, "orderable": true},
                {"data": "activity_lop_target", "searchable": true, "orderable": true},
                {"data": "beneficiary_target", "searchable": true, "orderable": true},
                {"data": "expected_completion_date", "searchable": true, "orderable": true},
                {"data": "quarter_target", "searchable": true, "orderable": true},
                {"data": "status", "searchable": false, "orderable": false},
                {"data": "remarks", "searchable": false, "orderable": false},
              
            ]
        });
    }

    $('#project, #user, #subtheme').change(function () {
        var dipId = $('#project').val();
        var user = $('#user').val();
        var subtheme = $('#subtheme').val();
        var status = $('ul#statusTabs .nav-link.active').data('status'); // Get the active tab status
        var table = $('#dip_complete_activity').DataTable();
        table.destroy();
        initDataTable(dipId, user, subtheme, status);
    });

    $('ul#statusTabs .nav-link').on('click', function () {
        $('ul#statusTabs .nav-link').removeClass('active');
        $(this).addClass('active');
        var dipId = $('#project').val();
        var user = $('#user').val();
        var subtheme = $('#subtheme').val();
        var status = $(this).data('status');
        var table = $('#dip_complete_activity').DataTable();
        table.destroy();
        initDataTable(dipId, user, subtheme, status); // Call the DataTable with status
    });

    var initialDipId = $('#project').val();
    var initialUser = $('#user').val();
    var initialSubtheme = $('#subtheme').val();
    var initialStatus = "";  // Initially, show all
    initDataTable(initialDipId, initialUser, initialSubtheme, initialStatus);
    updateTabCounts();
});

