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
        Add Feedback Registry Form
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
                        <strong>{{$frm->name_of_registrar ?? NA}}</strong>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Date Received</span>
                        </label>
                        <br>

                        <strong id="date">{{$frm->date_received ?? NA}}</strong>
                    </div>
                    <div class="col-md-4 mt-3 mb-2">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Channel</span>
                        </label>
                        <select name="feedback_channel" aria-label="Select a Feedback Channel" data-control="select2" data-placeholder="Select a Country..." class="form-select form-select-solid" required  @error('feedback_channel') is-invalid @enderror>
                            <option @if($frm->feedback_channel == '') selected @endif value="">Select Option</option>
                            <option @if($frm->feedback_channel == 'Hotline') selected @endif >Hotline</option>
                            <option  @if($frm->feedback_channel == 'SMS') selected @endif >SMS</option>
                            <option  @if($frm->feedback_channel == 'Feedback Form') selected @endif >Feedback Form</option>
                            <option  @if($frm->feedback_channel == 'Email') selected @endif >Email</option>
                            <option  @if($frm->feedback_channel == 'Field Monitoring') selected @endif>Field Monitoring</option>
                            <option  @if($frm->feedback_channel == 'Post Distribution Monitoring') selected @endif >Post Distribution Monitoring</option>
                            <option  @if($frm->feedback_channel == 'Medical Exit Interview') selected @endif >Medical Exit Interview</option>
                            <option  @if($frm->feedback_channel == 'Community meeting') selected @endif>Community meeting</option>
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
                        <strong>{{$frm->name_of_client ?? NA}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Type</span>
                        </label>
                        <br>
                        <strong>{{$frm->type_of_client ?? NA}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Gender</span>
                        </label>
                        <br>
                        <strong>{{$frm->gender ?? NA}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Age</span>
                        </label>
                        <br>
                        <strong>{{$frm->age ?? NA}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Province</span>
                        </label>
                        <br>
                        <strong>{{$frm->province ?? NA}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">District</span>
                        </label>
                        <br>
                        <strong>{{$frm->district ?? NA}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Tehsil</span>
                        </label>
                        <br>
                        <strong>{{$frm->tehsil ?? NA}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Union Counsil</span>
                        </label>
                        <br>
                        <strong>{{$frm->union_counsil ?? NA}}</strong>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Village</span>
                        </label>
                        <br>
                        <strong>{{$frm->village ?? NA}}</strong>
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
                        <strong>{{$frm->allow_contact ?? NA}}</strong>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Contact Number</span>
                        </label>
                        <br>
                        <strong>{{$frm->contact_number ?? 'NA'}}</strong>
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
                        <select   name="feedback_category"  @error('feedback_category') is-invalid @enderror aria-label="Select a Feedback Category" data-control="select2" data-placeholder="Select a Feedback Category" class="form-select form-select-solid categoryit" required>
                            <option @if($frm->feedback_category == '') selected @endif>Select Option</option>
                            <option @if($frm->feedback_category == 'Category 0-Thank you message/ Positive Feedback') selected @endif>Category 0-Thank you message/ Positive Feedback</option>
                            <option @if($frm->feedback_category == 'Category 1-Request for Information') selected @endif>Category 1-Request for Information</option>
                            <option @if($frm->feedback_category == 'Category 2-Request for Assistance') selected @endif>Category 2-Request for Assistance</option>
                            <option @if($frm->feedback_category == 'Category 3-Minor Dissatisfaction with activities or suggestion for improvement') selected @endif>Category 3-Minor Dissatisfaction with activities or suggestion for improvement</option>
                            <option @if($frm->feedback_category == 'Category 4-Major Dissatisfaction; non-payment of salary to SCI representative staff with activities or suggestion for improvement') selected @endif>Category 4-Major Dissatisfaction; non-payment of salary to SCI representative staff with activities or suggestion for improvement</option>
                            <option @if($frm->feedback_category == 'Category 5-Breach of CSP & PESA including Fraud concerns; unsafe programming; security threats by SCI or its representative staff') selected @endif>Category 5-Breach of CSP & PESA including Fraud concerns; unsafe programming; security threats by SCI or its representative staff</option>
                            <option @if($frm->feedback_category == 'Category 6-Negative feedback related to other organizations') selected @endif>Category 6-Negative feedback related to other organizations</option>
                        </select>
                        @error('feedback_category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3 " id="show_datix">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Datix Number</span>
                        </label>
                        <input type="number" class="form-control"  @error('datix_number') is-invalid @enderror placeholder="Enter Datix Number" name="datix_number" value="{{$frm->datix_number ?? ''}}" />
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
                        <strong>{{$frm->theme ?? NA}}</strong>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Feedback Activity</span>
                        </label>
                        <br>
                        <strong>{{$frm->feedback_activity ?? NA}}</strong>
                    </div>
                    <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Project</span>
                        </label>
                        <br>
                        <strong>{{$frm->project_name ?? NA}}</strong>
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
                        <select name="feedback_referredorshared"  @error('feedback_referredorshared') is-invalid @enderror aria-label="Select a Option" data-placeholder="Select a Statut..." class="form-select form-select-solid shareid"  required>
                            <option @if($frm->feedback_referredorshared == "") selected  @endif>Select Option</option>
                            <option  @if($frm->feedback_referredorshared == "Yes") selected  @endif value="Yes">Yes</option>
                            <option  @if($frm->feedback_referredorshared == "No") selected  @endif value="No">No</option>
                        </select>
                        @error('feedback_referredorshared')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required"> Date of feedback Referred </span>
                        </label>
                        @php

                        @endphp

                        <input type="text" @error('date_feedback_referred') is-invalid @enderror name="date_feedback_referred" id="date_feedback_referred" placeholder="Select date" class="form-control" value="{{ date("Y-m-d", strtotime($frm->date_ofreferral)) ?? "" }}">
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
                            <option @if($frm->status == '') selected @endif>Select Option</option>
                            <option @if($frm->status == 'Open') selected @endif value="Open">Open</option>
                            <option @if($frm->status == 'Close') selected @endif value="Close">Close</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3 no_divs actionid " id="actionid">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Action Taken </span>
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
            flatpickr("#date_feedback_referred", {
8
            $('[name="date_feedback_referred"]').change(function(){

                var date_recieved_id =  document.getElementById("date").innerHTML;
                alert(date_recieved_id);
                var date_feedback_referred =$("#date_feedback_referred").val();
                alert(date_feedback_referred);
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
