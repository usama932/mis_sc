<div>
    <form class="form" action="{{route('quality-benchs.update',$qb->id)}}" method="post">
        @csrf
        @method('put')
        <div class="card-body py-4">
            <div class="card-title  border-0 my-4"">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                        <h5 class="fw-bold m-3">Action Points Detail::</h5>
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
                        <span class="required">Debrief Notes against identify Gap</span>
                    </label>
                    <textarea   @error('db_note') is-invalid @enderror class="form-control "  name="db_note" / required></textarea>
                    
                    @error('db_note')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mt-3">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Action Point Agree</span>
                    </label>
                    <select   name="action_agree"  @error('action_agree') is-invalid @enderror aria-label="Select a Action Point Agree" data-control="select2" data-placeholder="Select a Action Point Agree..." class="form-select form-select-solid agree_id" required>
                        <option value="">Select Action Point Agree</option>
                        <option  value="Yes">Yes</option>
                        <option  value="No">No</option>
                    </select>
                    @error('action_agree')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Actions to make QBs</span>
                    </label>
                    <textarea   @error('qb_recommendation') is-invalid @enderror class="form-control "  name="qb_recommendation" / required></textarea>
                    
                    @error('qb_recommendation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Action Type</span>
                    </label>
                   
                    <select   name="action_type"  @error('action_type') is-invalid @enderror aria-label="Select a Action Type" data-control="select2" data-placeholder="Select a Action Type..." class="form-select form-select-solid" required>
                        <option value="">Select Action Type</option>
                        <option  value="Administrative">Administrative</option>
                        <option  value="Technical">Technical</option>
                        <option  value="Both (Technical/Administrative)">Both (Technical/Administrative)</option>
                    </select>
                    @error('qb_recommendation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Who is responsible?</span>
                    </label>
                    <input class="form-control" @error('responsible_person') is-invalid @enderror placeholder="Enter Who is Responsible" name="responsible_person" value="" / required>
                 
                    @error('responsible_person')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mt-3 action_agree_id">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Deadline</span>
                    </label>
                    <input type="text"  @error('deadline') is-invalid @enderror name="deadline" id="deadline" placeholder="Select Deadline"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="" required>
                    @error('deadline')
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