<div>
    <div class="">
        @if($qb->qbs_not_fully_met > $count_monitor_visit)
            <div class="alert alert-warning d-flex align-items-center mt-10 me-20 ms-10">
                <i class="ki-duotone ki-shield-tick fs-2hx text-warning me-4"><span class="path1"></span><span class="path2"></span></i>                    
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-warning">QBs Not Fully Met</h4>
                    <span>This Monitoring Visit has {{$qb->qbs_not_fully_met ?? ''}} Not Fully met QBs.<span class="text-danger">Remaining {{$qb->qbs_not_fully_met}} - {{$count_monitor_visit }}</span></span>
                </div>
            </div>
        @endif
        <div class="d-flex justify-content-end hover-elevate-up ">
            @if($qb->qbs_not_fully_met > $count_monitor_visit)
                <button class="btn btn-sm btn-primary mx-1" id="addqbBtn"> <i class="ki-duotone ki-abstract-10">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    </i>Add QB Not Full Met
                </button>
            @endif
            <button class="btn btn-sm btn-info me-5" id="addgeneralobs"> <i class="ki-duotone ki-abstract-10">
                <span class="path1"></span>
                <span class="path2"></span>
                </i>Add General Observations
            </button>
        </div>
        
  
    <div  id="qbformDiv">
        
        <form class="form" id="qb_monitor_form"  novalidate="novalidate" action="{{route('monitor_visits.store')}}" method="post">
            @csrf
            <input type="hidden" name="quality_bench_id" value="{{$qb->id}}">
            <div class="card-body">
        
                <div class="row">
                 
                    <div class="fv-row col-md-2 mt-3">
                        <label class="fs-9 fw-semibold form-label mb-2">
                            <span class="required">Activity No.# from DIP (eg: 1.1)</span>
                        </label>
                        <input type="text"  name="activity_number"  placeholder="Enter Activity Number"  class="form-control"   value="">
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
                    <button type="button" class="btn btn-sm btn-danger mx-2 me-5" id="cancelmonitorBtn" style="display: none;"> 
                        <i class="ki-duotone ki-abstract-10">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div  id="general_obsform">
        
        <form class="form" id="general_observation"  novalidate="novalidate" action="{{route('monitor_visits.store')}}" method="post">
            @csrf
            <input type="hidden" name="quality_bench_id" value="{{$qb->id}}">
            <input type="hidden" name="activity_number" value="1.1">
            <input type="hidden" name="gb" value="999999">
            <div class="card-body">
               
                <div class="row">
                  
                    <div class="fv-row col-md-12 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">General Observation Detail</span>
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
                            <span class="">Gap/issue</span>
                        </label>
                        <textarea class="form-control " name="gap_issue" id="gap_issue"></textarea>
                    
                    </div>
                </div>
            
            
                </div>
                <div class="d-flex justify-content-end m-5  ">
                    <button type="submit" id="kt_general_observation" class="btn btn-sm btn-primary">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                    <button type="button" class="btn btn-sm btn-danger mx-2 me-5" id="cancelgbBtn" style="display: none;"> 
                        <i class="ki-duotone ki-abstract-10">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body" id="qbtableDiv">

        <div class="card-title  border-0 ">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative" style="background-color: #F1C40F !important; border-radius:25px;">
                    <h5 class="fw-bold m-3">QBs Not Fully Met & General Observations List</h5>
                  

                </div>
            </div>
        </div>
        <div class="table-responsive overflow-*">
            <table class="table table-bordered" id="monitor_visits"style="margin-top: 13px !important">
            <thead>
                <tr>
                  
                    <th width="10%">Activity.#</th>
                    <th width="30%">QB/Observation</th>
                    <th width="30%">Gap/Issue</th>
                    <th width="20%">Created At</th>
                    <th width="10%">Actions</th>
                
                </tr>
                
            </thead>
         
            </table>
           
        </div>
        <div class="modal fade" id="view_monitor_visit" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
        <div class="modal fade" id="edit_monitor_visit" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="edit_monitor_visit">Edit QB Not Fully Met</h4>
                    </div>
                    <div class="modal-body"></div>
                    
                </div>
            </div>
        </div>
    </div>

