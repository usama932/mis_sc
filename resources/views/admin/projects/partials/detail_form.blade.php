<form class="mx-4" action="{{route('project.update')}}" method="post" id="create_dip" method="post" enctype="multipart/form-data">   
    <div class="separator separator-dotted separator-content border-dark my-10 mx-7"><span class="h5">Project Basic  Information</span></div>  
    @csrf

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
            <div class="separator separator-dotted separator-content border-dark my-15 "><span class="h5">Project Detail</span></div>  

            <div class="fv-row col-md-6">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Province</span>
                </label>
                <select   name="province[]" multiple id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select Multiple Province..." class="form-select "  data-allow-clear="true" >
                    @if(!empty($project->detail->province))
                        @foreach($provinces as $province)
                            @php
                            $selected = false; // Flag to determine if the option should be selected
                            $decodedProvinces = json_decode($project->detail->province);
                            
                            // Check if the current province_id is in the decoded array
                            if (in_array($province->province_id, $decodedProvinces)) {
                                $selected = true;
                            }
                            @endphp
                            <option value="{{ $province->province_id }}" {{ $selected ? 'selected' : '' }}>
                                {{ $province->province_name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <div id="provinceError" class="error-message "></div>
            </div>
            <div class="fv-row col-md-6 ">
                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                    <span class="required">District</span>
                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
                </label>
                <select id="kt_select2_district" multiple name="district[]" aria-label="Select Multiple District" data-control="select2" data-placeholder="Select Multiple District" class="form-select">
                        @if(!empty($project->detail?->district))
                            @foreach($districts as $district)
                                <option value="{{ $district->district_id }}" selected>
                                    {{ $district->district_name }}
                                </option>
                            
                            @endforeach
                        @endif
                </select>
                <span id="districtError" class="error-message "></span>
            </div> 
            <div class="fv-row col-md-12 mt-3">
                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                    <span class="required">Project Description</span>
                </label>
                <textarea class="form-control" rows="1" name="project_description" id="project_description">{{$project->detail?->project_description ?? ''}}</textarea>
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