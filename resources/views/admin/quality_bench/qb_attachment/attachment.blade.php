<div>
    <form class="form" id="qb_attachment_form"  novalidate="novalidate" action="{{route('attachments.store')}}" method="post" enctype="multipart/form-data">
        
        @csrf
        <input type="hidden" name="quality_bench_id" value="{{$qb->id}}">
        <div class="card-body py-4">
            <div class="card-title  border-0 my-4"">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                        <h5 class="fw-bold m-3">Attachments::</h5>
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
                <div class="fv-row col-md-6 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Upload Documents</span>
                    </label>
                    <input type="file"  @error('documents') is-invalid @enderror name="document" class="form-control" value="" required>
                
                    @error('documents')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="fv-row col-md-12 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Comments</span>
                    </label>
                    <textarea   @error('comments') is-invalid @enderror class="form-control " placeholder="How does the score from this visit compare to previous visits? Have any of these QBs been “not fully met” for two or more visits?"  name="comments" / required></textarea>
                
                    @error('comments')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
             
               
            </div>
        
        
            </div>
            <div class="text-center pt-15">
                <button type="submit" id="kt_attachment_submit" class="btn btn-primary">
                    @include('partials/general/_button-indicator', ['label' => 'Submit'])
                </button>
                
            </div>
        </div>
    </form>
    <div class="table-responsive overflow-*">
        <table class="table table-bordered" id="qbattachments"style="margin-top: 13px !important">
        <thead>
            <tr>
                <th>#S.No</th>
                <th>Comments</th>
                <th>Attachments</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>
     
        </table>
       
    </div>
    <div class="modal fade" id="view_qbattachment" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="view_monitor_visit">Attachment Details</h4>
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