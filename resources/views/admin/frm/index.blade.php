<x-default-layout>

    @section('title')
    FRM List
    @endsection
    
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card-toolbar m-5 d-flex justify-content-end">   
             @can('create feedback registry')
            <!--begin::Button-->
                <a href="{{ route('frm-managements.create') }}" class="btn btn-primary btn-sm font-weight-bolder">
                    <span class="svg-icon svg-icon-primary svg-icon-1x mx-1">
                        <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                                <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/>
                            </g>
                        </svg>
                    </span>Add Feedback/Complaint
                </a>
                <!--end::Button-->
            @endcan
        </div>
        <div class="card">
            <div class="card-title m-5">
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success  p-5 rounded">
                            <h1 class="m-5">Total FRM =>
                            
                                {{$total_frm ?? ''}}
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-primary p-5 rounded">
                            <h1 class="m-5">Open FRM =>
                            
                                {{$open_frm ?? ''}}
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning p-5 rounded">
                            <h1 class="m-5">Close FRM =>
                            
                                {{$close_frm ?? ''}}
                            </h1>
                        </div>
                    </div>
                </div>
             
            </div>
            
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h2><i class="fa-solid fa-filter mx-4"></i>Filters</h2>
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card-header border-0 pt-6">
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
                                        <span class="required">Age</span>
                                    </label>
                                    <select name="age" aria-label="Select a Age" data-control="select2" data-placeholder="Select a age..." class="form-select  " id="age_id" data-allow-clear="true" >
                                        <option  value="" selected>Select Option</option>
                                        <option  value="None" >All</option>
                                        <option value="Less than 18 years">Less than 18 years</option>
                                        <option value="19-50 years">19-50 years</option>
                                        <option value="Above 50 years">Above 50 years</option>
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
         
            <div class="card-body pt-0 overflow-*">


                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="frm" style="width:100%">
                    <thead>
                        <tr>
                            <th>#S.No</th>
                            <th>Response.#</th>
                            <th>Name of Registrar</th>
                            <th>Date Recieved</th>
                            <th>Feedback Channel</th>
                            <th>Name</th>
                            <th>Type of Client</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Province</th>
                            <th>District</th>
                            <th>Tehsil</th>
                            {{-- <th>Union Council</th>
                            <th>Village</th>
                            <th>PWD/CLWD</th> --}}
                            <th>Client Contact.# </th>
                            <th>Feedback Category</th>
                            <th>Theme</th>
                            <th>Project</th>
                            <th>Date of Reffered</th>
                            <th>Refferal Name</th>
                            <th>Refferal Position</th>
                            <th>Satisfiction</th>
                            <th>Status</th>
                            {{-- <th>Feedback Summary</th> --}}
                            <th>Update Response</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @push("scripts")
    
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
   
    <script src="{{asset('assets/js/custom/frm/index.js')}}"></script>

    @endpush


</x-default-layout>
