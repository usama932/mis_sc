<div>
    <form class="form" action="{{route('quality-benchs.update',$qb->id)}}" method="post">
        @csrf
        @method('put')
        <div class="card-body py-4">
            <div class="card-title  border-0 my-4"">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                        <h5 class="fw-bold m-3">Detail of Monitoring Visits::</h5>
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
                    <input type="text"  @error('activity_number') is-invalid @enderror name="activity_number"  placeholder="Enter Activity Number"  class="form-control"   value="" required>
                
                    @error('activity_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-8 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Quality Benchmarks (QBs)</span>
                    </label>
                    <textarea   @error('qbs_description') is-invalid @enderror class="form-control "  name="qbs_description" / required></textarea>
                    
                    @error('qbs_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">QB Met</span>
                    </label>
                    <select   name="Qb_met"  @error('gender') is-invalid @enderror aria-label="Select a QB Met" data-control="select2" data-placeholder="Select a QB Met..." class="form-select form-select-solid qb_id" required>
                        <option value="">Select QB Met</option>
                        <option  value="Not Fully Met">Not Fully Met</option>
                        <option  value="Fully Met">Fully Met</option>
                    </select>
                    @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-3" id="gap_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Gap/issue (if not fully met)</span>
                    </label>
                    <textarea   @error('gap_issue') is-invalid @enderror class="form-control "  name="gap_issue" / required></textarea>
                    
                    @error('gap_issue')
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
                    <h5 class="fw-bold m-3">Quality Bench Monitoring Visits::</h5>
                </div>
            </div>
        </div>
        <div class="table-responsive overflow-*">
            <table class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>#S.No</th>
                    <th>Key Finding.#</th>
                    <th>Key Findings</th>
                    <th>Category</th>
                    <th>Recommendations</th>
                    <th>Actions</th>
                
                </tr>
            </thead>
            </table>
        </div>

    </div>
</div>