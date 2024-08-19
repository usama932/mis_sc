<x-nform-layout>
    @section('title')
       Add Learning Logs
    @endsection

    <style>
        .image-input-placeholder {
            background-image: url('svg/avatars/blank-dark.svg');
        }
    
        [data-bs-theme="dark"] .image-input-placeholder {
            background-image: url('svg/avatars/blank-dark.svg');
        }
    </style>
   
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('learning-logs.store')}}" method="post" id="learninglog" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                        <div class="fv-row col-md-3 mt-5 form-group">
                            <div class="form-check form-switch mt-5">
                                <input class="form-check-input" type="checkbox" id="cli" name="cli">
                                <label class="form-check-label" for="active">CLI</label>
                            </div>
                        </div>
                        <div class="fv-row col-md-3 form-group">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Title</span>
                            </label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title"/>
                            <div id="titleError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 form-group" id="project-field">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project</span>
                            </label>
                            <select   name="project" id="project" aria-label="Select Project" data-control="select2" data-placeholder="Select Project" class="form-select"  data-allow-clear="true" >
                                <option value="">Select Project</option>
                               
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}" >{{$project->name}}</option>
                                @endforeach
                              
                            </select>
                            <div id="projectError" class="error-message "></div>
                        </div>   
                        <div class="fv-row col-md-3 form-group" id="project_type-field">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project Type</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="projectloader"></span>
                            </label>
                            <input type="text" name="project_type" id="project_type" class="form-control" placeholder="Enter Project Type"/ readonly>
                            <div id="project_typeError" class="error-message "></div>
                        </div>  
                        <div class="fv-row col-md-3 form-group"  id="research_type-field">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Research Type</span>
                            </label>
                            <select name="research_type" id="research_type" aria-label="Select Research Type" data-control="select2" data-placeholder="Select Research Type" class="form-select"  data-allow-clear="true" >
                                <option value="">Select Research Type</option>
                                <option value="Assessment" >Assessment</option>
                                <option value="Evaluation">Evaluation</option>
                                <option value="Learning PPT" >Learning PPT</option>
                                <option value="Learning Briefer">Learning Briefer</option>
                                <option value="Learning Evidence Piece">Learning Evidence Piece</option>
                                <option value="PDM">PDM</option>
                                <option value="Research Study">Research Study</option>
                                <option value="Survey Report">Survey Report</option>
                                <option value="Reports">Reports</option>
                            </select>
                            <div id="research_typeError" class="error-message "></div>
                        </div>  
                        <div class="fv-row col-md-3 form-group" id="theme-field">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Thematic Area</span>
                            </label>
                            <select name="theme[]" id="theme" class="form-select " aria-label="Select Research Type" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple>
                                <option value="">Select  Thematic Area</option>
                                @foreach($themes as $theme)
                                <option value="{{$theme->id}}" >{{$theme->name}}</option>
                                @endforeach
                                <option value="Other">Other</option>
                            </select>
                        
                            <div id="themeError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 form-group" id="province-field">
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
                        <div class="fv-row col-md-3 form-group" id="district-field">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">District</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
                            </label>
                            <select id="kt_select2_district" multiple name="district[]" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select ">

                            </select>
                            <div id="kt_select2_districtError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 form-group" id="status-field">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Status</span>
                            </label>
                            <select name="status" id="status" aria-label="Select Status" data-control="select2" data-placeholder="Select Status" class="form-select">
                                <option value="">Select Theme</option>
                                <option value="Completed">Completed</option>
                                <option value="Planned">Planned</option>
                                <option value="In progress">In progress</option> 
                            </select>
                            <div id="themeError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-12  form-group">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Attachment</span>
                            </label>
                            <input type="file" name="attachment" id="attachment" class="form-control" />
                            <div id="attachmentError" class="error-message"></div>
                        </div>  
                        <div class="fv-row col-md-6  form-group">
                            <label class="fs-6 fw-semibold form-label mb-2  class="tox-target"">
                                <span class="required">Description</span>
                            </label>
                            <textarea name="description" rows="5"  id="description"  class="form-control">
                            </textarea>
                            <div id="descriptionError" class="error-message "></div>
                        </div>  
                  
                        <div class="fv-row col-md-6 form-group ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="">Thumbnail</span>
                            </label>
                            <br>
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                                <!--begin::Image preview wrapper-->
                                <div class="image-input-wrapper w-400px h-125px" style=""></div>
                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Change avatar">
                                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                                    <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Cancel avatar">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>
                                <!--end::Cancel button-->

                                <!--begin::Remove button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Remove avatar">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>
                                <!--end::Remove button-->
                            </div>
                            <!--end::Image input-->
                            <div id="thumbnailError" class="error-message "></div>
                        </div>  
                     
                    </div>
                
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" id="kt_learninglog" class="btn btn-success btn-sm  m-5">
                            @include('partials/general/_button-indicator', ['label' => 'Submit'])
                        </button>
                      
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-nform-layout>
