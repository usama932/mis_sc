<div>
    <form class="form" id="qb_attachment_form"  novalidate="novalidate" action="{{route('attachments.store')}}" method="post" enctype="multipart/form-data">
        
        @csrf
        <input type="hidden" name="quality_bench_id" value="{{$qb->id}}">
        <div class="card-body py-4">
            <div class="row">
                
                <div class="fv-row col-md-6 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">General Observations by field monitor</span>
                    </label>
                    <textarea class="form-control " placeholder="General Observations by field monitor" row="2"  name="generating_observation"></textarea>
                </div>
                <div class="fv-row col-md-6 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Comments</span>
                    </label>
                    <textarea class="form-control " placeholder="How does the score from this visit compare to previous visits? Have any of these QBs been “not fully met” for two or more visits?" row="2"  name="comments" / required></textarea>
                </div>
                <div class="fv-row col-md-12 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Upload Attachment</span>
                    </label>
                    <input type="file"  @error('documents') is-invalid @enderror name="document" class="form-control" value="" required>
                
                    @error('documents')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
               
               
             
               
            </div>
        
        
            </div>
            <div class="d-flex justify-content-end pt-5">
                <button type="button" id="" class="btn btn-primary">
                    @include('partials/general/_button-indicator', ['label' => 'Save As Draft'])
                </button>
                <button type="submit" id="kt_attachment_submit" class="btn btn-primary">
                    @include('partials/general/_button-indicator', ['label' => 'Submit'])
                </button>
                
            </div>
        </div>
    </form>
    {{-- <div class="table-responsive overflow-*">
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
    </div> --}}
</div>