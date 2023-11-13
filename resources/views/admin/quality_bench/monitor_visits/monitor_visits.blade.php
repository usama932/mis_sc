<div>
    <div class="">
        <h5><span class="text-danger ">Note:: </span>This Monitoring Visit has <span class="text-danger "> {{$qb->qbs_not_fully_met ?? ''}}</span> QBs not fully met.</h5>
        @if($qb->qbs_not_fully_met > $qb->monitor_visit->count())
        <div class="d-flex justify-content-end hover-elevate-up">
            <button class="btn btn-sm btn-primary ml-5" id="addqbBtn"> <i class="ki-duotone ki-abstract-10">
            <span class="path1"></span>
            <span class="path2"></span>
            </i>Add QB Not Full Met</button>
        </div>
        @endif
       
    </div>
  
    <div  id="qbformDiv">
        
        <form class="form" id="qb_monitor_form"  novalidate="novalidate" action="{{route('monitor_visits.store')}}" method="post">
            @csrf
            <input type="hidden" name="quality_bench_id" value="{{$qb->id}}">
            <div class="card-body">
                <div class="card-title  border-0"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Add QB Not Fully Met::</h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="fv-row col-md-6 mt-3">
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
                    </div> --}}
                    <div class="fv-row col-md-2 mt-3">
                        <label class="fs-9 fw-semibold form-label mb-2">
                            <span class="required">Activity No.# from DIP (eg: 1.1)</span>
                        </label>
                        <input type="text"  name="activity_number"  placeholder="Enter Activity Number"  class="form-control"   value="" required>
                    </div>
                    <div class="fv-row col-md-10 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Quality Benchmark Activity Detail</span>
                        </label>
                        <textarea class="form-control "  name="qbs_description" / required></textarea>
                    
                    </div>
                    
                    <div class="fv-row col-md-4 mt-3">
                        <input type="hidden" name="qb_met" value="Not Fully Met" id="qb_met" >
                        {{-- <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">QB Met</span>
                        </label> 
                        
                        <select   name="c" id="qb_met" aria-label="Select a QB Met" data-control="select2" data-placeholder="Select a QB Met..." class="form-select  qb_id" required>
                            <option value="">Select QB Met</option>
                            <option  value="Not Fully Met" selected>Not Fully Met</option>
                        <option  value="Fully Met">Fully Met</option> 
                        </select>  --}}
                        
                    </div> 
                    <div class="fv-row col-md-12 mt-3" id="gap_id">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Gap/issue</span>
                        </label>
                        <textarea class="form-control " name="gap_issue" id="gap_issue"></textarea>
                    
                    </div>
                </div>
            
            
                </div>
                <div class="d-flex justify-content-end m-5  ">
                    <button type="submit" id="kt_qb_monitor_submit" class="btn btn-sm btn-primary">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                    
                </div>
            </div>
        </form>
    </div>
    <div class="card-body" id="qbtableDiv">

        <div class="card-title  border-0 ">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative" style="background-color: #F1C40F !important; border-radius:25px;">
                    <h5 class="fw-bold m-3">QB/Issues List::</h5>
                  

                </div>
            </div>
        </div>
        <div class="table-responsive overflow-*">
            <table class="table table-bordered" id="monitor_visits"style="margin-top: 13px !important">
            <thead>
                <tr>
                  
                    <th>Activity.#</th>
                    <th>Gap/Issue</th>
                    <th>Created At</th>
                    <th>Actions</th>
                
                </tr>
                
            </thead>
         
            </table>
           
        </div>
        <div class="modal fade" id="view_monitor_visit" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="view_monitor_visit">Monitor Visit Details</h4>
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

