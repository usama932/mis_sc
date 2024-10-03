    <x-default-layout>
        @section('title')
        Dashboard
        @endsection
        <script src="https://d3js.org/d3.v6.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.highcharts.com/maps/highmaps.js"></script>
        <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
        <style>
            .bar {
                transition: fill 0.3s;
            }
            .bar:hover {
                fill: #7a7a7a; /* Darker color on hover */
            }
            .x-axis text {
                font-size: 12px;
            }
            .y-axis text {
                font-size: 12px;
            }
            .chart-container {
                height: 400px;
                overflow: hidden;
                border-radius: 15px;
                border-color: #da291c;
                background-color: #ffffff;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin: 10px 0;
                transition: transform 0.3s ease;
            }

            .project-container {
                height: 500px;
                overflow: hidden;
              
                padding: 20px;
                margin: 10px 0;
                transition: transform 0.3s ease;
            }
    
            .chart-container:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            }
    
            #chart_div, #main {
                display: none; /* Initially hide the charts */
            }
    
            .card-title {
                font-weight: 600;
                color: #333;
            }
    
            .card-text {
                font-size: 1.25rem;
                font-weight: 500;
            }
    
            .theme-card {
                background-color: #f8f9fa;
                border-radius: 15px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                border: 1px solid #ddd;
                padding: 20px;
                height: 100%;
                text-align: center;
            }
    
            .theme-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }
    
            .theme-card h5 {
                font-weight: 700;
                color: #555;
            }
    
            .theme-card .card-body h1 {
                color: #da291c;
                font-size: 3rem;
                margin-bottom: 10px;
            }
    
            .theme-card .card-body p {
                font-size: 1.1rem;
                font-weight: 600;
            }
    
            .theme-card .col-6 {
                margin-top: 10px;
            }
    
            @media (max-width: 1200px) {
                .col-md-3 {
                    flex: 0 0 50%;
                    max-width: 50%;
                }
            }
    
            @media (max-width: 768px) {
                .col-md-3 {
                    flex: 0 0 100%;
                    max-width: 100%;
                }
    
                .chart-container {
                    width: 100% !important;
                }
            }
    
            .header-title {
                font-size: 2rem;
                font-weight: bold;
                color: #ffffff;
                text-align: center;
            }
    
            .card-header {
                background-color: #da291c;
            }
    
            .chart-title {
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 0px;
            }
    
            .project-card {
                padding: 20px;
                border-radius: 12px;
                background: #fff;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }
    
            .project-card:hover {
                transform: scale(1.03);
            }
    
            .stats-grid {
                display: flex;
                justify-content: space-between;
                margin-top: 15px;
            }
    
            .stat-item {
                text-align: center;
                flex: 1;
                background-color: #f7f7f7;
                padding: 10px;
                border-radius: 8px;
                margin: 0 10px;
                transition: background-color 0.3s;
            }
    
            .stat-item:hover {
                background-color: #e9ecef;
            }
    
            .stat-title {
                font-size: 0.9rem;
                font-weight: 500;
                color: #666;
            }
    
            .stat-value {
                font-size: 1.4rem;
                font-weight: bold;
                margin-top: 8px;
            }
    
            .text-success {
                color: #28a745 !important;
            }
    
            .text-warning {
                color: #ffc107 !important;
            }
    
            .text-info {
                color: #17a2b8 !important;
            }
    
            .animated-tile {
                animation: fadeInUp 0.8s ease;
            }
    
            @keyframes fadeInUp {
                from {
                    transform: translateY(20px);
                    opacity: 0;
                }
                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
        </style>
        
       
        @can('dashboards')
            <div class="card shadow-sm card-rounded">
                <div class="project-container">
                    <div style="position: relative; height: 70vh; width: 100%;">
                        <canvas id="projectChart"></canvas>
                    </div>
                </div>
                <div id="container"></div>
                <div class="card-body">
                   
                    <div class="tab-content" id="myTabContent">
                        @include('pages.charts_partials.tabcontent_dashbaord')
                    </div>
                </div>
                <ul class="nav nav-tabs justify-content-start mt-4 mx-9" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="chart-tab" data-bs-toggle="tab" href="#chart" role="tab" aria-controls="chart" aria-selected="true"><h6>Project Analytics</h6></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="table-tab" data-bs-toggle="tab" href="#table" role="tab" aria-controls="table" aria-selected="false"><h6>Project Table</h6></a>
                    </li>
                </ul>
                <div class="card-footer bg-danger text-white p-0 m-0">
                    <h6 class="header-title  p-0 m-0">Project Response Analytics</h6>
                </div>
            </div>
        @endcan

        @push('scripts')
        <script src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
    
        
        <script>
            $(document).ready(function() {
                $('#chart_div, #main').hide();
                $('#project_id').on('change', function() {
                   
                    var projectId = $(this).val();
                   
                    if (!projectId) {
                        $('#chart_div, #main').hide(); // Hide charts if no project is selected
                        return;
                    }

                    $('#main').html('Loading...').show();

                    $.ajax({
                        url: '/get-districts',
                        method: 'GET',
                        data: { project_id: projectId },
                        success: function(response) {
                           
                            if (response.themeTargetCounts && Array.isArray(response.themeTargetCounts)) {
                                drawGoogleChart(response.provinces, response.districts);
                                drawSunburstChart(response.themes, response.subThemes);
                           
                                const projectPartners = response.project_partners || [];
                                
                                // Update partner information
                                const uniquePartners = [...new Set(projectPartners.map(partner => partner.partner_name.name))];

                                const partnerInfoText = uniquePartners.length > 0 
                                    ? uniquePartners.join('<br>') 
                                    : 'None'; 

                                $('#partner_info').html(partnerInfoText);

                                $('#theme-cards-container').empty();

                                response.themeTargetCounts.forEach(function(theme) {
                                    var totalIndividuals = Number(theme.total_boys_target) +
                                        Number(theme.total_girls_target) +
                                        Number(theme.total_women_target) +
                                        Number(theme.total_men_target);

                                    // Generate theme card HTML
                                    var cardHtml = `<div class="col-md-2 col-6">
                                                        <div class="theme-card border-danger">
                                                            <h5 class="card-title text-danger m-0 p-0 ">${theme.main_theme_name}</h5>
                                                            <p class="card-text m-0 p-0 fs-7">Total Individuals</p>
                                                            <h6 class="card-text fs-6 m-0 p-0 mb-3">${totalIndividuals}</h6>
                                                        
                                                            <div class="row">
                                                                <div class="col-6 m-0 p-0">
                                                                    <h5 class="fs-9">Children</h5>
                                                                    <span class="fs-9">Girls: ${theme.total_girls_target ?? 0}<br>Boys: ${theme.total_boys_target ?? 0}</span>
                                                                </div>
                                                                <div class="col-6 m-0 p-0">
                                                                    <h5 class="fs-9">Adults</h5>
                                                                    <span class="fs-9">Women: ${theme.total_women_target ?? 0}<br>Men: ${theme.total_men_target ?? 0}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>`;
                                    $('#theme-cards-container').append(cardHtml);
                                });

                                // Now add the project data
                                if (response.projectData && response.projectData.length) {
                                    var projectHtml = `<div class="col-md-12">
                                            <div class="theme-card border-danger project-card animated-tile">
                                                <h5 class="card-title text-danger m-0 p-0 ">Project Overview</h5>
                                                <p class="card-text m-0 p-0 fs-7">Project Name: <strong>${response.projectData[0].project_name}</strong></p>
                                                <div class="stats-grid">
                                                    <div class="stat-item">
                                                        <p class="stat-title">Total Activities</p>
                                                        <p class="stat-value">${response.projectData[0].total_activities_count}</p>
                                                    </div>
                                                    <div class="stat-item">
                                                        <p class="stat-title">Total Targets</p>
                                                        <p class="stat-value">${response.projectData[0].total_activities_target_count}</p>
                                                    </div>
                                                    <div class="stat-item">
                                                        <p class="stat-title">Completed Targets</p>
                                                        <p class="stat-value text-success">${response.projectData[0].complete_activities_count}</p>
                                                    </div>
                                                    <div class="stat-item">
                                                        <p class="stat-title">Overdue Targets</p>
                                                        <p class="stat-value text-warning">${response.projectData[0].overdue_count}</p>
                                                    </div>
                                                    <div class="stat-item">
                                                        <p class="stat-title">Pending Targets</p>
                                                        <p class="stat-value text-info">${response.projectData[0].pending_count}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                                    $('#theme-cards-container').prepend(projectHtml); // Add project data at the top
                                }
                            }
                        }
                    });
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Load data for the project chart
                const projectNames = {!! json_encode($projectNames) !!}; // Project names
                const completeActivities = {!! json_encode($completeActivities) !!}; // Complete activities count
                const overdueActivities = {!! json_encode($overdueActivities) !!}; // Overdue activities count
                const pendingActivities = {!! json_encode($pendingActivities) !!}; // Pending activities count
        
                const ctx = document.getElementById('projectChart').getContext('2d');
                const projectChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: projectNames, // Using project names as labels
                        datasets: [
                            {
                                label: 'Complete Targets',
                                data: completeActivities, // Data for complete activities
                                backgroundColor: 'rgba(39, 174, 96, 0.6)',
                                borderColor: 'rgba(39, 174, 96, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Overdue Targets',
                                data: overdueActivities, // Data for overdue activities
                                backgroundColor: 'rgba(231, 76, 60, 0.6)',
                                borderColor: 'rgba(231, 76, 60, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Pending Targets',
                                data: pendingActivities, // Data for pending activities
                                backgroundColor: 'rgba(241, 196, 15, 0.6)',
                                borderColor: 'rgba(241, 196, 15, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // Allows for better control of aspect ratio
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Number of Targets'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Projects'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Project Activity Overview'
                            }
                        }
                    }
                });
            });
        </script>
        <script src="{{ asset('assets/js/custom/charts/projectdashboard.js') }}"></script>
        @endpush
    </x-default-layout>
