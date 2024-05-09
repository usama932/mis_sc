<x-default-layout>
    @section('title')
       Update Response Feedback/Complaint 
    @endsection

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
       
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h2><i class="fa-solid fa-info-circle mx-4"></i>FRM Detail</h2>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card-header border-0 pt-6">
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <table class="table table-striped m-4 p-4">
                                        <tr>
                                            <td class="fs-8"><strong>Response #.id</strong></td>
                                            <td>{{$frm->response_id ?? ''}}</td>
                                        </tr>
                                      
                                        <tr>
                                            <td><strong>Province</strong></td>
                                            <td>{{$frm->provinces->province_name ?? ''}}</td>
                                        </tr>
                                
                                        <tr>
                                            <td><strong>Tehsil</strong></td>
                                            <td>{{$frm->tehsils->tehsil_name ?? $frm->tehsil}}</td>
                                        </tr>
                                    
                                        <tr>
                                            <td><strong>Project</strong></td>
                                            <td>{{$frm->project?->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fs-9"><strong>Feedback Channel</strong></td>
                                            <td>{{$frm->channel?->name ?? "NA"}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Created By</strong></td>
                                            <td>{{$frm->user->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Created At</strong></td>
                                            <td>{{date('d-M-Y', strtotime($frm->created_at)) ?? ''}}</td>
                                        </tr>
                                      
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-striped m-4 p-4">
                                      
                                        <tr>
                                            <td><strong>Respondent Name</strong></td>
                                            <td>{{$frm->name_of_client ?? ''}}</td>
                                        </tr>
                                      
                                        <tr>
                                            <td class="fs-8"><strong>District</strong></td>
                                            <td>
                                                {{$frm->districts->district_name ?? ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Union Council</strong></td>
                                            <td>{{$frm->uc->uc_name ?? $frm->union_counsil}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Village</strong></td>
                                            <td>{{$frm->village}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Theme</strong></td>
                                            <td>{{$frm->theme_name->name ?? ""}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Updated By</strong></td>
                                            <td>{{$frm->user1->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Updated At</strong></td>
                                            <td>{{$frm->updated_at ?? ''}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <tr>
                                        <td><strong>Feedback Description</strong></td>
                                        <td>
                                        {{$frm->feedback_description ?? ''}} 
                                        </td>
                                    </tr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    
        <form class="form" action="{{route('frm-response.update',$frm->id)}}" method="post">
            @csrf
            @method('post')
            <div class="card-body py-4">
                <div class="card-title  border-0 my-4"">

                <div class="row">
                    <div class="col-md-12 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Date Received</span>
                        </label>
                        <br>
                        <strong id="date">{{$frm->date_received ?? NA}}</strong>
                        <input type="hidden" name="frm_id" value="{{$frm->id}}">
                    </div>
                    <div class="col-md-12 mt-3 yes_divs">
                        <label class="fs-7 fw-semibold form-label mb-2">
                            <span class="required"> Date on which the feedback  was resolved </span><br>
                        </label>
                        <input type="text" @error('date_feedback_referred') is-invalid @enderror name="date_feedback_referred" id="date_feedback_referred" placeholder="Select date" class="form-control" value="">
                        @error('date_feedback_referred')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3 no_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Status</span>
                        </label>
                        <select   name="status" aria-label="Select a Status"  @error('status') is-invalid @enderror data-control="select2" data-placeholder="Select a Statut..." class="form-select  statusid">
                            <option  selected >Select Option</option>
                            <option value="Open">Open</option>
                            <option  value="Close">Close</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3 no_divs actionid " id="actionid">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Satisfiction</span>
                        </label>
                        <select name="actiontaken" id="action_id" aria-label="Select a Action"  @error('actiontaken') is-invalid @enderror data-control="select2" data-placeholder="Select a Action..." class="form-select form-select-solid " >
                        </select>
                        @error('actiontaken')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description of actions undertaken to resolve the feedback</span>
                        </label>
                        <textarea  name="feedback_response"   @error('feedback_response') is-invalid @enderror  class="form-control"></textarea>
                        @error('feedback_response')
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
    {{-- <script src="{{asset('assets/js/custom/frm/frm.js')}}"></script>
    <script src="{{asset('assets/js/custom/frm/update_response.js')}}"></script> --}}
       
    @endpush

</x-default-layout>
