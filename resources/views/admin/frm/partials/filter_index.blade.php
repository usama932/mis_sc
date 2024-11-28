
<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h3 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <div class="d-flex align-items-center">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-10px me-5">
                        <span class="symbol-label bg-light-danger">
                            <i class="ki-duotone ki-filter-search fs-2x text-danger">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bold">Apply Filters</a>
                        
                    </div>
                    
                </div>
            </button>
        </h3>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="card-header border-0">
                    <div class="row mb-5">
                        <div class="col-md-4 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required" >Response #id</span>
                            </label>
                            <input type="text" name="response_id" id="response_id" class="form-control" value="">
                        </div>
                        <div class="col-md-4 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required" >Date Received</span>
                            </label>
                            <input type="text" name="date_received" id="date_recieved_id" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                        </div>
                        <div class="col-md-4 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Feedback Category</span>
                            </label>
                            <select name="feedback_category" id="feedback_category" aria-label="Select a Feedback Category" data-control="select2" data-placeholder="Select a Feedback Category..." class="form-select  " data-allow-clear="true" >
                                <option  value="" selected>Select Option</option>
                                <option  value="None" >All</option>
                                @foreach($feedbackcategories as $feedback_category)
                                    <option  value="{{$feedback_category->id}}">{{$feedback_category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Staff Name</span>
                            </label>
                            <select name="name_of_registrar" id="name_of_registrar" aria-label="Select a Registrar Name" data-control="select2" data-placeholder="Select a Registrar Name..." class="form-select  " data-allow-clear="true" >
                                <option  value="" selected>Select a Registrar Name</option>
                                <option  value="None" >All</option>
                                @foreach($users as $user)
                                    <option  value="{{$user->name}}" >{{$user->name}}</option>
                                @endforeach
                                <option  value="Ruqaiya Bibi" >Ruqaiya Bibi</option>
                                <option  value="Dr. Kashmala" >Dr. Kashmala</option>
                                <option  value="Mehnaz" >Mehnaz</option>
                                <option  value="Musarrat Bibi" >Musarrat Bibi</option>
                                <option  value="Shaista Mir" >Shaista Mir</option>
                                <option  value="Shama" >Shama</option>
                                <option  value="Zahid Ali Khan" >Zahid Ali Khan</option>
                            </select>
                        </div>
                       
    
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Feedback Channel</span>
                            </label>
                            <select name="feedback_channel" id="feedback_channel" aria-label="Select a Feedback Channel" data-control="select2" data-placeholder="Select a Feedback Channel..." class="form-select  " data-allow-clear="true" >
                                <option  value="" selected>Select Option</option>
                                <option  value="None" >All</option>
                                @foreach($feedbackchannels as $feedbackchannel)
                                    <option  value="{{$feedbackchannel->id}}">{{$feedbackchannel->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Name of Client</span>
                            </label>
                            <select name="name_of_client" aria-label="Select a Name of Client" data-control="select2" data-placeholder="Select a Client..." class="form-select  " id="name_of_client" data-allow-clear="true" >
                                <option  value="" selected>Select Option</option>
                                <option  value="None" >All</option>
                                @foreach($clients as $key => $client)
                                    <option  value="{{ $client }}">{{$client}}</option>
                                @endforeach
                            </select>
    
                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Gender</span>
                            </label>
                            <select name="gender" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a Gender..." class="form-select  " id="gender" data-allow-clear="true" >
                                <option  value="" selected>Select Option</option>
                                <option  value="None" >All</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Boy">Boy</option>
                                <option value="Girl">Girl</option>
                            </select>
    
                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Province</span>
                            </label>
                            <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select  " data-allow-clear="true" >
                                <option value="" selected>Select Province</option>
                                <option  value="None" >All</option>
                                <option value='4'>Sindh</option>
                                <option value='2'>KPK</option>
                                <option value='3'>Balochistan</option>
                            </select>
    
                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">District</span>
                            </label>
                            <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select  " data-allow-clear="true" >
    
                            </select>
                        </div>
                        <div class="col-md-3 my-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Status</span>
                            </label>
                            <select   name="type_of_client" id="type_of_client" aria-label="Select a Status" data-control="select2" data-placeholder="Select a Status" class="form-select  " data-allow-clear="true" >
                                <option value="" selected>Select Status</option>
                                <option  value="None" >All</option>
                                <option value="Open" >Open</option>
                                <option value="Close" >Close</option>
                                
                            </select>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project</span>
                            </label>
                            <select name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select  " data-allow-clear="true" >
                                <option value="" selected>Select Project</option>
                                  <option  value="None" >All</option>
                                @foreach($projects as $project)
                                    <option  value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>