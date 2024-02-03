<form class="mx-4" action="{{route('project.update')}}" method="post" id="create_dip" method="post" enctype="multipart/form-data">   
    @csrf
    <div class="p-5">
        <div class="row ">
            <input type="hidden" name="project" value="{{$project->id}}">
          
            <div class="fv-row col-md-6">
                <label class="fs-6 fw-semibold form-label mb-2">
                    <span class="required">Province</span>
                </label>
                <select   name="province[]" multiple id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select Multiple Province..." class="form-select "  data-allow-clear="true" >
                    @if(!empty($project->detail?->province))
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
                <textarea class="form-control" rows="2" name="project_description" id="project_description">{{$project->detail?->project_description ?? ''}}</textarea>
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