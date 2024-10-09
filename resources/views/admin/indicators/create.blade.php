<x-nform-layout>
    @section('title')
        Add Indicator
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('indicators.store')}}" method="post" id="create_indicator" enctype="multipart/form-data">
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                        
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Log Frame Level</span>
                            </label>
                            <input type="text" name="log_frame_level" placeholder="Log Frame Level" class="form-control" value="">
                            <div id="logFrameLevelError" class="error-message"></div>
                        </div>
                        
                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Log Frame Result Statement</span>
                            </label>
                            <textarea name="log_frame_result_statement" rows="1" placeholder="Log Frame Result Statement" class="form-control"></textarea>
                            <div id="logFrameResultStatementError" class="error-message"></div>
                        </div>

                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Indicator Name</span>
                            </label>
                            <input type="text" name="indicator_name" placeholder="Indicator Name" class="form-control" value="">
                            <div id="indicatorNameError" class="error-message"></div>
                        </div>
                        
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Indicator Context Type</span>
                            </label>
                            <select name="indicator_context_type" class="form-select select2" data-placeholder="Select Context Type">
                                <option value="">Select Type</option>
                                <option value="Quantitative">Quantitative</option>
                                <option value="Qualitative">Qualitative</option>
                            </select>
                            <div id="indicatorContextTypeError" class="error-message"></div>
                        </div>

                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span>Theme</span>
                            </label>
                            <input type="text" name="theme" placeholder="Theme" class="form-control" value="">
                            <div id="themeError" class="error-message"></div>
                        </div>

                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span>Sub-Theme</span>
                            </label>
                            <input type="text" name="sub_theme" placeholder="Sub-Theme" class="form-control" value="">
                            <div id="subThemeError" class="error-message"></div>
                        </div>

                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span>Total Reach Indicator?</span>
                            </label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_total_reach_indicator" value="1">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div id="totalReachIndicatorError" class="error-message"></div>
                        </div>

                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Unit of Measure</span>
                            </label>
                            <input type="text" name="unit_of_measure" placeholder="Unit of Measure" class="form-control" value="">
                            <div id="unitOfMeasureError" class="error-message"></div>
                        </div>

                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Actual Periodicity</span>
                            </label>
                            <select name="actual_periodicity" class="form-select select2" data-placeholder="Select Periodicity">
                                <option value="">Select Periodicity</option>
                                <option value="Once">Once</option>
                                <option value="Midline/Endline">Midline/Endline</option>
                                <option value="Annually">Annually</option>
                                <option value="Semi Annually">Semi Annually</option>
                                <option value="Quarterly">Quarterly</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Daily">Daily</option>
                            </select>
                            <div id="actualPeriodicityError" class="error-message"></div>
                        </div>

                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Nature</span>
                            </label>
                            <select name="nature" class="form-select select2" data-placeholder="Select Nature">
                                <option value="">Select Nature</option>
                                <option value="Cumulative">Cumulative</option>
                                <option value="Incremental">Incremental</option>
                            </select>
                            <div id="natureError" class="error-message"></div>
                        </div>

                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Data Format</span>
                            </label>
                            <select name="data_format" class="form-select select2" data-placeholder="Select Data Format">
                                <option value="">Select Format</option>
                                <option value="Number">Number</option>
                                <option value="Percentage">Percentage</option>
                                <option value="Text">Text</option>
                                <option value="Date">Date</option>
                                <option value="Value List">Value List</option>
                            </select>
                            <div id="dataFormatError" class="error-message"></div>
                        </div>

                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2">Disaggregation</label>
                            <select name="indicator_context_type" class="form-select select2" data-placeholder="Select Context Type">
                                <option value="">Select Disaggregation</option>
                                <option value="Age">Age</option>
                                <option value="Gender">Gender</option>
                                <option value="Location">Location</option>
                            </select>
                        </div>

                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">Baseline</label>
                            <input type="number" step="0.01" name="baseline" placeholder="Baseline" class="form-control">
                        </div>

                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">Overall LOP Target</label>
                            <input type="number" step="0.01" name="overall_lop_target" placeholder="Overall LOP Target" class="form-control">
                        </div>

                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" id="kt_create_indicator" class="btn btn-success btn-sm m-5">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-nform-layout>
