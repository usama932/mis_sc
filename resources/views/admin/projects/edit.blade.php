<x-nform-layout>
    @section('title')
       Edit Project
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('projects.update',$project->id)}}" method="post" id="create_project" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body py-4">
                    <div class="row">
                       
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project</span>
                            </label>
                            <input type="text" name="name" id="name" placeholder="Project Title"  class="form-control" value="{{$project->name ?? ''}}">
                            <div id="nameError" class="error-message "></div>
                        </div>   
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Type</span>
                            </label>
                            <select   name="type" id="type" aria-label="Select a Type" data-control="select2" data-placeholder="Select a Type..." class="form-select "  data-allow-clear="true" > 
                                <option  value='Development' @if($project->type == "Development")  selected @endif>Development</option>
                                <option value='Humanitarian' @if($project->type == "Humanitarian") selected @endif>Humanitarian</option>
                            </select>
                            <div id="typeError" class="error-message"></div>
                        </div> 
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Focal Person</span>
                            </label>
                            <select   name="focal_person" id="focal_person" aria-label="Select a Focal Person" data-control="select2" data-placeholder="Select a Focal Person..." class="form-select "  data-allow-clear="true" > 
                                <option  value=''>Select Focal Person</option>
                                @foreach($persons as $person)
                                    <option  value='{{$person->id}}' @if($person->id == $project->focal_person) selected @endif>{{$person->name}}</option>
                                @endforeach
                            </select>
                            <div id="focal_personError" class="error-message"></div>
                        </div>   
                 
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">SOF</span>
                            </label>
                            <input type="text" name="sof" id="sof" placeholder="Enter SOF" class="form-control" value="{{ $project->sof ?? ''}}">
                            <div id="sofError" class="error-message "></div>
                        </div> 
                      
                        <div class="fv-row col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project Start Date</span>
                            </label>
                            <input type="text" name="start_date"    placeholder="Select date"  class="form-control"  value="{{$project->start_date}}" readonly>
                            <div id="start_dateError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project End Date</span>
                            </label>
                            <input type="text" name="end_date" id="end_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="{{$project->end_date}}">
                            <div id="end_dateError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 mt-5">
                            <div class="form-check form-switch   mt-5">
                                <input class="form-check-input" type="checkbox" id="active" name="active" {{$project->active ? 'checked' : ''}}>
                                <label class="form-check-label" for="active">Activate Project</label>
                            </div>
                        </div>
                        <div class="fv-row col-md-3 mt-5">
                            <div class="form-check form-switch mt-5">
                                <input class="form-check-input" type="checkbox" id="project_extended" name="project_extended" {{$project->is_active ? 'checked' : ''}}>
                                <label class="form-check-label" for="project_extended">Project Extended</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" id="kt_create_project" class="btn btn-primary btn-sm  m-5">
                        @include('partials/general/_button-indicator', ['label' => 'Update'])
                    </button>
                </div>
                </div>
            </form>
        </div>
    </div>
    @push("scripts")
    @endpush
</x-nform-layout>
