<div>
    <form action="{{route('dips.store')}}" method="post" id="create_dip" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body py-4">
            <div class="row">
             
                <div class="fv-row col-md-4 ">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Project</span>
                    </label>
                    <select   name="project" id="project" aria-label="Select Project" data-control="select2" data-placeholder="Select Project" class="form-select"  data-allow-clear="true" >
                      
                        @foreach($projects as $project)
                            <option value="{{$project->id}}">{{$project->name}}</option>
                        @endforeach
                    </select>
                    <div id="projectError" class="error-message "></div>
                </div>   
                <div class="fv-row col-md-4 ">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Partner </span>
                    </label>
                    <select   multiple name="partner[]" id="partner" aria-label="Select Partner" data-control="select2" data-placeholder="Select Partner" class="form-select"  data-allow-clear="true" >
                      
                        @foreach($partners as $partner)
                            <option value="{{$partner->id}}">{{$partner->name}}</option>
                        @endforeach
                    </select>
                    <div id="partnerError" class="error-message "></div>
                </div>  
               
               
                <div class="fv-row col-md-4 ">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Thematic Area</span>
                    </label>
                    <select name="theme[]" id="theme" class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple>
                      
                        @foreach($themes as $theme)
                            <option value="{{$theme->id}}" >{{$theme->name}}</option>
                        @endforeach
                      
                    </select>
                
                    <div id="themeError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-4 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Province</span>
                    </label>
                    <select   name="province[]" multiple id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select "  data-allow-clear="true" >
                    
                        <option value="">Select Province</option>
                        {{-- <option value='1'>Punjab</option> --}}
                        <option value='4' >Sindh</option>
                        <option  value='2'>KPK</option>
                        <option value='3'>Balochistan</option>
                     
                    </select>
                    <div id="kt_select2_provinceError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-4 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                        <span class="required">District</span>
                        <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
                    </label>
                    <select id="kt_select2_district" multiple name="district[]" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select ">

                    </select>
                    <div id="kt_select2_districtError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-4 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                        <span class="required">Project Start Date</span>
                    </label>
                    <input type="text" name="project_start_date" id="project_start_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                    <div id="project_start_dateError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-4 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                        <span class="required">Project End Date</span>
                    </label>
                    <input type="text" name="project_end_date" id="project_end_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                    <div id="project_end_dateError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-4 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                        <span class="required">Project Submission Date</span>
                    </label>
                    <input type="text" name="project_submition" id="project_submition" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                    <div id="project_submitionError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-4 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                        <span class="required">Project Submission Date</span>
                    </label>
                    <input type="file" name="attachment" id="attachment" class="form-control">
                    <div id="attachmentError" class="error-message "></div>
                </div>
            </div>
        
        
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" id="kt_create_dip" class="btn btn-success btn-sm  m-5">
                  
                    @include('partials/general/_button-indicator', ['label' => 'Update'])
                </button>
              
               
               
            </div>
        </div>
    </form>
