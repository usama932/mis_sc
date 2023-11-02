<x-default-layout>
    @push('stylesheets')
    @endpush

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
        <form class="form" action="{{route('frm-response.update',$frm->id)}}" method="post">
            @csrf
            @method('post')
            <div class="card-body py-4">
                <div class="card-title  border-0 my-4"">

                <div class="row">
                    <div class="col-md-2 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Date Received</span>
                        </label>
                        <br>

                        <strong id="date">{{$frm->date_received ?? NA}}</strong>
                        <input type="hidden" name="frm_id" value="{{$frm->id}}">
                    </div>
                    <div class="col-md-4 mt-3 yes_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required"> Date on which the feedback or concern was resolved </span><br>

                        </label>
                        <input type="text" @error('date_feedback_referred') is-invalid @enderror name="date_feedback_referred" id="date_feedback_referred" placeholder="Select date" class="form-control" value="">
                        @error('date_feedback_referred')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3 no_divs">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Status</span>
                        </label>
                        <select   name="status" aria-label="Select a Status"  @error('status') is-invalid @enderror data-control="select2" data-placeholder="Select a Statut..." class="form-select form-select-solid statusid">
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
                    <div class="col-md-3 mt-3 no_divs actionid " id="actionid">
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
    <script src="{{asset('assets/js/custom/frm/frm.js')}}"></script>
    <script src="{{asset('assets/js/custom/frm/update_response.js')}}"></script>
       
    @endpush

</x-default-layout>
