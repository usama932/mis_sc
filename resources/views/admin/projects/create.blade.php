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
                        
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project Title</span>
                            </label>
                            <input type="text" name="name" id="name" placeholder="Project Title"  class="form-control" value="">
                            <div id="nameError" class="error-message "></div>
                        </div>   
                        <div class="fv-row col-md-3 ">
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
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Donor</span>
                            </label>
                            <select   name="donor" id="donor" aria-label="Select a Donor" data-control="select2" data-placeholder="Select a Donor" class="form-select "  data-allow-clear="true" > 
                                <option  value=''>Select Donor</option>
                                @foreach($donors as $donor)
                                <option  value='{{$donor->id}}'>{{$donor->name}}</option>
                                @endforeach
                            </select>
                            <div id="donorError" class="error-message"></div>
                        </div>  
                     
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Awards Focal Person</span>
                            </label>
                            <select   name="award_person" id="award_person" aria-label="Select a Award FP" data-control="select2" data-placeholder="Select a Focal Person..." class="form-select "  data-allow-clear="true" > 
                                <option  value=''>Select Award  FP</option>
                                @foreach($awards as $award)
                                    <option  value='{{$award->id}}'>{{ucfirst($award->name)}} - {{$award->desig?->designation_name  ?? ''}}</option>
                                @endforeach
                            </select>
                            <div id="focal_personError" class="error-message"></div>
                        </div>  

                        <div class="fv-row col-md-4">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">SOF</span>
                            </label>
                            <input type="text" name="sof" id="sof" placeholder="Enter SOF" class="form-control" value="">
                            <div id="sofError" class="error-message "></div>
                        </div> 

                        <div class="fv-row col-md-4">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project Start Date</span>
                            </label>
                            <input type="text" name="start_date" id="start_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                            <div id="start_dateError" class="error-message "></div>
                        </div>

                        <div class="fv-row col-md-4">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project End Date</span>
                            </label>
                            <input type="text" name="end_date" id="end_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                            <div id="end_dateError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-4 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">MEAL Focal Person</span>
                            </label>
                            <select   name="meal_person[]" id="meal_person" aria-label="Select a Award FP" data-control="select2" data-placeholder="Select a MEAL Focal Person..." class="form-select "  data-allow-clear="true" > 
                                <option  value=''>Select MEAL  FP</option>
                                @foreach($meal_persons as $meal_person)
                                    <option  value='{{$meal_person->id}}'>{{ucfirst($meal_person->name)}} - {{$meal_person->desig?->designation_name  ?? ''}}</option>
                                @endforeach
                            </select>
                            <div id="meal_personError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-4">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Budget Holder FP</span>
                            </label>
                            <select   name="budget_holder[]" multiple id="budget_holder" aria-label="Select a Focal Person" data-control="select2" data-placeholder="Select a Focal Person..." class="form-select"  data-allow-clear="true" > 
                                <option  value=''>Select Focal Person</option>
                                @foreach($budget_holders as $budget_holder)
                                    <option  value='{{$budget_holder->id}}'>{{ucfirst($budget_holder->name)}} - {{$budget_holder->desig?->designation_name  ?? ''}}</option>
                                @endforeach
                            </select>
                            <div id="budget_holderError" class="error-message"></div>
                        </div> 
                        <div class="fv-row col-md-4 ">
                            <label class="fs-8 fw-semibold form-label mb-2">
                                <span class="required">Operational Focal Person</span>
                            </label>
                            <select   name="focal_person[]" id="focal_person" multiple aria-label="Select a Focal Person" data-control="select2" data-placeholder="Select a Focal Person..." class="form-select "  data-allow-clear="true" > 
                                <option  value=''>Select Focal Person</option>
                                @foreach($persons as $person)
                                    <option  value='{{$person->id}}'>{{ucfirst($person->name)}} - {{$person->desig?->designation_name  ?? ''}}</option>
                                @endforeach
                            </select>
                            <div id="focal_personError" class="error-message"></div>
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
 
</x-nform-layout>
