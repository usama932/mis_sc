
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
                        <div class="col-md-4 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Unique Code</span>
                            </label>
                            <input class="form-control" placeholder="Enter Assesment Code" id="assesment_code" name="assesment_code" >
                        </div>
                        <div class="col-md-4 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required" >Date Visit</span>
                            </label>
                            <input class="form-control" aria-label="Pick date range"  placeholder="Pick date range" id="date_visit" name="date_visit" value=" ">
                        </div>
                        <div class="col-md-4 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required"> Name of Staff</span>
                            </label>
                            <select name="visit_staff" id="visit_staff" aria-label="Select a Visit Staff" data-control="select2" data-placeholder="Select a  Visit Staff..." class="form-select  " data-allow-clear="true" >
                                <option  value="" selected>Select a  Visit Staff</option>
                                <option  value="None" >All</option>
                                @foreach($users as $user)
                                    <option  value="{{$user->name}}" >{{$user->name}}</option>
                                @endforeach
                                <option  value="Ruqaiya Bibi" >Ruqaiya Bibi</option>
                                <option  value="Dr. Kashmala" >Dr. Kashmala</option>
                                <option  value="Mehnaz" >Mehnaz</option>
                                <option  value="Musarrat Bibi" >Musarrat Bibi</option>
                                <option  value="Shaista Mir" >Shaista Mir</option>
                                <option  value="Shama" >Shama</option>
                                <option  value="Zahid Ali Khan" >Zahid Ali Khan</option>
                            </select>
                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Accompanied By</span>
                            </label>
                            <select   name="accompanied_by" id="accompanied_by" aria-label="Select a Accompanied By" data-control="select2" data-placeholder="Select a Accompanied By" class="form-select  " data-allow-clear="true" >
                                <option value="" selected>Select Accompanied By</option>
                                <option  value="None" >All</option>
                                <option  value="Project Staff">Project Staff</option>
                                <option  value="Govt Officials">Govt Officials</option>
                                <option  value="Donor">Donor</option>
                                <option  value="NA">NA</option>
                            </select>
                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Type of Visit</span>
                            </label>
                            <select name="visit_type" id="visit_type" aria-label="Select a Visit Type" data-control="select2" data-placeholder="Select a Visit Type..." class="form-select  " data-allow-clear="true" >
                                <option value="" selected>Select Visit Type</option>
                                <option value="None">All</option>
                                <option value="Independent">Independent</option>
                                <option value="Joint">Joint</option>
                            </select>
                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Province</span>
                            </label>
                            <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select  " data-allow-clear="true" >
                                <option value="" selected>Select Province</option>
                                <option  value="None" >All</option>
                                <option value='4'>Sindh</option>
                                <option value='2'>KPK</option>
                                <option value='3'>Balochistan</option>
                            </select>

                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">District</span>
                            </label>
                            <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select  " data-allow-clear="true" >

                            </select>
                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project Type</span>
                            </label>
                            <select   name="project_type" id="project_type" aria-label="Select a Project Type" data-control="select2" data-placeholder="Select a Project Type" class="form-select  " data-allow-clear="true" >
                                <option value="" selected>Select Project Type</option>
                                <option  value="None" >All</option>
                                <option value="Humanitarian" >Humanitarian</option>
                                <option value="Development" >Development</option>
                                
                            </select>
                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Staff Organization</span>
                            </label>
                            <select   name="partner" id="partner" aria-label="Select a Partner Name" data-control="select2" data-placeholder="Select a Partner" class="form-select" data-allow-clear="true" >
                                <option value="">Select Partner Name</option>
                                <option  value="LRF">LRF</option>
                                <option  value="NRSP">NRSP</option>
                                <option  value="PPHI">PPHI</option>
                                <option  value="SRSP">SRSP</option>
                                <option  value="TKF">TKF</option>
                            </select>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project</span>
                            </label>
                            <select name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select  " data-allow-clear="true" >
                                <option value="" selected>Select Project</option>
                                <option  value="None" >All</option>
                                @foreach($projects as $project)
                                    <option  value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Attachment Available</span>
                            </label>
                            <select name="attachement" id="attachement" aria-label="Select a Option" data-control="select2" data-placeholder="Select a Option..." class="form-select  " data-allow-clear="true" >
                                <option value="" selected>Select Option</option>
                                <option value="None">None</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>