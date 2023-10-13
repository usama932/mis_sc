<div>
    <form class="form" action="{{route('quality-benchs.update',$qb->id)}}" method="post">
        @csrf
        @method('put')
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
                <div class="col-md-6 mt-3">
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
                <div class="col-md-12 mt-3">
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
                <a href="{{route('quality-benchs.index')}}" class="btn btn-light me-3" >Discard</a>
                <button type="submit" class="btn btn-primary" >
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>