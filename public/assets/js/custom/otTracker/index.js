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
                filename: 'Beneficary Reach',
                text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                title: 'Beneficary OutReach',
                className: 'badge badge-success mb-4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7,8,9,10,11,12,13,14,15,16]
                }
            },
            {
                extend: 'csvHtml5',
                filename: 'Beneficary Reach',
                text: '<i class="fa fa-download text-warning"></i> CSV',
                title: 'Beneficary OutReach',
                className: 'badge badge-success',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7,8,9,10,11,12,13,14,15,16]
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
            {"data":"activity_number", "searchable":true, "orderable":true},
            {"data":"activity", "searchable":true, "orderable":true, "className": "wrap-activity"},
            {"data":"lop", "searchable":false, "orderable":true},
            {"data":"benefiary_target", "searchable":false, "orderable":true},
            {"data":"women", "searchable":false, "orderable":true},
            {"data":"men", "searchable":false, "orderable":true},
            {"data":"total_adult", "searchable":false, "orderable":true},
            {"data":"girls", "searchable":false, "orderable":true},
            {"data":"boys", "searchable":false, "orderable":true},
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
$('#projectFilter, #subtheme, #added_by').on('change', function() {
    // Reinitialize the DataTable on filter change
    reinitializeDataTable();
});

//
// document.addEventListener('DOMContentLoaded', function() {
//     var ctx = document.getElementById('projectReachChart').getContext('2d');

//     // Fetch data from the server
//     fetch('/get_project_reach_data')
//         .then(response => response.json())
//         .then(data => {
//             // Prepare data for Chart.js
//             const projectNames = data.map(item => item.project_name);
//             const totalReachValues = data.map(item => item.total_reach);

//             // Create chart
//             new Chart(ctx, {
//                 type: 'bar',
//                 data: {
//                     labels: projectNames,
//                     datasets: [{
//                         label: 'Total Reach',
//                         data: totalReachValues,
//                         backgroundColor: 'rgba(75, 192, 192, 0.2)',
//                         borderColor: 'rgba(75, 192, 192, 1)',
//                         borderWidth: 1
//                     }]
//                 },
//                 options: {
//                     scales: {
//                         y: {
//                             beginAtZero: true
//                         }
//                     }
//                 }
//             });
//         })
//         .catch(error => console.error('Error fetching data:', error));
// });
// // Fetch theme-wise progress and create graph
// function loadThemeGenderGraph() {
//     $.ajax({
//         url: '/get_theme_gender_data',
//         type: 'POST',
//         data: { _token: csrfToken },
//         success: function(data) {
//             // Prepare data for Chart.js
//             const themes = data.map(item => item.main_theme_name);
//             const men = data.map(item => item.men);
//             const women = data.map(item => item.women);
//             const boys = data.map(item => item.boys);
//             const girls = data.map(item => item.girls);

//             // Create bar chart for theme-wise gender distribution
//             new Chart(document.getElementById('themeGenderChart'), {
//                 type: 'bar',
//                 data: {
//                     labels: themes,
//                     datasets: [
//                         { label: 'Men', data: men, backgroundColor: 'blue' },
//                         { label: 'Women', data: women, backgroundColor: 'pink' },
//                         { label: 'Boys', data: boys, backgroundColor: 'green' },
//                         { label: 'Girls', data: girls, backgroundColor: 'yellow' }
//                     ]
//                 },
//                 options: {
//                     scales: {
//                         y: {
//                             beginAtZero: true
//                         }
//                     }
//                 }
//             });
//         }
//     });
// }

// // Fetch project-wise progress and create graph
// function loadProjectThemeGenderGraph() {
//     $.ajax({
//         url: '/get_project_theme_gender_data',
//         type: 'POST',
//         data: { _token: csrfToken },
//         success: function(data) {
//             // Extract the project names and themes as labels
//             const labels = data.map(item => `${item.project_name} - ${item.main_theme_name}`);

//             // Extract data for each gender category
//             const menData = data.map(item => item.men);
//             const womenData = data.map(item => item.women);
//             const boysData = data.map(item => item.boys);
//             const girlsData = data.map(item => item.girls);

//             // Prepare datasets for Chart.js
//             const chartData = {
//                 labels: labels,
//                 datasets: [
//                     {
//                         label: 'Men',
//                         backgroundColor: 'rgba(54, 162, 235, 0.6)',
//                         borderColor: 'rgba(54, 162, 235, 1)',
//                         borderWidth: 1,
//                         data: menData
//                     },
//                     {
//                         label: 'Women',
//                         backgroundColor: 'rgba(255, 99, 132, 0.6)',
//                         borderColor: 'rgba(255, 99, 132, 1)',
//                         borderWidth: 1,
//                         data: womenData
//                     },
//                     {
//                         label: 'Boys',
//                         backgroundColor: 'rgba(75, 192, 192, 0.6)',
//                         borderColor: 'rgba(75, 192, 192, 1)',
//                         borderWidth: 1,
//                         data: boysData
//                     },
//                     {
//                         label: 'Girls',
//                         backgroundColor: 'rgba(255, 206, 86, 0.6)',
//                         borderColor: 'rgba(255, 206, 86, 1)',
//                         borderWidth: 1,
//                         data: girlsData
//                     }
//                 ]
//             };

//             // Create or update the Chart.js chart
//             const ctx = document.getElementById('projectThemeGenderChart').getContext('2d');
//             const projectThemeGenderChart = new Chart(ctx, {
//                 type: 'bar', // You can change this to 'line', 'pie', etc. based on your needs
//                 data: chartData,
//                 options: {
//                     scales: {
//                         y: {
//                             beginAtZero: true
//                         }
//                     },
//                     responsive: true,
//                     plugins: {
//                         legend: {
//                             position: 'top',
//                         },
//                         title: {
//                             display: true,
//                             text: 'Project-wise Theme and Gender-wise Progress'
//                         }
//                     }
//                 }
//             });
//         }
//     });
// }

