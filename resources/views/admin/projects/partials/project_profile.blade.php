<form class="mx-4" action="{{route('project.update')}}" method="post" id="create_dip" method="post" enctype="multipart/form-data">   
    @csrf
    <div class="p-5">
        <div class="row ">
            <input type="hidden" name="project" value="{{$project->id}}">

            <div class="fv-row col-md-4">
                <label class="fs-8 fw-semibold form-label 2">
                    <span class="required">Thematic Area</span>
                </label>
                <select name="profile_theme" id="profile_theme" aria-label="Select a Theme" data-control="select2" data-placeholder="Select Theme" class="form-select" data-allow-clear="true">
                    <option  value=''>Select Theme</option>
                    @foreach($ths as $theme)
                        <option value="{{$theme->id}}">{{$theme->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="fv-row col-md-4">
                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                    <span class="required">District</span>
                </label>
                <select id="select2_district" multiple name="district[]" aria-label="Select Multiple District" data-control="select2" data-placeholder="Select Multiple District" class="form-select">
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
            <div class="fv-row col-md-4">
                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                    <span class="required">Tehsil</span>
                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="tehsilloader"></span>
                </label>
                <select id="kt_select2_tehsil" multiple name="tehsil[]" aria-label="Select Multiple Tehsil" data-control="select2" data-placeholder="Select Multiple Tehsil" class="form-select">
                        @if(!empty($project->detail?->district))
                            @foreach($districts as $district)
                                <option value="{{ $district->district_id }}" selected>
                                    {{ $district->district_name }}
                                </option>
                            
                            @endforeach
                        @endif
                </select>
                <span id="districtError" class="error-message"></span>
            </div> 
            <div class="fv-row col-md-4 mt-3">
                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                    <span class="required">UC/Village</span>
                </label>
                <input class="form-control" rows="2" name="uc_village" id="uc_village" />
                <div id="uc_villageError" class="error-message "></div>
            </div>
            <div class="fv-row col-md-8 mt-3">
                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                    <span class="required">Detail</span>
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