<div>
    <form class="form" id="qb_monitor_form"  novalidate="novalidate" action="{{route('monitor_visits.store')}}" method="post">
        @csrf
        <input type="hidden" name="quality_bench_id" value="{{$qb->id}}">
        <div class="card-body py-4">
            <div class="card-title  border-0 my-4"">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                        <h5 class="fw-bold m-3">Detail of Monitoring Visits::</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="fv-row col-md-6 mt-3">
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
                <div class="fv-row col-md-6 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Activity No.# from DIP</span>
                    </label>
                    <input type="text"  name="activity_number"  placeholder="Enter Activity Number"  class="form-control"   value="" required>
                
                    @error('activity_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="fv-row col-md-8 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Quality Benchmarks (QBs)</span>
                    </label>
                    <textarea class="form-control "  name="qbs_description" / required></textarea>
                
                </div>
                <div class="fv-row col-md-4 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">QB Met</span>
                    </label>
                    <select   name="qb_met" aria-label="Select a QB Met" data-control="select2" data-placeholder="Select a QB Met..." class="form-select form-select-solid qb_id" required>
                        <option value="">Select QB Met</option>
                        <option  value="Not Fully Met">Not Fully Met</option>
                        <option  value="Fully Met">Fully Met</option>
                    </select>
                    
                </div>
                <div class="fv-row col-md-12 mt-3" id="gap_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Gap/issue (if not fully met)</span>
                    </label>
                    <textarea class="form-control " name="gap_issue"></textarea>
                  
                </div>
            </div>
        
        
            </div>
            <div class="text-center pt-15">
                <button type="submit" id="kt_qb_monitor_submit" class="btn btn-primary">
                    @include('partials/general/_button-indicator', ['label' => 'Submit'])
                </button>
                
            </div>
        </div>
    </form>
    <div class="card-body mt-5 overflow-*">

        <div class="card-title  border-0 my-4"">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                    <h5 class="fw-bold m-3">Quality Bench Monitoring Visits::</h5>
                </div>
            </div>
        </div>
        <div class="table-responsive overflow-*">
            <table class="table table-bordered" id="monitor_visits"style="margin-top: 13px !important">
            <thead>
                <tr>
                    <th>#S.No</th>
                    <th>Activity.#</th>
                    <th>QB Met</th>
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
</div>
