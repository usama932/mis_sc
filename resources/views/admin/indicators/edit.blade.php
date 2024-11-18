<x-nform-layout>
    @section('title')
        Add Indicator
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('indicators.update',$indicator->id)}}" method="post" id="create_indicator" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body py-4">
                    <div class="row">
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Project</span>
                            </label>
                            <select name="project" id="projectId" class="form-select  " data-control="select2" data-placeholder="Select Project"  data-allow-clear="true">
                                <option value="">Select Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" @if($indicator->project_id == $project->id) selected @endif>{{ $project->name }}</option>
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
                                <option value="Impact"  @if($indicator->log_frame_level == "Impact") selected @endif>Impact</option>
                                <option value="Intermediate Result"  @if($indicator->log_frame_level == "Intermediate Result") selected @endif>Intermediate Result</option>
                                <option value="OutCome"  @if($indicator->log_frame_level == "OutCome") selected @endif>OutCome</option>
                                <option value="Output"  @if($indicator->log_frame_level == "Output") selected @endif>Output</option>
                            </select>
                            <div id="logFrameLevelError" class="invalid-feedback"></div>
                        </div>
                        
                        <!-- Log Frame Result Statement -->
                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Log Frame Result Statement</span>
                            </label>
                            <textarea name="log_frame_result_statement"  class="form-control  " rows="2" placeholder="Enter Result Statement">{{ $indicator->log_frame_result_statement }}</textarea>
                            <div id="logFrameResultStatementError" class="invalid-feedback"></div>
                        </div>

                        <!-- Indicator Name -->
                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Indicator Name</span>
                            </label>
                            <textarea type="text" name="indicator_name" class="form-control  " placeholder="Enter Indicator Name">{{ $indicator->indicator_name }}</textarea>
                            <div id="indicatorNameError" class="invalid-feedback"></div>
                        </div>

                        <!-- Indicator Context Type -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Indicator Context Type</span>
                            </label>
                            <select name="indicator_context_type" class="form-select  " data-control="select2" data-placeholder="Select Context Type"  data-allow-clear="true">
                                <option value=""></option>
                                <option value="Quantitative"  @if($indicator->indicator_context_type == "Quantitative") selected @endif>Quantitative</option>
                                <option value="Qualitative" @if($indicator->indicator_context_type == "Qualitative") selected @endif>Qualitative</option>
                            </select>
                            <div id="indicatorContextTypeError" class="invalid-feedback"></div>
                        </div>

                      

                        <!-- Total Reach Indicator -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">Total Reach Indicator?</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_total_reach_indicator" value="1" @if($indicator->is_total_reach_indicator == 1) checked @endif>
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div id="totalReachIndicatorError" class="invalid-feedback"></div>
                        </div>
                    
                        <!-- Unit of Measure -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Unit of Measure</span>
                            </label>
                            <input type="text" name="unit_of_measure" class="form-control" value="{{ $indicator->unit_of_measure }}" placeholder="Enter Unit of Measure">
                            <div id="unitOfMeasureError" class="invalid-feedback"></div>
                        </div>

                        <!-- Actual Periodicity -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Actual Periodicity</span>
                            </label>
                            <input class="form-control" name="actual_periodicity" type="text" readonly value="{{ $indicator->actual_periodicity }}">
                            {{-- <select id="actualPeriodicity" name="actual_periodicity" class="form-select">
                                <option value="">Select Actual Periodicity</option>
                                <option value="Annually" @if($indicator->actual_periodicity == "Annually") selected @endif>Annually</option>
                                <option value="Quarterly" @if($indicator->actual_periodicity == "Quarterly") selected @endif>Quarterly</option>
                                <option value="Monthly" @if($indicator->actual_periodicity == "Monthly") selected @endif>Monthly</option>
                            </select> --}}
                        </div>

                        <!-- Nature -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Nature</span>
                            </label>
                            <select name="nature" class="form-select  " data-control="select2" data-placeholder="Select Nature"  data-allow-clear="true">
                                <option value=""></option>
                                <option value="Cumulative" @if($indicator->nature == "Cumulative") selected @endif>Cumulative</option>
                                <option value="Incremental" @if($indicator->nature == "Incremental") selected @endif>Incremental</option>
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
                                <option value="Number" @if($indicator->data_format == "Number") selected @endif>Number</option>
                                <option value="Percentage" @if($indicator->data_format == "Percentage") selected @endif>Percentage</option>
                                <option value="Text" @if($indicator->data_format == "Text") selected @endif>Text</option>
                                <option value="Date" @if($indicator->data_format == "Date") selected @endif>Date</option>
                                <option value="Value List" @if($indicator->data_format == "Value List") selected @endif>Value List</option>
                            </select>
                            <div id="dataFormatError" class="invalid-feedback"></div>
                        </div>
                   
                        <!-- Disaggregation -->
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label">Disaggregation</label>
                            <select name="disaggregation" class="form-select  " data-control="select2" data-placeholder="Select Disaggregation"  data-allow-clear="true">
                                <option value=""></option>
                                <option value="Age" @if($indicator->disaggregation == "Age") selected @endif>Age</option>
                                <option value="Gender" @if($indicator->disaggregation == "Gender") selected @endif>Gender</option>
                                <option value="Location" @if($indicator->disaggregation == "Location") selected @endif>Location</option>
                            </select>
                        </div>

                        <!-- Baseline -->
                        <div class="fv-row col-md-3">
                            <label class="fs-9 fw-semibold form-label">Baseline</label>
                            <input type="number"  name="baseline" class="form-control" value="{{ $indicator->baseline }}" placeholder="Enter Baseline">
                        </div>

                        @if( $indicator->actual_periodicity == 'Annually') 
                            <!-- Annual Target -->
                            <div class="fv-row col-md-2">
                                <label class="fs-9 fw-semibold form-label">Annual Target</label>
                                <input type="number" value="0" name="annual_target" class="form-control" value="{{ $indicator->annual_target }}" placeholder="Enter Annual Target">
                            </div>
                        @endif
                        @if( $indicator->actual_periodicity == 'Quarterly') 
                            <!-- Quarterly Target -->
                            <div class="fv-row col-md-2">
                                <label class="fs-9 fw-semibold form-label">Quarterly Target</label>
                                <input type="number" value="0" name="quarterly_target" class="form-control" value="{{ $indicator->quarterly_target }}" placeholder="Enter Quarterly Target">
                            </div>
                        @endif

                        @if( $indicator->actual_periodicity == 'Monthly') 
                            <!-- Monthly Target -->
                            <div class="fv-row col-md-2">
                                <label class="fs-9 fw-semibold form-label">Monthly Target</label>
                                <input type="number" value="0" name="monthly_target" class="form-control" value="{{ $indicator->monthly_target }}" placeholder="Enter Monthly Target">
                            </div>
                        @endif

                        <!-- Overall LOP Target -->
                        <div class="fv-row col-md-2">
                            <label class="fs-9 fw-semibold form-label">Overall  Target</label>
                            <input type="number"  name="overall_lop_target" value="0" class="form-control"  value="{{ $indicator->overall_lop_target }}" placeholder="Enter LOP Target">
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary m-3" id="kt_create_indicator">
                        @include('partials/general/_button-indicator', ['label' => 'Update'])
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-nform-layout>
