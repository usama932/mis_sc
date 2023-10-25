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
                            <span class="required">Name</span>
                        </label>
                        <br>
                        <strong>{{$frm->name_of_client ?? 'NA'}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Type</span>
                        </label>
                        <br>
                        <strong>{{$frm->type_of_client ?? 'NA'}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Gender</span>
                        </label>
                        <br>
                        <strong>{{$frm->gender ?? 'NA'}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Age</span>
                        </label>
                        <br>
                        <strong>{{$frm->age ?? 'NA'}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Province</span>
                        </label>
                        <br>
                        <strong>{{$frm->provinces->province_name ?? $frm->province}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">District</span>
                        </label>
                        <br>
                        <strong>{{$frm->districts->district_name ?? 'NA'}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Tehsil</span>
                        </label>
                        <br>
                        <strong>{{$frm->tehsils->tehsil_name ?? $frm->tehsil}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Union Counsil</span>
                        </label>
                        <br>
                        <strong>{{$frm->uc->uc_name ?? $frm->union_counsil}}</strong>
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
                        <br>
                        <strong>{{$frm->client_contact ?? 'NA'}}</strong>
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
                        <br>
                        <strong>{{$frm->theme_name->name ?? 'NA'}}</strong>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Activity</span>
                        </label>
                        <br>
                        <strong>{{$frm->feedback_activity ?? 'NA'}}</strong>
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
        <script>

            $(function () {
                $('[name="date_feedback_referred"]').change(function(){

                    var date_recieved_id =  document.getElementById("date").innerHTML;
                    var originalDateString = $("#date_feedback_referred").val();

                    var parts = originalDateString.split('-');

                    var originalDate = new Date('20' + parts[0], parts[1] - 1, parts[2]);

                    var date_feedback_referred = originalDate.getFullYear() + '-' + ('0' + (originalDate.getMonth() + 1)).slice(-2) + '-' + ('0' + originalDate.getDate()).slice(-2);

                    if(date_feedback_referred >= date_recieved_id) {
                        //Do something..
                    }
                    else{
                        swal.fire({
                                text: "Sorry, Date Reffered Must be Greater Than Date Recieved.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function () {
                                KTUtil.scrollTop();

                            // $('#exampleModal').modal('hide');
                            // console.log("invalid");
                            });
                    }

                });
            });

        </script>
        @include('admin.frm.frm_script')

    @endpush

</x-default-layout>
