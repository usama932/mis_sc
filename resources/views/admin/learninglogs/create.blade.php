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
                        <div class="fv-row col-md-6 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Title</span>
                            </label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title"/>
                            <div id="titleError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-6 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project</span>
                            </label>
                            <select   name="project" id="project" aria-label="Select Project" data-control="select2" data-placeholder="Select Project" class="form-select">
                                <option value="">Select Project</option>
                                @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                            <div id="projectError" class="error-message "></div>
                        </div>   
                        <div class="fv-row col-md-4 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project Type</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="projectloader"></span>
                            </label>
                            <input type="text" name="project_type" id="project_type" class="form-control" placeholder="Enter Project Type"/>
                            <div id="project_typeError" class="error-message "></div>
                        </div>  
                        <div class="fv-row col-md-4 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Research Type</span>
                            </label>
                            <select name="research_type" id="research_type" aria-label="Select Research Type" data-control="select2" data-placeholder="Select Research Type" class="form-select">
                                <option value="">Select Research Type</option>
                                <option value="Assessment">Assessment</option>
                                <option value="Evaluation">Evaluation</option>
                                <option value="PDM">PDM</option>
                                <option value="Reasrch Study">Reasrch Study</option>
                                <option value="Survey Report">Survey Report</option>
                            </select>
                            <div id="research_typeError" class="error-message "></div>
                        </div>  
                        <div class="fv-row col-md-4 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Theme</span>
                            </label>
                            <select name="theme" id="theme" aria-label="Select Theme" data-control="select2" data-placeholder="Select Theme" class="form-select">
                                <option value="">Select Theme</option>
                                @foreach($themes as $theme)
                                <option value="{{$theme->id}}">{{$theme->name}}</option>
                                @endforeach
                            </select>
                            <div id="themeError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-6 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2  class="tox-target"">
                                <span class="required">Description</span>
                                <div id="descriptionError" class="error-message "></div>
                            </label>
                            <textarea name="description" rows="5"  id="description"  class="form-control">
                            </textarea>
                            
                        </div>  
                  
                        <div class="fv-row col-md-6 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Thumbnail</span>
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
                        <div class="fv-row col-md-12 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="">Attachment</span>
                            </label>
                            <input type="file" name="attachment" id="attachment" class="form-control" />
                            <div id="attachmentError" class="error-message"></div>
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
