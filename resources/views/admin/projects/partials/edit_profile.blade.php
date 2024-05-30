<x-nform-layout>
    @push('stylesheets')
        <script src="https://cdn.ckeditor.com/ckeditor5/38.0.0/classic/ckeditor.js"></script>
    @endpush

    @section('title')
        Edit {{$profile->project?->name}} Profile
    @endsection

    <div class="card">
        <form class="mx-4" action="{{route('projectprofiles.update', $profile->id)}}" method="post" id="edit_projectprofile" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="p-5">
                <div class="row">
                    <input type="hidden" name="project" id="project_id" value="{{$project->id}}">

                    <div class="fv-row col-md-4">
                        <label class="fs-6 fw-semibold form-label 2">
                            <span class="required">Thematic Area</span>
                        </label>
                        <input class="form-control form-control-solid" name="ptheme" id="ptheme" value="{{$profile->theme?->name}}" disabled/>
                    </div>

                    <div class="fv-row col-md-4">
                        <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                            <span class="required">District</span>
                        </label>
                        <select id="select2_profile_district" multiple name="district[]" aria-label="Select Multiple District" data-control="select2" data-placeholder="Select Multiple District" class="form-select">
                            @if(!empty($project->detail?->district))
                                @foreach($districts as $district)
                                    <option value="{{ $district->district_id }}" 
                                        @if(in_array($district->district_id, $profiledistricts->pluck('district_id')->toArray())) selected @endif>
                                        {{ $district->district_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <span id="districtError" class="error-message"></span>
                    </div>

                    <div class="fv-row col-md-4">
                        <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                            <span class="required">Tehsil</span>
                            <span class="spinner-border spinner-border-sm align-middle ms-2" id="tehsilloader"></span>
                        </label>
                        <select id="kt_select2_tehsil" multiple name="tehsil[]" aria-label="Select Multiple Tehsil" data-control="select2" data-placeholder="Select Multiple Tehsil" class="form-select">
                            @foreach($tehils as $tehsil)
                                <option value="{{$tehsil->id}}" selected>{{$tehsil->tehsil_name}}</option>
                            @endforeach
                        </select>
                        <span id="districtError" class="error-message"></span>
                    </div>

                    <div class="fv-row col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                            <span class="required">UC</span>
                            <span class="spinner-border spinner-border-sm align-middle ms-2" id="ucloader"></span>
                        </label>
                        <select id="kt_select2_uc" multiple name="uc[]" aria-label="Select UC " data-control="select2" data-placeholder="Select Multiple Tehsil" class="form-select">
                            @foreach($ucs as $uc)
                                <option value="{{$uc->union_id}}" selected>{{$uc->uc_name}}</option>
                            @endforeach
                        </select>
                        <div id="uc_villageError" class="error-message"></div>
                    </div>

                    <div class="fv-row col-md-8 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                            <span class="required">Villages</span>
                        </label>
                        <input class="form-control" name="village" id="village" value="{{$profile->village}}" />
                        <div id="project_descriptionError" class="error-message"></div>
                    </div>

                    <div class="fv-row col-md-12 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                            <span class="required">Detail</span>
                        </label>
                        <textarea rows="3" id="kt_docs_ckeditor_classic" name="detail">{{$profile->detail}}</textarea>
                        <div id="detailError" class="error-message"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-end my-3">
                    <button type="button" id="back_button" class="btn btn-primary btn-sm">
                        Back
                    </button>
                    <button type="submit" id="kt_edit_profile" class="btn btn-success btn-sm m-5">
                        @include('partials/general/_button-indicator', ['label' => 'Update'])
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create(document.querySelector('#kt_docs_ckeditor_classic'))
                .then(editor => {
                    document.getElementById('kt_edit_profile').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default form submission
                    var editorData = editor.getData(); // Get CKEditor content
                    document.getElementById('kt_docs_ckeditor_classic').value = editorData; // Update textarea with CKEditor content
                 
                    });
                })
                .catch(error => {
                    console.error('Error initializing CKEditor:', error);
                });
        });
    </script>
</x-nform-layout>
