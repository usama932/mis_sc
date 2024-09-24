<x-default-layout>
    @section('title')
    Dashboard
    @endsection
    
    <script src="https://d3js.org/d3.v6.min.js"></script>
    <style>
        .chart-container {
            height: 400px;
            overflow: hidden;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
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
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            border: 1px solid #ddd;
        }

        .theme-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .theme-card h5 {
            font-weight: 700;
            color: #555;
        }

        .theme-card .card-body h1 {
            color: #da291c;
            font-size: 2.5rem;
        }

        .theme-card .card-body p {
            font-size: 1.1rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .chart-container {
                width: 100% !important;
            }
        }
    </style>

    @can('dashboards')
        <div class="card shadow-sm card-rounded">
            <div class="card-header bg-danger text-white">
                <h2 class="card-title mx-3">Project DIP Analytics</h2>
            </div>
            <div class="card-body">
                <!-- Project Selection -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <select name="project" id="project_id" class="form-select fs-6" aria-label="Select a Project">
                            <option value="" class="fs-6">Select a Project</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-4 my-4" id="theme-cards-container"></div>
                <!-- Charts Section -->
                <div class="row g-4">
                    <!-- Google Chart -->
                    <div class="col-md-6">
                        <div id="chart_container" class="chart-container">
                            <div id="chart_title" style="text-align: center; font-weight: bold; font-size: 24px;">Organization Chart of Pakistan</div>
                            <div id="chart_div" style="margin-top: 20px;"></div>
                        </div>
                    </div>
                    <!-- Sunburst Chart -->
                    <div class="col-md-6">
                        <div class="chart-container">
                            <div id="main" style="width: 100%; height: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-danger text-white">
                <h3 class="card-title mx-3">Project Response Analytics</h3>
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
                        const projectPartners = response.projectPartners || [];

                        $('#theme-cards-container').empty();

                        response.themeTargetCounts.forEach(function(theme) {
                            var totalIndividuals = Number(theme.total_boys_target) + 
                                                Number(theme.total_girls_target) + 
                                                Number(theme.total_women_target) + 
                                                Number(theme.total_men_target);

                            // Filter partners related to this theme
                            var partnersHtml = '';
                            var relatedPartners = projectPartners.filter(function(partner) {
                                return partner.partnertheme.subtheme.sci_theme_id == theme.main_theme_id;
                            });

                            if (relatedPartners.length > 0) {
                                partnersHtml += '<h5>Partners:</h5><ul>';
                                relatedPartners.forEach(function(partner) {
                                    partnersHtml += `
                                        <li>
                                            <strong>Partner Name:</strong> ${partner.partner_name.name} <br>
                                            <strong>Assigned User:</strong> ${partner.user.name} <br>
                                        </li>
                                    `;
                                });
                                partnersHtml += '</ul>';
                            } else {
                                partnersHtml += '<p>No partners available for this theme.</p>';
                            }

                            // Generate theme card HTML
                            var cardHtml = `
                                <div class="col-md-3">
                                    <div class="card theme-card text-center">
                                        <div class="card-header bg-danger text-white">   
                                            <h5 class="card-title">${theme.main_theme_name}</h5>
                                        </div>
                                        <div class="card-body">
                                            <h1 class="card-text">${totalIndividuals}</h1>
                                            <p class="card-text fs-7">Total Individuals</p>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="fs-7">Children</h5>
                                                    <span class="fs-7">Girls: ${theme.total_girls_target ?? 0}<br>Boys: ${theme.total_boys_target ?? 0}</span>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="fs-7">Adults</h5>
                                                    <span class="fs-7">Women: ${theme.total_women_target ?? 0}<br>Men: ${theme.total_men_target ?? 0}</span>
                                                </div>
                                            </div>
                                            ${partnersHtml}
                                        </div>
                                    </div>
                                </div>
                            `;

                            $('#theme-cards-container').append(cardHtml);
                        });
                    } else {
                        console.error("themeTargetCounts not found or is not an array");
                    }
                    }
                });
            });
        });

    </script>
    <script src="{{ asset('assets/js/custom/charts/projectdashboard.js') }}"></script>
    @endpush
</x-default-layout>
