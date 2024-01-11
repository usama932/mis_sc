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
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Status</span>
                            </label>
                            <select   name="status" id="status" aria-label="Select a Status" data-control="select2" data-placeholder="Select a Status..." class="form-select "  data-allow-clear="true" > 
                                <option  value='Initiative' @if($project->status == "Initiative")  selected @endif>Initiative</option>
                                <option value='Not Started' @if($project->status == "Not Started")  selected @endif>Not Started</option>
                                <option  value='In Process' @if($project->status == "In Process")  selected @endif>In Process</option>
                                <option value='Completed' @if($project->status == "Completed")  selected @endif>Completed</option>
                            </select>
                            <div id="statusError" class="error-message "></div>
                        </div>  
                        <div class="fv-row col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">SOF</span>
                            </label>
                            <input type="text" name="sof" id="sof" placeholder="Enter SOF" class="form-control" value="{{ $project->sof ?? ''}}">
                            <div id="sofError" class="error-message "></div>
                        </div> 
                        <div class="fv-row col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Theme</span>
                            </label>
                            <select   name="theme[]" multiple id="theme" aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme..." class="form-select "  data-allow-clear="true" > 
                                <option  value=''>Select Theme</option>
                                @foreach($theme as $th)
                                    <option  value='{{$th->id}}' @if(in_array($th->id, $themes->pluck('id')->toArray())) selected @endif>{{$th->name}}</option>
                                @endforeach
                            </select>
                            <div id="statusError" class="error-message "></div>
                        </div>  
                        <div class="fv-row col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project Start Date</span>
                            </label>
                            <input type="text" name="start_date" id="start_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="{{$project->start_date}}">
                            <div id="start_dateError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project End Date</span>
                            </label>
                            <input type="text" name="end_date" id="end_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="{{$project->end_date}}">
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
