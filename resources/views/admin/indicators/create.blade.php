<x-nform-layout>
    @section('title')
        Add Indicator
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('indicators.store')}}" method="post" id="create_indicator" enctype="multipart/form-data" data-kt-redirect-url="{{ route('indicators.index') }}">
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Project</span>
                            </label>
                            <select name="project" id="projectId" class="form-select" data-control="select2" data-placeholder="Select Project"  data-allow-clear="true">
                                <option value="">Select Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                            <div id="logFrameLevelError" class="invalid-feedback"></div>
                        </div>
                          <!-- Theme -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">Theme</label>
                            <select name="theme[]" id="themeSelect" multiple class="form-select   select2" data-control="select2" data-placeholder="Select Theme"  data-allow-clear="true">
                                <option value="">Select Theme</option>
                                {{-- @foreach($themes as $theme)
                                    <option value="{{ $theme->id}}">{{ $theme->name }}</option>
                                @endforeach --}}
                            </select>
                            <div id="themeError" class="invalid-feedback"></div>
                        </div>

                        <!-- Sub-Theme -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">Subtheme</label>
                            <select id="subthemeSelect" name="subtheme[]" multiple class="form-select   select2" data-control="select2" data-placeholder="Select Subtheme" data-allow-clear="true">
                                <option value="">Select Subtheme</option>
                                <!-- Subthemes will be populated here -->
                            </select>
                            <div id="subthemeError" class="invalid-feedback"></div>
                        </div>
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Log Frame Level</span>
                            </label>
                            <select name="log_frame_level" class="form-select  " data-control="select2" data-placeholder="Select Log Frame Level"  data-allow-clear="true">
                                <option value="">Select Log Frame Level</option>
                                <option value="Impact">Impact</option>
                                <option value="Intermediate Result">Intermediate Result</option>
                                <option value="OutCome">OutCome</option>
                                <option value="Output">Output</option>
                            </select>
                            <div id="logFrameLevelError" class="invalid-feedback"></div>
                        </div>
                        
                        <!-- Log Frame Result Statement -->
                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Log Frame Result Statement</span>
                            </label>
                            <textarea name="log_frame_result_statement"  class="form-control  " rows="2" placeholder="Enter Result Statement"></textarea>
                            <div id="logFrameResultStatementError" class="invalid-feedback"></div>
                        </div>

                        <!-- Indicator Name -->
                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Indicator Name</span>
                            </label>
                            <textarea type="text" name="indicator_name" class="form-control  " placeholder="Enter Indicator Name"></textarea>
                            <div id="indicatorNameError" class="invalid-feedback"></div>
                        </div>

                        <!-- Indicator Context Type -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Indicator Context Type</span>
                            </label>
                            <select name="indicator_context_type" class="form-select  " data-control="select2" data-placeholder="Select Context Type"  data-allow-clear="true">
                                <option value=""></option>
                                <option value="Quantitative">Quantitative</option>
                                <option value="Qualitative">Qualitative</option>
                            </select>
                            <div id="indicatorContextTypeError" class="invalid-feedback"></div>
                        </div>

                      

                        <!-- Total Reach Indicator -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">Total Reach Indicator?</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_total_reach_indicator" value="1">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div id="totalReachIndicatorError" class="invalid-feedback"></div>
                        </div>
                    
                        <!-- Unit of Measure -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Unit of Measure</span>
                            </label>
                            <input type="text" name="unit_of_measure" class="form-control  " placeholder="Enter Unit of Measure">
                            <div id="unitOfMeasureError" class="invalid-feedback"></div>
                        </div>

                        <!-- Actual Periodicity -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Actual Periodicity</span>
                            </label>
                            <select id="actualPeriodicity" name="actual_periodicity" class="form-select">
                                <option value="">Select Actual Periodicity</option>
                                <option value="Annually">Annually</option>
                                <option value="Quarterly">Quarterly</option>
                                <option value="Monthly">Monthly</option>
                            </select>
                        </div>

                        <!-- Nature -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Nature</span>
                            </label>
                            <select name="nature" class="form-select  " data-control="select2" data-placeholder="Select Nature"  data-allow-clear="true">
                                <option value=""></option>
                                <option value="Cumulative">Cumulative</option>
                                <option value="Incremental">Incremental</option>
                            </select>
                            <div id="natureError" class="invalid-feedback"></div>
                        </div>

                        <!-- Data Format -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Data Format</span>
                            </label>
                            <select name="data_format" class="form-select  " data-control="select2" data-placeholder="Select Data Format"  data-allow-clear="true">
                                <option value=""></option>
                                <option value="Number">Number</option>
                                <option value="Percentage">Percentage</option>
                                <option value="Text">Text</option>
                                <option value="Date">Date</option>
                                <option value="Value List">Value List</option>
                            </select>
                            <div id="dataFormatError" class="invalid-feedback"></div>
                        </div>
                   
                        <!-- Disaggregation -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">Disaggregation</label>
                            <select name="disaggregation" class="form-select  " data-control="select2" data-placeholder="Select Disaggregation"  data-allow-clear="true">
                                <option value=""></option>
                                <option value="Age">Age</option>
                                <option value="Gender">Gender</option>
                                <option value="Location">Location</option>
                            </select>
                        </div>

                        <!-- Baseline -->
                        <div class="fv-row col-md-1">
                            <label class="fs-9 fw-semibold form-label">Baseline</label>
                            <input type="number"  name="baseline" class="form-control  " placeholder="Enter Baseline">
                        </div>

                            
                        <!-- Annual Target -->
                        <div class="fv-row col-md-1 target-field" id="annualTargetField" style="display: none;">
                            <label class="fs-9 fw-semibold form-label">Annual Target</label>
                            <input type="number" value="0" name="annual_target" class="form-control" placeholder="Enter Annual Target">
                        </div>

                        <!-- Quarterly Target -->
                        <div class="fv-row col-md-1 target-field" id="quarterlyTargetField" style="display: none;">
                            <label class="fs-9 fw-semibold form-label">Quarterly Target</label>
                            <input type="number" value="0" name="quarterly_target" class="form-control" placeholder="Enter Quarterly Target">
                        </div>

                        <!-- Monthly Target -->
                        <div class="fv-row col-md-1 target-field" id="monthlyTargetField" style="display: none;">
                            <label class="fs-9 fw-semibold form-label">Monthly Target</label>
                            <input type="number" value="0" name="monthly_target" class="form-control" placeholder="Enter Monthly Target">
                        </div>

                        <!-- Overall LOP Target -->
                        <div class="fv-row col-md-1">
                            <label class="fs-9 fw-semibold form-label">Overall  Target</label>
                            <input type="number"  name="overall_lop_target" value="0" class="form-control  " placeholder="Enter LOP Target">
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary m-3" id="kt_create_indicator">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                </div>
            </form>
        </div>
    </div>
    @push('script')
    <script>
        $('#projectId').change(function () {
            alert(projectId);
            const projectId = $(this).val();
            
            if (projectId) {
                $.ajax({
                    url: '/get-project-quarters',
                    type: 'POST',
                    data: {
                        project_id: projectId,
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },
                    success: function (response) {
                        if (response.success) {
                            let quarters = response.data;
                            $('#quarters_container').html(''); // Clear previous data

                            quarters.forEach(function (quarter) {
                                $('#quarters_container').append(`
                                    <div>
                                        <strong>${quarter.name}</strong>: ${quarter.dates.join(', ')}
                                    </div>
                                `);
                            });
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function () {
                        alert('Failed to fetch project quarters.');
                    }
                });
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const actualPeriodicitySelect = document.getElementById("actualPeriodicity");
            const annualTargetField = document.getElementById("annualTargetField");
            const quarterlyTargetField = document.getElementById("quarterlyTargetField");
            const monthlyTargetField = document.getElementById("monthlyTargetField");

            function updateTargetFields() {
                const selectedValue = actualPeriodicitySelect.value;

                // Hide all target fields by default
                annualTargetField.style.display = "none";
                quarterlyTargetField.style.display = "none";
                monthlyTargetField.style.display = "none";

                // Show the appropriate target field based on selection
                if (selectedValue === "Annually") {
                    annualTargetField.style.display = "block";
                } else if (selectedValue === "Quarterly") {
                    quarterlyTargetField.style.display = "block";
                } else if (selectedValue === "Monthly") {
                    monthlyTargetField.style.display = "block";
                }
            }

            // Run on page load and when the selection changes
            actualPeriodicitySelect.addEventListener("change", updateTargetFields);
        });
    </script>
    @endpush
</x-nform-layout>
