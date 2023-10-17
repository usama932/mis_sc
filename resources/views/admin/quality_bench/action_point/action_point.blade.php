<div>
    <form class="form" action="{{route('action_points.store')}}" method="post">
        @csrf
        <input type="hidden" name="quality_bench_id" value="{{$qb->id}}">
        <div class="card-body py-4">
            <div class="card-title  border-0 my-4"">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                        <h5 class="fw-bold m-3">Action Points Detail::</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Quality Bench ID.#</span>
                    </label>
                    <br>
                    <strong>#.000{{$qb->id}}</strong>
                
                    @error('activity_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Activity No.# from DIP</span>
                    </label>
                    <select   name="activity_number"  @error('activity_number') is-invalid @enderror aria-label="Select a Action Point Agree" data-control="select2" data-placeholder="Select a Activity Number..." class="form-select form-select-solid " id="activity_id" required>
                        <option value="">Select Activity Number</option>
                        @foreach($monitor_visits as $monitor_visit)
                            <option  value="{{$monitor_visit->id}}">{{$monitor_visit->activity_number}}</option>
                        @endforeach
                        
                    </select>

                    @error('activity_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-8 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Debrief Notes against identify Gap</span>
                    </label>
                    <textarea   @error('db_note') is-invalid @enderror class="form-control "  name="db_note" id="db_note"  required></textarea>
                    
                    @error('db_note')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Action Point Agree</span>
                    </label>
                    <select   name="action_agree"  @error('action_agree') is-invalid @enderror aria-label="Select a Action Point Agree" data-control="select2" data-placeholder="Select a Action Point Agree..." class="form-select form-select-solid agree_id" required>
                        <option value="">Select Action Point Agree</option>
                        <option  value="Yes">Yes</option>
                        <option  value="No">No</option>
                    </select>
                    @error('action_agree')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Actions to make QBs</span>
                    </label>
                    <textarea   @error('qb_recommendation') is-invalid @enderror class="form-control "  name="qb_recommendation"></textarea>
                    
                    @error('qb_recommendation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Action Type</span>
                    </label>
                   
                    <select   name="action_type"  @error('action_type') is-invalid @enderror aria-label="Select a Action Type" data-control="select2" data-placeholder="Select a Action Type..." class="form-select form-select-solid">
                        <option value="">Select Action Type</option>
                        <option  value="Administrative">Administrative</option>
                        <option  value="Technical">Technical</option>
                        <option  value="Both (Technical/Administrative)">Both (Technical/Administrative)</option>
                    </select>
                    @error('qb_recommendation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Who is responsible?</span>
                    </label>
                    <input class="form-control" @error('responsible_person') is-invalid @enderror placeholder="Enter Who is Responsible" name="responsible_person" value="" >
                 
                    @error('responsible_person')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Deadline</span>
                    </label>
                    <input type="text"  @error('deadline') is-invalid @enderror name="deadline" id="deadline" placeholder="Select Deadline"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="" >
                    @error('deadline')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        
        
            </div>
            <div class="text-center pt-15">
                <a href="{{route('quality-benchs.index')}}" class="btn btn-light me-3" >Discard</a>
                <button type="submit" class="btn btn-primary" >
                    Submit
                </button>
            </div>
        </div>
       
    </form>
    <div class="card-body mt-5 overflow-*">

        <div class="card-title  border-0 my-4"">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                    <h5 class="fw-bold m-3">Action Point List::</h5>
                </div>
            </div>
        </div>
        <div class="table-responsive overflow-*">
            <table class="table table-bordered" id="action_points"style="margin-top: 13px !important">
            <thead>
                <tr>
                    <th>#S.No</th>
                    <th>Site Visit</th>
                    <th>Agree</th>
                    <th>Type</th>
                    <th>Responsible Person</th>
                    <th>Deadline</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>
         
            </table>
           
        </div>
        <div class="modal fade" id="view_action_point" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="view_monitor_visit">Action Point Details</h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold close"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>