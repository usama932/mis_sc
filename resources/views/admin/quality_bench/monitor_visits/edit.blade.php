<form class="form" id="general_observation"  novalidate="novalidate" action="{{route('monitor_visits.update',$monitor_visit->id)}}" method="post">
    @csrf
    @method('put')
    <input type="hidden" name="quality_bench_id" value="{{$qb->id}}">

    <div class="card-body">
       
        <div class="row">
            @if($monitor_visit->activity_type == "act")
                <div class="fv-row col-md-2 mt-3">
                    <label class="fs-9 fw-semibold form-label mb-2">
                        <span class="required">Activity No.# from DIP (eg: 1.1)</span>
                    </label>
                    <input type="text"  name="activity_number"  placeholder="Enter Activity Number"  class="form-control"   value="{{$monitor_visit->activity_number ?? ''}}">
                </div>
                <div class="fv-row col-md-10 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Quality Benchmark Activity Detail</span>
                    </label>
                    <textarea class="form-control "  name="qbs_description" / required>{{$monitor_visit->qbs_description ?? ''}}</textarea>
                
                </div>
            @else
                <input type="hidden" name="activity_number" value="1.1">
                <input type="hidden" name="gb" value="999999">
                <div class="fv-row col-md-12 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">General Observation Detail</span>
                    </label>
                    <textarea class="form-control "  name="qbs_description" / required>{{$monitor_visit->qbs_description ?? ''}}</textarea>
                
                </div>
            @endif
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
                <textarea class="form-control " name="gap_issue" id="gap_issue">{{$monitor_visit->gap_issue ?? ''}}</textarea>
            
            </div>
        </div>
        <div class="separator my-10"></div>
        <div class="d-flex justify-content-end">
            <div class="modal-footer">
                <button type="submit" id="kt_general_observation" class="btn btn-sm btn-primary font-weight-bold">
                    @include('partials/general/_button-indicator', ['label' => 'Submit'])
                </button>
              
            </div>
           
        </div>
    </div>
</form>