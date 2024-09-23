<x-default-layout>

    @section('title')
    Dashboard
    @endsection
    
    <script src="https://d3js.org/d3.v6.min.js"></script>
    <style>
        .chart-container {
            height: 400px;
            overflow: auto;
            background-color: #f1e8e3;
        }
    
        #chart_div, #main {
            background-color: #f1e8e3;
            padding: 10px;
            border-radius: 5px;
            display: none; /* Initially hide the charts */
        }
    
        @media (max-width: 768px) {
            .chart-container {
                width: 100% !important;
            }
        }
    </style>
    <style>
      .tile {
  background-color: #f1e8e3;
  border: 1px solid #ddd;
  padding: 20px;
}

.tile-header {
  text-align: center;
}

.tile-title {
  color: #da291c;
  font-size: 24px;
  font-weight: bold;
}

.tile-subtitle {
  color: #da291c;
  font-size: 18px;
}

.tile-body {
  padding-top: 20px;
}

.child-stats, .adult-stats {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.child-stats img, .adult-stats img {
  width: 30px;
  height: 30px;
  margin-right: 10px;
}
    </style>
    @can('dashboards')
        <div class="card card-px-0 shadow-sm card-rounded">
            <div class="card-header rounded" style="background-color: #da291c;">
                <h2 class="card-title mx-3 text-white">Project DIP</h2>
            </div>
            <div class="card-body">
                <div class="row mx-3">
                    <div class="col-md-3 col-lg-3 col-sm-12">
                        <select name="project" id="project_id" aria-label="Select a Project" data-control="select2"
                                data-placeholder="Select a Project" class="form-select fs-9" data-allow-clear="true">
                            <option value="" class="fs-9">Select a Project</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mx-3 mt-2">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="card">
                            <div class="card-body chart-container">
                                <div id="chart_div" style="width: 100%; height: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="card">
                            <div class="card-body chart-container">
                                <div id="main" style="width: 100%; height: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                      <div class="card text-center">
                        <div class="card-header">   
                          <h5 class="card-title">WASH</h5>
                        </div>
                        <div class="card-body">
                          <h1 class="card-text">145,837</h1>
                          <p class="card-text">Total Individuals</p>
                          <div class="row">
                            <div class="col-6">
                              <h5>Children</h5>
                                <span>Girls: 37,714<br>
                                Boys: 33,975</span>
                              </ul>
                            </div>
                            <div class="col-6">
                                <h5>Adults</h5>
                                <span>
                                    Women: 40,437 <br>
                                    Men: 33,691
                                </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                
                
            </div>
            <div class="card-footer rounded" style="background-color: #da291c;">
                <h3 class="card-title mx-3 text-white"> Project Response</h3>
            </div>
        </div>
    @endcan
    
    @push('scripts')
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initially hide charts
            $('#chart_div, #main').hide();
    
            // When project is selected
            $('#project_id').on('change', function() {
                var projectId = $(this).val();
                if (!projectId) {
                    $('#chart_div, #main').hide(); // Hide charts if no project is selected
                    return;
                }
    
                // Show loading indicator
                $('#main').html('Loading...').show();
    
                $.ajax({
                    url: '/get-districts',
                    method: 'GET',
                    data: { project_id: projectId },
                    success: function(response) {
                        console.log("Response:", response); // Log the response
                        drawGoogleChart(response.provinces, response.districts);
                        drawSunburstChart(response.themes, response.subThemes); 
                       
                    },
                    error: function() {
                        alert('Error fetching data');
                    }
                });
            });
    
                // Function to draw Google Org Chart
         

        });
    </script>
    <script src="{{ asset('assets/js/custom/charts/projectdashboard.js') }}"></script>
    @endpush
    
    </x-default-layout>
    