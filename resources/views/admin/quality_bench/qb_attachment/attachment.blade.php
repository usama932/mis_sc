<div>
    <div class="">
        
    </div>
    <form class="form p-5" id="qb_attachment_form"  novalidate="novalidate" action="{{route('attachments.store')}}" method="post" enctype="multipart/form-data">
        
        @csrf
        <input type="hidden" name="quality_bench_id" value="{{$qb->id}}">
        <div class="card-body py-4">
            <div class="row">
                <input type="hidden" value="{{$qb_attachment->id ?? ''}}" name="id" >
                <input type="hidden" name="submit" value="0">
                <div class="fv-row col-md-12 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="">Comments</span>
                    </label>
                    <textarea class="form-control " placeholder="How does the score from this visit compare to previous visits? Have any of these QBs been “not fully met” for two or more visits?" row="2"  name="comments" / required>{{$qb_attachment->comments ?? ''}}</textarea>
                </div>
                <div class="fv-row col-md-12 mt-3">
                    @if(!empty($qb_attachment->document) && $qb_attachment->document != '')
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">ReUpload Attachment</span>
                        </label>
                    @else
                        <label class="fs-6 fw-semibold form-label mb-2 ">
                            <span class="required">Upload Attachment</span>
                        </label>
                    @endif
                    <div class="input-group">
                     
                        
                        @if(!empty($qb_attachment->document) && $qb_attachment->document != '')
                        <input type="file" name="document" class="form-control mx-4" value="{{$qb_attachment->document}}" accept=".pdf">
                            <div class="input-group-append">
                                <a class="btn  btn-danger" title="Download Attachment" href="{{ route('showPDF.qb_attachments', $qb_attachment->id) }}" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                                        <!-- SVG path code -->
                                    </svg> Download Attachment
                                </a>
                            </div>
                        @else
                        <input type="file" name="document" class="form-control mx-4" value="">
                        @endif
                    </div>          
                </div>     
            </div>
        
        
            </div>
            <div class="d-flex justify-content-end pt-5">
                <button type="submit"  class="btn btn-success btn-sm kt_attachment_submit">
                  
                    @include('partials/general/_button-indicator', ['label' => 'Save As Draft'])
                </button>
              
                <button type="submit" class="btn btn-primary btn-sm mx-3 kt_attachment_submit">
                 
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