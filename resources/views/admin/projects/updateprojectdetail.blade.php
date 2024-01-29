<x-nform-layout>
    @section('title')
       Update Project Details
    @endsection
   
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="container-fluid">
                <ul class="nav nav-tabs mt-1 fs-6">
                    <li class="nav-item">
                        <a class="nav-link @if(session('active') == 'detail')  active @endif" data-bs-toggle="tab" href="#detail">Project Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(session('active') == 'thematic') active @else  @endif" data-bs-toggle="tab" href="#thematic" >Thematic area</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(session('active') == 'partner') active @else  @endif" data-bs-toggle="tab" href="#partner">Implementing Partner</a>
                    </li>
                    
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show @if(session('active') == 'detail') active @else  @endif" id="detail" role="tabpanel">
                    <form>    
                        <div class="p-5">
                            <div class="row ">
                                <div class="fv-row col-md-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <strong class="">Project</strong>
                                        {{$project->name }}
                                    </label>
                                
                                    <input type="hidden"  readonly value="{{$project->name }}" class="form-control">
                                    <input type="hidden"  name="project" id="project"  value="{{$project->id}}" class="form-control">
                                
                                </div>   
                                <div class="fv-row col-md-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <strong class="">SOF</strong>
                                        {{$project->name }}
                                    </label>
                                </div>   
                                <div class="fv-row col-md-6">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <strong class="">Project Tenure </strong>
                                        @if(!empty($project->start_date) && $project->start_date != null)
                                        {{ date('M d,Y', strtotime($project->start_date))}}  --To-- {{date('M d,Y', strtotime($project->end_date));}}
                                        @endif
                                    </label>
                                </div>   
                                <div class="fv-row col-md-6">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Province</span>
                                    </label>
                                    <select   name="province[]" multiple id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select Multiple Province..." class="form-select "  data-allow-clear="true" >
                                            @foreach($provinces as $province)
                                                <option value="{{$province->province_id}}">{{$province->province_name}}</option>
                                            @endforeach
                                    </select>
                                    <div id="provinceError" class="error-message "></div>
                                </div>
                                <div class="fv-row col-md-6 ">
                                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                        <span class="required">District</span>
                                        <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
                                    </label>
                                    <select id="kt_select2_district" multiple name="district[]" aria-label="Select Multiple District" data-control="select2" data-placeholder="Select Multiple District" class="form-select">
                                    </select>
                                    <span id="districtError" class="error-message "></span>
                                </div> 
                                <div class="fv-row col-md-12 mt-5 ">
                                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                        <span class="required">Project Description</span>
                                    </label>
                                    <textarea class="form-control" rows="1" name="project_description" id="project_description"></textarea>
                                    <div id="project_descriptionError" class="error-message "></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" id="kt_create_dip" class="btn btn-success btn-sm  m-5">
                                    @include('partials/general/_button-indicator', ['label' => 'Update'])
                                </button>
                            </div>      
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade show @if(session('active') == 'thematic') active @else  @endif" id="thematic" role="tabpanel">
                    <div>
                        <form>    
                            <div class="p-5">
                                <div class="row ">
                                    <div class="fv-row col-md-4">
                                        <select name="theme[]" class="form-control m-input" data-control="select2" data-placeholder="Select Theme" class="form-select" data-allow-clear="true">
                                            @foreach($themes as $theme)
                                                <option value="{{$theme->id}}">{{$theme->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row col-md-4">
                                        <input type="text" name="male_target[]" class="form-control  mx-1" placeholder="Enter Men Target" autocomplete="off">
                                    </div>
                                    <div class="fv-row col-md-4">
                                        <input type="text" name="female_target[]" class="form-control  mx-1" placeholder="Enter Women Target" autocomplete="off">
                                    </div>
                                    <div class="fv-row col-md-4">
                                        <input type="text" name="girls_target[]" class="form-control mt-3 mx-1" placeholder="Enter Girls target" autocomplete="off">
                                    </div>
                                    <div class="fv-row col-md-4">
                                        <input type="text" name="boys_target[]" class="form-control mt-3 mx-1" placeholder="Enter Boys target" autocomplete="off">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" id="kt_create_dip" class="btn btn-success btn-sm  m-5">
                                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                                    </button>
                                </div>      
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade show @if(session('active') == 'partner') active @else  @endif" id="partner" role="tabpanel">
                    <div>
                        <form>    
                            <div class="p-5">
                                <div class="row ">
                                    <div class="fv-row col-md-4">
                                        <input type="text" name="male_target[]" class="form-control  mx-1" placeholder="Enter Men Target" autocomplete="off">
                                    </div>
                                    <div class="fv-row col-md-4">
                                        <input type="text" name="female_target[]" class="form-control  mx-1" placeholder="Enter Women Target" autocomplete="off">
                                    </div>
                                    <div class="fv-row col-md-4">
                                        <input type="text" name="girls_target[]" class="form-control mt-3 mx-1" placeholder="Enter Girls target" autocomplete="off">
                                    </div>
                                    <div class="fv-row col-md-4">
                                        <input type="text" name="boys_target[]" class="form-control mt-3 mx-1" placeholder="Enter Boys target" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            {{-- <form action="{{route('project.update')}}" method="post" id="create_dip" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <strong class="">Project</strong>
                                {{$project->name }}
                            </label>
                          
                            <input type="hidden"  readonly value="{{$project->name }}" class="form-control">
                            <input type="hidden"  name="project" id="project"  value="{{$project->id}}" class="form-control">
                           
                        </div>   
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <strong class="">SOF</strong>
                                {{$project->name }}
                            </label>
                        </div>   
                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <strong class="">Project Tenure </strong>
                                @if(!empty($project->start_date) && $project->start_date != null)
                                  {{ date('M d,Y', strtotime($project->start_date))}}  --To-- {{date('M d,Y', strtotime($project->end_date));}}
                                @endif
                            </label>
                        </div>   
                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Province</span>
                            </label>
                            <select   name="province[]" multiple id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select Multiple Province..." class="form-select "  data-allow-clear="true" >
                                    @foreach($provinces as $province)
                                        <option value="{{$province->province_id}}">{{$province->province_name}}</option>
                                    @endforeach
                            </select>
                            <div id="provinceError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-6 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">District</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
                            </label>
                            <select id="kt_select2_district" multiple name="district[]" aria-label="Select Multiple District" data-control="select2" data-placeholder="Select Multiple District" class="form-select">
                            </select>
                            <span id="districtError" class="error-message "></span>
                        </div>  
                        <div class="separator separator-dotted separator-content border-dark my-15"><span class="h5">Thematic Area</span></div>
                        <div class="row" id="dynamicRow">
                            <div class="fv-row col-md-4">
                                <select name="theme[]" class="form-control m-input" data-control="select2" data-placeholder="Select Theme" class="form-select" data-allow-clear="true">
                                    @foreach($themes as $theme)
                                        <option value="{{$theme->id}}">{{$theme->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row col-md-4">
                                <input type="text" name="male_target[]" class="form-control  mx-1" placeholder="Enter Men Target" autocomplete="off">
                            </div>
                            <div class="fv-row col-md-4">
                                <input type="text" name="female_target[]" class="form-control  mx-1" placeholder="Enter Women Target" autocomplete="off">
                            </div>
                            <div class="fv-row col-md-4">
                                <input type="text" name="girls_target[]" class="form-control mt-3 mx-1" placeholder="Enter Girls target" autocomplete="off">
                            </div>
                            <div class="fv-row col-md-4">
                                <input type="text" name="boys_target[]" class="form-control mt-3 mx-1" placeholder="Enter Boys target" autocomplete="off">
                            </div>
                          
                        </div>
                        <div id="newRow"></div>
                        <div class="mt-2" style="text-align: right !important;">
                            <button id="addRow" type="button" class="btn btn-info btn-sm">Add Theme</button>
                        </div>

                        <div id="themeTargetFields" class="row"></div>
                        <div class="separator separator-dotted separator-content border-dark my-15"><span class="h5">Implementing Partner</span></div>
                        <div class="fv-row col-md-12">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Partner</span>
                            </label>
                            <select   multiple name="partner[]" id="partner" aria-label="Select Multiple Partner" data-control="select2" data-placeholder="Select Multiple Partner" class="form-select"  data-allow-clear="true" >
                                @foreach($partners as $partner)
                                    <option value="{{$partner->id}}">{{$partner->slug}}</option>
                                @endforeach
                            </select>
                            <div id="partnerError" class="error-message "></div>
                        </div>
                        <div id="partnerEmailFields" class="row"></div>
                       
                        
                        <div class="fv-row col-md-12 mt-5 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project Description</span>
                            </label>
                            <textarea class="form-control" rows="1" name="project_description" id="project_description"></textarea>
                            <div id="project_descriptionError" class="error-message "></div>
                        </div>
                    </div>
                
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" id="kt_create_dip" class="btn btn-success btn-sm  m-5">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                </div>      
            </form> --}}
        </div>
    </div>
   
    @push("scripts")
   
   
  
    
    @endpush


</x-nform-layout>
