<div class="row">
    <div class="fv-row col-md-6 fv-row">
        <label class="fs-6 fw-bolder required">Project</label>
        <select name="project" id="projectId" class="form-control form-select" required aria-label="Select a Project" data-control="select2" data-placeholder="Select a Project..." class="form-select"  data-allow-clear="true" >
            <option value="">Select Project</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
        <div id="projectError" class="invalid-feedback" style="display: none;"></div>
    </div>

  
    <div class="fv-row col-md-3 fv-row">
        <label class="fs-6 fw-bolder required">Date</label>
        <input type="text" name="date" id="mpca_Date" class="form-control" required />
        <div id="dateError" class="invalid-feedback" style="display: none;"></div>
    </div>
  
    <div class="fv-row col-md-3 fv-row">
        <div class="d-flex"> 
            <label class="fs-6 fw-bolder required">Province</label>
        </div>
        <select name="province" id="provinceId" class="form-select" data-control="select2" data-placeholder="Select Province" data-allow-clear="true" required>
            <option value="">Select Province</option>
            @foreach ($provinces as $province)
                <option value="{{ $province->province_id }}">{{ $province->province_name }}</option>
            @endforeach
        </select>
        <div id="provinceError" class="invalid-feedback" style="display: none;"></div>
    </div>
    
    <div class="fv-row col-md-3 mt-3 fv-row">
        <div class="d-flex"> 
            <label class="fs-6 fw-bolder form-label required">District</label>
            <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
        </div>
        <select name="district" id="districtId" class="form-control form-select" data-control="select2" data-placeholder="Select District" data-allow-clear="true" required>
            <option value="">Select District</option>
        </select>
        <div id="districtError" class="invalid-feedback" style="display: none;"></div>
    </div>
    
    <div class="fv-row col-md-3 mt-3 fv-row">
        <div class="d-flex"> 
            <label class="fs-6 fw-bolder form-label required">Tehsil</label>
            <span class="spinner-border spinner-border-sm align-middle ms-2" id="tehsilloader"></span>
        </div>
        <select name="tehsil" id="tehsilId" class="form-control form-select" data-control="select2" data-placeholder="Select Tehsil" data-allow-clear="true" required>
            <option value="">Select Tehsil</option>
        </select>
        <div id="tehsilError" class="invalid-feedback" style="display: none;"></div>
    </div>
    
    <div class="fv-row col-md-3 mt-3 fv-row">
        <div class="d-flex"> 
            <label class="fs-6 fw-bolder form-label required">UC</label>
            <span class="spinner-border spinner-border-sm align-middle ms-2" id="ucloader"></span>
        </div>
        <select name="uc" id="ucId" class="form-control form-select" data-control="select2" data-placeholder="Select UC" data-allow-clear="true" required>
            <option value="">Select UC</option>
        </select>
        <div id="ucError" class="invalid-feedback" style="display: none;"></div>
    </div>
    
    <div class="fv-row col-md-6 fv-row">
        <label class="fs-6 fw-bolder form-label required">Village</label>
        <textarea class="form-control" rows="1" name="village" id="village" required ></textarea>
        <div id="villageError" class="invalid-feedback" style="display: none;"></div>
    </div>
    
    <div class="fv-row col-md-6 fv-row">
        <label class="fs-6 fw-bolder form-label">Sub Village</label>
        <textarea class="form-control" rows="1" name="subvillage" id="subvillage"></textarea>
        <div id="subvillageError" class="invalid-feedback"></div>
    </div>
</div>
