<x-nform-layout>

    @section('title')
        Edit Learning Logs
    @endsection
 
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('learning-logs.update',$log->id)}}" method="post" id="learninglog" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body py-4">
                    <div class="row">
                        <div class="fv-row col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Title</span>
                            </label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="{{$log->title ?? ''}}"/>
                            <div id="titleError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project</span>
                            </label>
                            <select   name="project" id="project" aria-label="Select Project" data-control="select2" data-placeholder="Select Project" class="form-select">
                                <option value="required">Select Project</option>
                                @foreach($projects as $project)
                                <option value="{{$project->id}}" @if($project->id  == $log->project) selected @endif>{{$project->name}}</option>
                                @endforeach
                            </select>
                            <div id="projectError" class="error-message "></div>
                        </div>   
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project Type</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="projectloader"></span>
                            </label>
                            <input type="text" name="project_type" id="project_type" class="form-control" placeholder="Enter Project Type"  value="{{$log->project_type ?? ''}}"/ readonly>
                            <div id="project_typeError" class="error-message "></div>
                        </div>  
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="">Research Type</span>
                            </label>
                            <select name="research_type" id="research_type" aria-label="Select Research Type" data-control="select2" data-placeholder="Select Research Type" class="form-select">
                                <option value="">Select Research Type</option>
                                <option value="Assessment" @if($log->research_type == "Assessment") selected @endif >Assessment</option>
                                <option value="Evaluation" @if($log->research_type == "Evaluation") selected @endif >Evaluation</option>
                                <option value="Learning PPT" @if($log->research_type == "Learning PPT") selected @endif>Learning PPT</option>
                                <option value="Learning Briefer" @if($log->research_type == "Learning Briefer") selected @endif>Learning Briefer</option>
                                <option value="PDM" @if($log->research_type == "PDM") selected @endif>PDM</option>
                                <option value="Reasrch Study" @if($log->research_type == "Research Study") selected @endif>Research Study</option>
                                <option value="Survey Report" @if($log->research_type == "Survey Report") selected @endif>Survey Report</option>
                                <option value="Reports" @if($log->research_type == "Reports") selected @endif>Reports</option>
                            </select>
                            <div id="research_typeError" class="error-message "></div>
                        </div>  
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Theme</span>
                            </label>
                            <select name="theme[]" multiple id="theme" aria-label="Select Theme" data-control="select2" data-placeholder="Select Theme" class="form-select">
                                <option value="">Select Theme</option>
                                @foreach($themes as $theme)
                                <option value="{{$theme->id}}" @if(in_array($theme->id, $themes->pluck('id')->toArray())) selected @endif>{{$theme->name}}</option>
                                @endforeach
                            </select>
                            <div id="themeError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Province</span>
                            </label>
                            <select   name="province[]" multiple id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select ">
                            
                                <option value=""  @if($log->province == "") selected @endif>Select Province</option>
                                {{-- <option value='1'>Punjab</option> --}}
                                <option value='4' @if(in_array('4', $provinces->pluck('province_id')->toArray())) selected @endif>Sindh</option>
                                <option  value='2' @if(in_array('2', $provinces->pluck('province_id')->toArray())) selected @endif>KPK</option>
                                <option value='3' @if(in_array('3', $provinces->pluck('province_id')->toArray())) selected @endif>Balochistan</option>
                             
                            </select>
                            <div id="kt_select2_provinceError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">District</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
                            </label>
                            <select id="kt_select2_district" name="district[]" multiple aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select ">
                                @foreach($districts as $district)
                                    <option value="{{$district->district_id}}" selected>{{$district->district_name}}</option>
                                @endforeach 
                               
                            </select>
                            <div id="kt_select2_districtError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Status</span>
                            </label>
                            <select name="status" id="status" aria-label="Select Status" data-control="select2" data-placeholder="Select Status" class="form-select">
                                <option value="">Select Status</option>
                                <option value="Completed" @if($log->status == "Completed") selected @endif>Completed</option>
                                <option value="Planned" @if($log->status == "Planned") selected @endif>Planned</option>
                                <option value="In progress" @if($log->status == "In progress") selected @endif>In progress</option> 
                            </select>
                            <div id="statusError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-6 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Description</span>
                            </label>
                            <textarea name="description" id="description" rows='5' class="form-control" placeholder="Enter Description">{{$log->description ?? ''}}</textarea>
                            <div id="research_typeError" class="error-message "></div>
                        </div>  
                     
                        <div class="fv-row col-md-6 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="">Thumbnail</span>
                            </label>
                            <br>
                           <div class="image-input image-input-outline" data-kt-image-input="true" style="">
                                <!--begin::Image preview wrapper-->
                                <div class="image-input-wrapper w-400px h-125px" style="background-image: url('@if(isset($log->thumbnail)){{ asset('storage/learninglog/thumbnail/'.$log->thumbnail) }}@endif')"></div>
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
                         
                            @if(!empty($log->attachment) && $log->attachment != '')
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">ReUpload Attachment</span>
                            </label>
                        @else
                            <label class="fs-6 fw-semibold form-label mb-2 ">
                                <span class="required">Upload Attachment</span>
                            </label>
                        @endif
                        <div class="input-group">
                         
                            
                            @if(!empty($log->attachment) && $log->attachment != '')
                            <input type="file" name="attachment" class="form-control mx-4" value="{{$log->attachment}}" onchange="validateFile()" accept=".pdf">
                                <div class="input-group-append">
                                    <a class="btn  btn-danger" title="Download Attachment" href="{{ route('download.log_file',$log->id) }}" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                                            <!-- SVG path code -->
                                        </svg> Download Attachment
                                    </a>
                                </div>
                            @else
                            <input name="attachment" class="form-control upload_file_input" id="upload_file_input" accept="application/pdf" type="file" autocomplete="off" value="">
                            
                            @endif
                        </div>        
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
