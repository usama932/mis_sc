<form class="mx-4" action="{{route('projectprofiles.store')}}" method="post" id="create_projectprofile" method="post" enctype="multipart/form-data">   
    @csrf
    <div class="p-5">
        <div class="row ">
            <input type="hidden" name="project" value="{{$project->id}}">

            <div class="fv-row col-md-4">
                <label class="fs-8 fw-semibold form-label 2">
                    <span class="required">Thematic Area</span>
                </label>
                <select name="ptheme" id="profile_th" class="form-control" data-control="select2" data-placeholder="Select Theme" class="form-select" data-allow-clear="true">
                </select> 
            </div>
            <div class="fv-row col-md-4">
                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                    <span class="required">District</span>
                </label>
                <select id="select2_profile_district" multiple name="district[]" aria-label="Select Multiple District" data-control="select2" data-placeholder="Select Multiple District" class="form-select">
                        @if(!empty($project->detail?->district))
                            @foreach($districts as $district)
                                <option value="{{$district->district_id}}">
                                    {{$district->district_name}}
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
                       
                </select>
                <span id="districtError" class="error-message"></span>
            </div> 
            <div class="fv-row col-md-4 mt-3">
                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                    <span class="required">UC</span>
                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="ucloader"></span>
                </label>
                <select id="kt_select2_uc" multiple name="uc[]" aria-label="Select UC " data-control="select2" data-placeholder="Select Multiple Tehsil" class="form-select">
                       
                </select>
                <div id="uc_villageError" class="error-message "></div>
            </div>
            <div class="fv-row col-md-8 mt-3">
                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                    <span class="required">Villages</span>
                </label>
                
                <input class="form-control" name="village" id="village" id="village" />
                <div id="project_descriptionError" class="error-message "></div>
            </div>
            <div class="fv-row col-md-12 mt-3">
                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                    <span class="required">Detail</span>
                </label>
                <textarea  rows="3" id="kt_docs_ckeditor_classic" name="detail"></textarea>
                <div id="detailError" class="error-message"></div>
            </div>
        </div>
        <div class="d-flex justify-content-end my-3">
            <button type="button" id="cancelprojectprofileBtn" class="btn btn-primary btn-sm m-3">
                Cancel
            </button>
            <button type="submit" id="kt_create_profile" class="btn btn-success btn-sm  m-5">
                @include('partials/general/_button-indicator', ['label' => 'Update'])
            </button>
        </div>      
    </div>
</form>
<div class="card"  id="project_profile_table">
    <div class="">
        <div class="d-flex justify-content-end hover-elevate-up my-3 mx-5">
            <button class="btn btn-sm btn-success mx-5" id="addprojectprofileBtn"> <i class="ki-duotone ki-abstract-10">
            <span class="path1"></span>
            <span class="path2"></span>
            </i>Add Project Profile</button>
        </div>
    </div>
    <div class="card-body overflow-*">
        <div class="table-responsive overflow-*">
            <table class="table table-striped table-bordered nowrap" id="project_profile" style="width:100%">
            <thead>
                <tr>
                    <th>Theme</th>
                    <th>Districts</th>
                    <th>Tehsil</th>
                    <th>UC</th>
                    <th>Village</th> 
                    <th>Actions</th>
                </tr>
            </thead>
            </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#kt_docs_ckeditor_classic'))
            .then(editor => {
                console.log('Editor initialized:', editor);

                // Add event listener to form submission inside CKEditor initialization promise
                document.getElementById('kt_create_profile').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default form submission
                    var editorData = editor.getData(); // Get CKEditor content
                    document.getElementById('kt_docs_ckeditor_classic').value = editorData; // Update textarea with CKEditor content
                    document.getElementById('create_projectprofile').submit();
                });
            })
            .catch(error => {
                console.error('Error initializing CKEditor:', error);
            });
    });
</script>
