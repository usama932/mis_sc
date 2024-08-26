
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
                            <span class="">Thematic Area</span>
                        </label>
                        <select name="subtheme" id="subtheme" aria-label="Select a Sub Theme Name" data-control="select2" data-placeholder="Select a Sub Theme Name" class="form-select form-select-solid" data-allow-clear="true">
                            <option value="">Select Sub Theme</option>
                            @foreach($subthemes as $subtheme)
                                <option value="{{$subtheme->id}}">{{$subtheme->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="">Added By</span>
                        </label>
                        <select name="added_by" id="added_by" aria-label="Select a  Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select form-select-solid" data-allow-clear="true">
                            <option value="">Select Project</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>
</div>