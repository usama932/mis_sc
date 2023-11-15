<div>
    
    <div class="">
        <h5><span class="text-danger ">Note:: </span>This Monitoring Visit has <span class="text-danger"> {{$qb->qbs_not_fully_met ?? ''}}</span> QBs not fully met.</h5>
        @if($qb->qbs_not_fully_met > $qb->action_point->count())
        <div class="d-flex justify-content-end hover-elevate-up">
            <button class="btn btn-sm btn-primary ml-5" id="addactionpointBtn"> <i class="ki-duotone ki-abstract-10">
            <span class="path1"></span>
            <span class="path2"></span>
            </i>Action Point</button>
        </div>
        @endif
    </div>
   
    <form class="form" id="qb_action_point_form"  novalidate="novalidate" action="{{route('action_points.store')}}" method="post">  
       
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
                <div class="fv-row col-md-12 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Select Identified Gap</span>
                    </label>
                    <select name="activity_number"  @error('activity_number') is-invalid @enderror aria-label="Select a Action Point Agree" data-control="select2" data-placeholder="Gap/Issues" class="form-select  " id="activity_id" >
                        <option value="">Select Activity Number</option>
                        @foreach($monitor_visits as $monitor_visit)
                            <option  value="{{$monitor_visit->id}}">{{$monitor_visit->activity_number}}- {{$monitor_visit->gap_issue}}</option>
                        @endforeach  
                    </select>
                </div>
                <div class="fv-row col-md-8 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Debrief Notes against identify Gap</span>
                    </label>
                    <textarea class="form-control "  name="db_note" ></textarea>
                </div>
                <div class="fv-row col-md-4 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Action Point Agree</span>
                    </label>
                    <select   name="action_agree" id="action_agree" @error('action_agree') is-invalid @enderror aria-label="Select a Action Point Agree" data-control="select2" data-placeholder="Select a Action Point Agree..." class="form-select  agree_id" required>
                        <option value="">Select Action Point Agree</option>
                        <option  value="Yes">Yes</option>
                        <option  value="No">No</option>
                    </select>
                </div>
                <div class="fv-row col-md-12 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Actions to make QB Fully Met</span>
                    </label>
                    <textarea  class="form-control "  name="qb_recommendation" id="qb_recommendation"></textarea>
                </div>
                <div class="fv-row col-md-3 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Action Type</span>
                    </label>
                    <select   name="action_type" id="action_type" aria-label="Select a Action Type" data-control="select2" data-placeholder="Select a Action Type..." class="form-select">
                        <option value="">Select Action Type</option>
                        <option  value="Administrative">Administrative</option>
                        <option  value="Technical">Technical</option>
                        <option  value="Both (Technical/Administrative)">Both (Technical/Administrative)</option>
                    </select>
                </div>
                <div class="fv-row col-md-3 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Who is responsible?</span>
                    </label>
                    <input class="form-control" placeholder="Enter Who is Responsible" name="responsible_person" id="responsible_person" value="" >
                </div>
                <div class="fv-row col-md-3 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Deadline</span>
                    </label>
                    <input type="text"  @error('deadline') is-invalid @enderror name="deadline" id="deadline" placeholder="Select Deadline"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="" >
                </div>
                <div class="fv-row col-md-3 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Status</span>
                    </label>
                    <select name="status" id="status" aria-label="Select a Status" data-control="select2" data-placeholder="Select Status" class="form-select">
                        <option value="">Select Status</option>
                        <option  value="To be Acheived">To be Acheived</option>
                        <option  value="Partialy Acheived">Partialy Acheived</option>
                        <option  value="Acheived">Acheived</option>
                        <option  value="Not Acheived">Not Acheived</option>   
                    </select>
                </div>
            </div>
        
        
            </div>
            <div class="d-flex justify-content-end pt-5">
                <button type="submit" id="kt_action_point_submit" class="btn btn-primary btn-sm">
                    @include('partials/general/_button-indicator', ['label' => 'Add Action Point'])
                </button>
            </div>
        </div>
       
    </form>
    <div class="card-bod py-4" id="actionpointtableDiv">

        <div class="card-title  border-0">
            <div class="card-title my-4">
                <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                    <h5 class="fw-bold m-3">Action Point List::</h5>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="action_points"style="margin-top: 13px !important">
                <thead>
                    <tr>
                        <th>Activity.#</th>
                        <th>Debrief Notes against identified Gap(s)</th>
                        <th>Action Agree</th>
                        <th>Actions to make QB Fully Met</th>
                        <th>Type</th>
                        <th>Responsible Person</th>
                        <th>Deadline</th>
                        <th>status</th>
                        {{-- <th>Created By</th> --}}
                        <th>Created At</th>
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
