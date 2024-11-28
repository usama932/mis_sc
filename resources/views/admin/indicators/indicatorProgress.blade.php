<x-default-layout>
    @section('title', 'Indicators Progressx')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card mb-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-10px me-5">
                                    <span class="symbol-label bg-light-danger">
                                        <i class="ki-duotone ki-filter-search fs-2x text-danger">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bold">Apply Filters</a>
                                </div>
                            </div>
                        </button>
                    </h3>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row mb-5">
                                <!-- Project Field -->
                                <div class="col-md-4 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">Project</label>
                                    <select name="project" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select form-select-solid" data-allow-clear="true">
                                        <option value="">Select Project</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="card">
            <div class="card-body pt-3">
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="indicatorprogress" style="width:100%">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Indicator </th>
                                <th>Indicator LOP Target</th>
                                <th>Activity LOP Target</th>
                                <th>Total Women Target</th>
                                <th>Total Men Target</th>
                                <th>Total Girls Target</th>
                                <th>Total Boys Target</th>
                                <th>Total PWD Target</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
