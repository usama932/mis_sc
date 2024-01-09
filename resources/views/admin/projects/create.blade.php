<x-nform-layout>
    @section('title')
       Add Project
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('projects.store')}}" method="post" id="create_project" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                       
                        <div class="fv-row col-md-4 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project</span>
                            </label>
                            <input type="text" name="name" id="name" placeholder="Project Title"  class="form-control" value="">
                            <div id="nameError" class="error-message "></div>
                        </div>   
                        <div class="fv-row col-md-4 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Type</span>
                            </label>
                            <select   name="type" id="type" aria-label="Select a Type" data-control="select2" data-placeholder="Select a Type..." class="form-select "  data-allow-clear="true" > 
                                <option  value=''>Select Type</option>
                                <option  value='Development'>Development</option>
                                <option value='Humanitarian'>Humanitarian</option>
                            </select>
                            <div id="typeError" class="error-message"></div>
                        </div>  
                        <div class="fv-row col-md-4 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Status</span>
                            </label>
                            <select   name="status" id="status" aria-label="Select a Status" data-control="select2" data-placeholder="Select a Status..." class="form-select "  data-allow-clear="true" > 
                                <option  value=''>Select Status</option>
                                <option  value='Initiative'>Initiative</option>
                                <option value='Not Started'>Not Started</option>
                                <option  value='In Process'>In Process</option>
                                <option value='Completed'>Completed</option>
                            </select>
                            <div id="statusError" class="error-message "></div>
                        </div> 
                        <div class="fv-row col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">SOF</span>
                            </label>
                            <input type="text" name="sof" id="sof" placeholder="Enter SOF" class="form-control" value="">
                            <div id="sofError" class="error-message "></div>
                        </div> 
                        <div class="fv-row col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Theme</span>
                            </label>
                            <select   name="status[]" multiple id="theme" aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme..." class="form-select "  data-allow-clear="true" > 
                                <option  value=''>Select Theme</option>
                                @foreach($themes as $theme)
                                    <option  value='{{$theme->id}}'>{{$theme->name}}</option>
                                @endforeach
                            </select>
                            <div id="statusError" class="error-message "></div>
                        </div> 
                        <div class="fv-row col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project Start Date</span>
                            </label>
                            <input type="text" name="start_date" id="start_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                            <div id="start_dateError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project End Date</span>
                            </label>
                            <input type="text" name="end_date" id="end_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                            <div id="end_dateError" class="error-message "></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" id="kt_create_project" class="btn btn-success btn-sm  m-5">
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
