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
                    
                    <!-- Batch No Field -->
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">Batch No</label>
                        <select name="batch_no" id="batch_no" aria-label="Select a Batch No" data-control="select2" data-placeholder="Select a Batch No" class="form-select form-select-solid" data-allow-clear="true">
                            <option value="">Select Batch No</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->batch_number }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Form No Field -->
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">Form No.#</label>
                        <select name="form_no" id="form_no" aria-label="Select a Form No" data-control="select2" data-placeholder="Select a Form No" class="form-select form-select-solid" data-allow-clear="true">
                            <option value="">Select Form No</option>
                            @foreach($form_nums as $key => $form_num)
                                <option value="{{ $key }}">{{ $form_num }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Gender Field -->
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">Gender</label>
                        <select name="gender" id="gender" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a Gender" class="form-select form-select-solid" data-allow-clear="true">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    
                    <!-- Status Field -->
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">Status</label>
                        <select name="status" id="status" aria-label="Select a Status" data-control="select2" data-placeholder="Select a Status" class="form-select form-select-solid" data-allow-clear="true">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Verified">Verified</option>
                            <option value="Approved">Approved</option>
                        </select>
                    </div>
                    
                    <!-- Contact Number Field -->
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">Contact Number</label>
                        <select name="contact" id="contact" aria-label="Select a Contact" data-control="select2" data-placeholder="Select a Contact" class="form-select form-select-solid" data-allow-clear="true">
                            <option value="">Select Contact</option>
                            @foreach($contacts as $key => $contact)
                                <option value="{{ $key }}">{{ $contact }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Beneficiary CNIC Field -->
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">Beneficiary CNIC</label>
                        <select name="cnic" id="cnic" aria-label="Select a CNIC" data-control="select2" data-placeholder="Select a CNIC" class="form-select form-select-solid" data-allow-clear="true">
                            <option value="">Select CNIC</option>
                            @foreach($cnics as $key => $cnic)
                                <option value="{{ $key }}">{{ $cnic }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
