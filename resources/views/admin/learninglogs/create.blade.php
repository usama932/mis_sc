<x-nform-layout>
    @section('title')
       Add Learning Logs
    @endsection
    <!--begin::Image input placeholder-->
    <style>
        .image-input-placeholder {
            background-image: url('svg/avatars/blank-dark.svg');
        }
    
        [data-bs-theme="dark"] .image-input-placeholder {
            background-image: url('svg/avatars/blank-dark.svg');
        }
    </style>
    <!--end::Image input placeholder-->
  
    <!--begin::Image input-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('learning-logs.store')}}" method="post" id="learninglog" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Title</span>
                            </label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title"/>
                            <div id="titleError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 ">
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
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project Type</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="projectloader"></span>
                            </label>
                            <input type="text" name="project_type" id="project_type" class="form-control" placeholder="Enter Project Type"/ readonly>
                            <div id="project_typeError" class="error-message "></div>
                        </div>  
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Research Type</span>
                            </label>
                            <select name="research_type" id="research_type" aria-label="Select Research Type" data-control="select2" data-placeholder="Select Research Type" class="form-select"  data-allow-clear="true" >
                                <option value="" >Select Research Type</option>
                                <option value="Assessment" >Assessment</option>
                                <option value="Evaluation">Evaluation</option>
                                <option value="PDM">PDM</option>
                                <option value="Research Study">Research Study</option>
                                <option value="Survey Report">Survey Report</option>
                            </select>
                            <div id="research_typeError" class="error-message "></div>
                        </div>  
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Thematic Area</span>
                            </label>
                            <select name="theme[]" id="theme" class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple>
                                <option></option>
                                @foreach($themes as $theme)
                                
                                <option value="{{$theme->id}}" @if($loop->index == '0') selected @endif>{{$theme->name}}</option>
                                @endforeach
                              
                            </select>
                        
                            <div id="themeError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3">
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
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">District</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
                            </label>
                            <select id="kt_select2_district" multiple name="district[]" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select ">

                            </select>
                            <div id="kt_select2_districtError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3">
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
                        <div class="fv-row col-md-12  ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Attachment</span>
                            </label>
                            <input type="file" name="attachment" id="attachment" class="form-control" />
                            <div id="attachmentError" class="error-message"></div>
                        </div>  
                        <div class="fv-row col-md-6  ">
                            <label class="fs-6 fw-semibold form-label mb-2  class="tox-target"">
                                <span class="required">Description</span>
                                <div id="descriptionError" class="error-message "></div>
                            </label>
                            <textarea name="description" rows="5"  id="description"  class="form-control">
                            </textarea>
                        </div>  
                  
                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="">Thumbnail</span>
                            </label>
                            <br>
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                                <!--begin::Image preview wrapper-->
                                <div class="image-input-wrapper w-400px h-125px" style=""></div>
                                <!--end::Image preview wrapper-->

                                <!--begin::Edit button-->
                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Change avatar">
                                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                    <!--begin::Inputs-->
                                    <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit button-->

                                <!--begin::Cancel button-->
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
   
    @push("scripts")
     
    @endpush


</x-nform-layout>