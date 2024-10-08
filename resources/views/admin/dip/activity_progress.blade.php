<x-nform-layout>
    @section('title')
       Add Activity Progress
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        @can('project filter')
            <div class="card mb-5">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-50px me-5">
                                        <span class="symbol-label bg-light-danger">
                                            <i class="ki-duotone ki-filter-search fs-2x text-danger">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column">
                                        <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bold">Apply Filters</a>
                                    </div>
                                    <!--end::Text-->
                                </div>
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row mb-5">
                                    <div class="col-md-4 mt-3">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span>Project</span>
                                        </label>
                                        <select name="project" id="project" aria-label="Select a Project" data-control="select2" data-placeholder="Select a Project..." class="form-select" data-allow-clear="true">
                                            <option value=''>Select Project</option>
                                            @foreach($projects as $project)
                                                @if(!empty($project->detail))
                                                <option value='{{$project->id}}'>{{ucfirst($project->name)}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span>Theme</span>
                                        </label>
                                        <select name="theme" id="theme_id" aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme..." class="form-select" data-allow-clear="true">
                                            <option value=''>Select Project</option>
                                            @foreach($themes as $theme)
                                                <option value='{{$theme->id}}'>{{ucfirst($theme->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row col-md-4 mt-3">
                                        <label class="fs-6 fw-semibold form-label d-flex">
                                            <span class="required">Sub-Thematic Area</span>
                                            <span class="spinner-border spinner-border-sm align-middle ms-2" id="themeloader"
                                                style="display: none !important;"></span>
                                        </label>
                                        <select name="subtheme_id" id="subtheme_id" aria-label="Select a Sub-Theme"
                                            data-control="select2" data-placeholder="Select a Sub-Theme" class="form-select"
                                            data-allow-clear="true">
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        <div class="card">
            <div class="card-body">
            
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="dip_activity" style="width:100%">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Activity Title</th>
                                <th>Sub Theme</th>
                                <th>Activity Type</th>
                                <th>Project</th>
                                <th>LOP Target</th>
                                <th>Month</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Update Progress</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-nform-layout>
