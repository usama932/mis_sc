    <x-default-layout>
        @section('title')
        Dashboard
        @endsection

        <script src="https://d3js.org/d3.v6.min.js"></script>
        <style>
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

           

            /* Improved Layout */
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
        </style>

        <style>
            /* Animated tile and project card styling */
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

            /* Animation for professional look */
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
                <div class="card-header">
                    <h2 class="header-title">Project DIP Analytics</h2>
                </div>
                <div class="card-body">
                    <!-- Project Selection -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <select name="project" id="project_id" class="form-select btn-select fs-6" aria-label="Select a Project">
                                <option value="" class="fs-8">Select a Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" class="fs-8">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                 
                    <div class="row g-4 my-4" id="theme-cards-container"></div>
                    <!-- Charts Section -->
                    <div class="row g-4">
                        <!-- Google Chart -->
                        <div class="col-md-6">
                            <div class="chart-container border-danger">
                                <div class="chart-title text-danger">Organization Chart of Pakistan</div>
                                <div id="chart_div"></div>
                                <div class="district-card mt-3">
                                    <h5 class="text-danger"><i>Implemented By:</i></h5>
                                    <div class="partner-info"  id="partner_info">
                                        
                                    </div>
                                </div>
                    
                            </div>
                        </div>
                        <!-- Sunburst Chart -->
                        <div class="col-md-6 ">
                            <div class="chart-container border-danger">
                                <div class="chart-title text-danger">Theme-wise Progress Analysis</div>
                                <div id="main" style="width: 100%; height: 100%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="container m-3">
                        <div class="table-responsive overflow-*">
                            <table class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="fs-9">Project</th>
                                        <th class="fs-9">Type</th>
                                        <th class="fs-9">SOF</th>
                                        <th class="fs-9">SCI OPs FP</th>
                                        <th class="fs-9">Budget Holder</th>
                                        <th class="fs-9">Tenure</th>
                                        <th class="fs-9">DIP</th>
                                        <th class="fs-9">Total Activities</th>
                                        <th class="fs-9">Total Targets</th>
                                        <th class="fs-9">Complete Targets</th>
                                        <th class="fs-9">Overdue Targets</th>
                                        <th class="fs-9">Pending Targets</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project_data as $project)
                                    <tr>
                                        <td class="fs-9">{{ $project->name }}</td>
                                        <td class="fs-9">{{ $project->type }}</td>
                                        <td class="fs-9">{{ $project->sof }}</td>
                                        <td class="fs-9">{{ $project->focal_person }}</td>
                                        <td class="fs-9">{{ $project->budget_holder }}</td>
                                        <td class="fs-9">{{ date('M d,Y', strtotime($project->start_date))}} - {{date('M d,Y', strtotime($project->end_date));}}</td>
                                        <td class="fs-9">@if($project->activities->count() > 0) Yes @else No @endif</td>
                                        <td class="fs-9">{{ $project->total_activities_count }}</td>
                                        <td class="fs-9">{{ $project->total_activities_target_count }}</td>
                                        <td class="fs-9">{{ $project->complete_activities_count }}</td>
                                        <td class="fs-9">{{ $project->overdue_count }}</td>
                                        <td class="fs-9">{{ $project->pending_count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

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

                                // Ensure projectPartners are part of the response
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
        <script src="{{ asset('assets/js/custom/charts/projectdashboard.js') }}"></script>
        @endpush
    </x-default-layout>
