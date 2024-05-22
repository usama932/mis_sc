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
                       
                        <div class="fv-row col-md-4 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project Title</span>
                            </label>
                            <input type="text" name="name" id="name" placeholder="Project Title"  class="form-control" value="{{$project->name ?? ''}}">
                            <div id="nameError" class="error-message "></div>
                        </div>   
                        <div class="fv-row col-md-4 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Type</span>
                            </label>
                            <select   name="type" id="type" aria-label="Select a Type" data-control="select2" data-placeholder="Select a Type..." class="form-select "  data-allow-clear="true" > 
                                <option  value='Development' @if($project->type == "Development")  selected @endif>Development</option>
                                <option value='Humanitarian' @if($project->type == "Humanitarian") selected @endif>Humanitarian</option>
                            </select>
                            <div id="typeError" class="error-message"></div>
                        </div> 
                        <div class="fv-row col-md-4 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">SOF</span>
                            </label>
                            <input type="text" name="sof" id="sof" placeholder="Enter SOF" class="form-control" value="{{ $project->sof ?? ''}}">
                            <div id="sofError" class="error-message "></div>
                        </div> 
                      
                 
                    
                        <div class="fv-row col-md-6 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Donor</span>
                            </label>
                            <select   name="donor" id="donor" aria-label="Select a Donor" data-control="select2" data-placeholder="Select a Donor" class="form-select "  data-allow-clear="true" > 
                                <option  value=''>Select Donor</option>
                                @foreach($donors as $donor)
                                    <option  value='{{$donor->id}}' @if($project->donor ==  $donor->id) selected @endif >{{$donor->name}}</option>
                                @endforeach
                            </select>
                            <div id="donorError" class="error-message"></div>
                        </div>  
                        <div class="fv-row col-md-6  ">
                            <label class="fs-8 fw-semibold form-label mb-2">
                                <span class="required">Awards Focal Person</span>
                            </label>
                            <select   name="award_person" id="award_person" aria-label="Select a Award FP" data-control="select2" data-placeholder="Select a Focal Person..." class="form-select "  data-allow-clear="true" > 
                                <option  value=''>Select Award  FP</option>
                                @foreach($awards as $award)
                                    <option  value='{{$award->id}}'  @if($award->id == $project->award_person) selected @endif>{{ucfirst($award->name)}} - {{$award->desig?->designation_name  ?? ''}}</option>
                                @endforeach
                            </select>
                            <div id="focal_personError" class="error-message"></div>
                        </div>  
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project Start Date</span>
                            </label>
                            <input type="text" name="start_date"   id="start_date"  placeholder="Select date"  class="form-control"  value="{{$project->start_date}}" >
                            <div id="start_dateError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project End Date</span>
                            </label>
                            <input type="text" name="end_date" id="end_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="{{$project->end_date}}">
                            <div id="end_dateError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 mt-5">
                            <div class="form-check form-switch mt-5">
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
                        <div class="fv-row col-md-3 mt-5" id="nce_cost_extent_container" style="display: none;">
                            <div class="form-check form-switch mt-5">
                                <input class="form-check-input" type="checkbox" id="nce_cost_extent" name="nce"  {{$project->nce ? 'checked' : ''}}>
                                <label class="form-check-label" for="nce">NCE</label>
                            </div>
                        </div>
                        <div class="fv-row col-md-6  ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Budget Holder FP</span>
                            </label>
                            <select   name="budget_holder[]" multiple id="budget_holder" aria-label="Select a Focal Person" data-control="select2" data-placeholder="Select a Focal Person..." class="form-select"  data-allow-clear="true" > 
                                <option  value=''>Select Focal Person</option>
                                @foreach($budget_holders as $budget_holder)
                                    @php
                                        $decoded_budget_holder = json_decode($project->budget_holder);
                                        $selected = $decoded_budget_holder && in_array($budget_holder->id, (array)$decoded_budget_holder);
                                    @endphp
                                    <option value='{{$budget_holder->id}}' @if($selected) 
                                        selected 
                                    @endif>{{ucfirst($budget_holder->name)}} - {{$budget_holder->desig?->designation_name  ?? ''}}</option>
                                @endforeach
                            </select>
                            <div id="budget_holderError" class="error-message"></div>
                        </div> 
                        <div class="fv-row col-md-6 ">
                            <label class="fs-8 fw-semibold form-label mb-2">
                                <span class="required">Operational Focal Person</span>
                            </label>
                            <select   name="focal_person[]" id="focal_person" multiple aria-label="Select a Focal Person" data-control="select2" data-placeholder="Select a Focal Person..." class="form-select "  data-allow-clear="true" > 
                                <option  value=''>Select Focal Person</option>
                                @foreach($persons as $person)
                                @php
                                    $decoded_focal_person = json_decode($project->focal_person);
                                    $selected = $person && in_array($person->id, (array)$decoded_focal_person);
                                @endphp
                                <option value='{{$person->id}}' @if($selected) 
                                    selected 
                                @endif>{{ucfirst($person->name)}} - {{$person->desig?->designation_name  ?? ''}}</option>
                                @endforeach
                              
                            </select>
                            <div id="focal_personError" class="error-message"></div>
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
    <script>
        // Select the "Project Extended" checkbox
        const projectExtendedCheckbox = document.getElementById('project_extended');
    
        // Select the container of the "NCE cost extent" checkbox
        const nceCostExtentContainer = document.getElementById('nce_cost_extent_container');
    
        // Add an event listener to the "Project Extended" checkbox
        projectExtendedCheckbox.addEventListener('change', function() {
            // If the "Project Extended" checkbox is checked, show the "NCE cost extent" checkbox; otherwise, hide it
            if (projectExtendedCheckbox.checked) {
                nceCostExtentContainer.style.display = 'block';
            } else {
                nceCostExtentContainer.style.display = 'none';
            }
        });
    </script>
    @endpush
</x-nform-layout>
