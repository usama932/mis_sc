<x-default-layout>
    @push('stylesheets')
    <link rel="stylesheet" href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.bundle.css')}}">
    @endpush
    <style>
        .loader {
            display: none;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>
    @section('title')
        Edit Feedback/Complaint #.{{$frm->response_id}}
    @endsection
    <div id="loader" class="loader"></div>

    <div class="card">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        @if(session()->has('danger'))
        <div class="alert alert-danger">
            {{ session()->get('danger') }}
        </div>
        @endif
        <form class="form" action="{{route('frm-managements.update',$frm->id)}}" method="post">
            @csrf
            @method('put')
            <div class="card-body py-4">
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Information Receiver::</h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Staff Name</span>
                        </label>
                        <br>
                        <strong>{{$frm->name_of_registrar ?? 'NA'}}</strong>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Date Received</span>
                        </label>
                        <br>

                        <strong id="date">{{$frm->date_received ?? 'NA'}}</strong>
                    </div>
                    <div class="col-md-4 mt-3 mb-2">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Channel</span>
                        </label>
                        <select name="feedback_channel" aria-label="Select a Feedback Channel" data-control="select2" data-placeholder="Select a Country..." class="form-select" required  @error('feedback_channel') is-invalid @enderror>
                            <option @if($frm->feedback_channel == '') selected @endif value="">Select Option</option>
                            @foreach($feedbackchannels as $feedbackchannel)
                                <option @if($feedbackchannel->id == $frm->feedback_channel)     selected @endif value="{{$feedbackchannel->id}}">{{$feedbackchannel->name}}</option>
                            @endforeach
                        </select>
                        @error('feedback_channel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="card-title  border-2 my-4 ">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                <h5 class="fw-bold m-3">Information about the people who shared feedback::</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Complainant Name</span>
                        </label>
                        <input class="form-control"  @error('name_of_client') is-invalid @enderror placeholder="Enter Client Name" name="name_of_client" value="{{$frm->name_of_client ?? ''}}" required/>
                       
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Type</span>
                        </label>
                        <select   name="type_of_client" aria-label="Select a Type of Client" data-control="select2" data-placeholder="Select a Type of Client..." class="form-select form-select-solid"  @error('type_of_client') is-invalid @enderror required>
                            <option @if($frm->type_of_client == "") selected @else  @endif value="">Select Client</option>
                            <option @if($frm->type_of_client == "Direct Beneficiary") selected @else  @endif>Direct Beneficiary</option>
                            <option @if($frm->type_of_client == "Indirect Beneficiary") selected @else  @endif>Indirect Beneficiary</option>
                            <option @if($frm->type_of_client == "Non-Beneficiary") selected @else  @endif>Non-Beneficiary</option>
                            <option @if($frm->type_of_client == "Partner Staff") selected @else  @endif>Partner Staff</option>
                            <option @if($frm->type_of_client == "Save the Children Staff") selected @else  @endif>Save the Children Staff</option>
                        </select>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Gender</span>
                        </label>
                        <select   name="gender"  @error('gender') is-invalid @enderror aria-label="Select a Gender" data-control="select2" data-placeholder="Select a Gender..." class="form-select form-select-solid genderit" required>
                            <option @if($frm->gender == "") selected @else  @endif value="">Select Gender</option>
                            <option @if($frm->gender == "Boy") selected @else  @endif  value="Boy">Boy</option>
                            <option @if($frm->gender == "Girl") selected @else  @endif  value="Girl">Girl</option>
                            <option @if($frm->gender == "Male") selected @else  @endif value="Male">Male</option>
                            <option @if($frm->gender == "Female") selected @else  @endif value="Female">Female</option>
                        </select>
                       
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Age</span>
                        </label>
                        <select   name="age"  @error('age') is-invalid @enderror aria-label="Select a Gender" data-control="select2" data-placeholder="Select a age..." class="form-select form-select-solid" id="age_id" required>
                            @if(!empty($frm->age))
                            <option value="{{$frm->age}}">{{$frm->age}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Province</span>
                        </label>
                        <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select form-select-solid"   @error('province') is-invalid @enderror required>
                           
                                <option value="">Select Province</option>
                                {{-- <option value='1'>Punjab</option> --}}
                                <option @if($frm->province == '4') selected @endif value='4'>Sindh</option>
                                <option  @if($frm->province == '2') selected @endif value='2'>KPK</option>
                                <option   @if($frm->province == '3') selected @endif value='3'>Balochistan</option>
                         
                        </select>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">District</span>
                        </label>
                        <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select form-select-solid"  @error('district') is-invalid @enderror required>
                            <option value="{{$frm->district}}">{{$frm->districts?->district_name ?? $frm->district}}</option>
                        </select>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Tehsil</span>
                        </label>
                        <select id="kt_select2_tehsil"  @error('tehsil') is-invalid @enderror name="tehsil" aria-label="Select a Tehsil" data-control="select2" data-placeholder="Select a Tehsil..." class="form-select form-select-solid" required>
                            @if(!empty($frm->tehsil))
                            <option value="{{$frm->tehsil}}">{{$frm->tehsils?->tehsil_name ?? $frm->tehsil }}</option>
                            @endif
                        </select>
                       
                        {{-- <br>
                        <strong>{{$frm->tehsils->tehsil_name ?? $frm->tehsil}}</strong> --}}
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Union Council</span>
                        </label>
                        <select id="kt_select2_union_counsil"  @error('union_counsil') is-invalid @enderror name="union_counsil" aria-label="Select a UC" data-control="select2" data-placeholder="Select a Uc..." class="form-select form-select-solid" required>
                            @if(!empty($frm->union_counsil))
                            <option value="{{$frm->union_counsil}}">{{$frm->uc?->uc_name ?? $frm->union_counsil}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Village</span>
                        </label>
                        <input class="form-control "  @error('village') is-invalid @enderror placeholder="Enter Village" name="village" value="{{$frm->village ?? ''}}">
                      
                        {{-- <br>
                        <strong>{{$frm->village ?? 'NA'}}</strong> --}}
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">PWD/CLWD</span>
                        </label>
                        <br>
                        <strong>{{$frm->pwd_clwd ?? 'NA'}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Allow Contact</span>
                        </label>
                        <br>
                        <strong>{{$frm->allow_contact ?? 'NA'}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Contact Number</span>
                        </label>
                       
                        <input type="tel"  @error('contact_number') is-invalid @enderror class="form-control " placeholder="Enter Contact Number" name="contact_number" value=" {{ intval($frm->client_contact)  }}" />
                      
                    </div>
                    <div class="col-md-9 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description (Write Brief Narration)</span>
                        </label>
                        <textarea type="number"  @error('feedback_description') is-invalid @enderror class="form-control "  name="feedback_description" / required>{{$frm->feedback_description ?? ''}}</textarea>
                        @error('feedback_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-9 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">FeedBack Category </span>
                        </label>
                        <br>
                        <strong>{{$frm->category->name}}-{{$frm->category->description}}</strong>
                        @error('feedback_category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3 "x>
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Datix Number</span>
                        </label>
                        
                        <strong>{{$frm->datix_number ?? ''}}</strong>
                        @error('datix_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Theme</span>
                        </label>
                        <select   name="theme"  @error('theme') is-invalid @enderror aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme" class="form-select form-select-solid" required>
                            <option value="">Select Theme</option>
                            @foreach($themes as $theme)
                                <option  @if($frm->theme == $theme->id) selected @endif value="{{$theme->id}}">{{$theme->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Activity</span>
                        </label>
                        <input class="form-control"  @error('feedback_activity') is-invalid @enderror placeholder="Enter Feedback Activity" name="feedback_activity" value="{{$frm->feedback_activity ?? ''}}" / required>
                       
                    
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="">Project</span>
                        </label>
                        {{-- <br>
                        <strong>{{$frm->project?->name ?? ''}}</strong> --}}
                        <select   name="project_name"  @error('project_name') is-invalid @enderror aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a project" class="form-select">
                            <option  value="">Select Project</option>
                            @foreach($projects as $project)
                                <option @if($project->id == $frm->project_name) selected @endif value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-title  border-0 my-4"">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                <h5 class="fw-bold m-3">Information about the referring,
                                    actioning and closing of the feedback loop::</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Referred or Shared</span>
                        </label>
                        
                        <select name="feedback_referredorshared"  @error('feedback_referredorshared') is-invalid @enderror aria-label="Select a Option" data-placeholder="Select a Statut..." class="form-select form-select-solid shareid" disabled>
                            <option @if($frm->feedback_referredorshared == "") selected  @endif  value="">Select Option</option>
                            <option  @if($frm->feedback_referredorshared == "Yes") selected  @endif value="Yes">Yes</option>
                            <option  @if($frm->feedback_referredorshared == "No") selected  @endif value="No">No</option>
                        </select>
                        <input type="hidden" name="feedback_referredorshared" value="{{$frm->feedback_referredorshared}}" />
                        @error('feedback_referredorshared')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required"> Date of feedback Referred </span><br>
                            
                            {{ $frm->date_ofreferral ?? ''}}
                        </label>
                        <input type="text"  @error('date_feedback_referred') is-invalid @enderror name="date_feedback_referred" id="date_feedback_referred" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()"  data-provide="datepicker" value="">
                        
                        @error('date_feedback_referred')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Reffered To(Name)</span>
                        </label>

                        <input type="text"  @error('refferal_name') is-invalid @enderror name="refferal_name" placeholder="Enter Reffered To (Name)"  class="form-control " value="{{$frm->referral_name ?? ''}}">
                        @error('refferal_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Reffered To(Position)</span>
                        </label>
                        <input type="text" name="refferal_position"   @error('refferal_position') is-invalid @enderror placeholder="Enter Reffered To (Position)"  class="form-control " value="{{$frm->referral_position ?? ''}}" >
                        @error('refferal_position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description of actions undertaken to resolve the feedback</span>
                        </label>
                        <textarea  name="feedback_summary"   @error('feedback_summary') is-invalid @enderror  class="form-control">{{$frm->feedback_summary ?? ''}}</textarea>
                        @error('feedback_summary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3 no_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Status</span>
                        </label>
                        <select   name="status" aria-label="Select a Status"  @error('status') is-invalid @enderror data-control="select2" data-placeholder="Select a Statut..." class="form-select form-select-solid statusid">
                            <option @if($frm->status == '') selected @endif value="">Select Option</option>
                            <option @if($frm->status == 'Open') selected @endif value="Open">Open</option>
                            <option @if($frm->status == 'Close') selected @endif value="Close">Close</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if($frm->feedback_referredorshared == "No" )
                        <div class="col-md-4 mt-3 no_divs actionid " id="actionid">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Satisfiction </span>
                            </label>
                            <select name="actiontaken" id="action_id" aria-label="Select a Action"  @error('actiontaken') is-invalid @enderror data-control="select2" data-placeholder="Select a Action..." class="form-select form-select-solid " >
                                @if(!empty($frm->type_ofaction_taken))
                                    <option value="{{$frm->type_ofaction_taken}}">{{$frm->type_ofaction_taken}}</option>
                                @endif
                            </select>
                            @error('actiontaken')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" >Discard</button>
                    <button type="submit" class="btn btn-primary" >
                        Submit
                    </button>
                </div>
            </div>
        </form>

    </div>

    @push('scripts')
        <script src="{{asset('assets/js/custom/frm/edit.js')}}"></script>
        <script src="{{asset('assets/js/custom/frm/frm.js')}}"></script>
    @endpush

</x-default-layout>
