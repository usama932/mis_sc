var baseURL = window.location.origin;
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Function to reinitialize DataTable
function reinitializeDataTable() {
    var table;

    // Destroy the existing DataTable if it exists
    if ($.fn.DataTable.isDataTable('#ottracker')) {
        table = $('#ottracker').DataTable();
        table.destroy();
    }

    // Reinitialize the DataTable
    table = $('#ottracker').DataTable({
        "dom": 'lfBrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                filename: 'Overdue Progress Activities',
                text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                title: 'Overdue Progress Activities',
                className: 'badge badge-success mb-4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7,8]
                }
            },
            {
                extend: 'csvHtml5',
                filename: 'Overdue Progress Activities',
                text: '<i class="fa fa-download text-warning"></i> CSV',
                title: 'Overdue Progress Activities',
                className: 'badge badge-success',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7,8]
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
       
        "ajax": {
            "url": "/get_output_tracker",
            "dataType": "json",
            "type": "POST",
            "data": function(d) {
                d._token = csrfToken;
                d.project = $('#projectFilter').val();
                d.subtheme = $('#subtheme').val();
                d.added_by = $('#added_by').val();
            }
        },
        "columns": [
            {"data":"date", "searchable":false, "orderable":true},
            {"data":"project", "searchable":true, "orderable":true, "className": "wrap-project"},
            {"data":"sof", "searchable":true, "orderable":true},
            {"data":"activity", "searchable":true, "orderable":true, "className": "wrap-activity"},
            {"data":"theme", "searchable":true, "orderable":true},
            {"data":"lop", "searchable":false, "orderable":true},
            {"data":"monthly_achieve", "searchable":false, "orderable":true},
            {"data":"women", "searchable":false, "orderable":true},
            {"data":"men", "searchable":false, "orderable":true},
            {"data":"total_adult", "searchable":false, "orderable":true},
            {"data":"girls", "searchable":false, "orderable":true},
            {"data":"boys", "searchable":false, "orderable":true},
            {"data":"pwd", "searchable":true, "orderable":true},
            {"data":"total_child", "searchable":false, "orderable":true},
            {"data":"total_reach", "searchable":true, "orderable":true},
            {"data":"remarks", "searchable":true, "orderable":true, "className": "wrap-remarks"},
            {"data":"created_at", "searchable":false, "orderable":false},
            {"data":"created_by", "searchable":true, "orderable":true}
        ],
        "createdRow": function(row, data, dataIndex) {
            if (dataIndex === 0) {
                $(row).addClass('font-weight-bold bg-light');
            }
        }
    });

   
}

// Initial DataTable initialization
reinitializeDataTable();

// Event listener for changes in filter elements
$('#project_name, #subtheme, #added_by').on('change', function() {
    // Reinitialize the DataTable on filter change
    reinitializeDataTable();
});

//
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('projectReachChart').getContext('2d');

    // Fetch data from the server
    fetch('/get_project_reach_data')
        .then(response => response.json())
        .then(data => {
            // Prepare data for Chart.js
            const projectNames = data.map(item => item.project);
            const totalReachValues = data.map(item => item.total_reach);

            // Create chart
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: projectNames,
                    datasets: [{
                        label: 'Total Reach',
                        data: totalReachValues,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});
