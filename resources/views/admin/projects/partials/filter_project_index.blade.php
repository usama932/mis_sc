
<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h3 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <div class="d-flex align-items-center">
                    <!--begin::Symbol-->
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
                <div class="card-header border-0">
                    <div class="row mb-5">
                        <div class="col-md-4 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="">Project</span>
                            </label>
                            <select name="project" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select form-select-solid" data-allow-clear="true">
                                <option value="">Select Project</option>
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="">Project Status</span>
                            </label>
                            <select name="status" id="status" aria-label="Select a Project Status" data-control="select2" data-placeholder="Select a Project Status" class="form-select form-select-solid" data-allow-clear="true">
                                <option value="">Select Project Status</option>
                               
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="">Project Type</span>
                            </label>
                            <select name="type" id="type" aria-label="Select a Project Type" data-control="select2" data-placeholder="Select a Project Type" class="form-select form-select-solid" data-allow-clear="true">
                                <option value="">Select Project Type</option>
                                    <option value="Development">Development</option>
                                    <option value="Humanitarian">Humanitarian</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2 ">
                                <span class="required"> Start Date</span>
                            </label>
                            <div class="input-group ">
                                <input type="text" name="startdate" id="start_date" placeholder="Select date" class="form-control" data-provide="datepicker" value="">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required"> End Date</span>
                            </label>
                            <div class="input-group ">
                                <input type="text" name="enddate" id="end_date" placeholder="Select date" class="form-control" data-provide="datepicker" value="">
                            </div>
                        </div>
                        <div class="col-md-3 mt-5">
                            <button id="reset-date" class="btn btn-primary btn-sm mt-5">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>