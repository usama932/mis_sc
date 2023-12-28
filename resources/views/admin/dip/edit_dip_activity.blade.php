<form action="{{route('activity_dips.update',$dip->id)}}" method="post" id="creat_dip_activity">
    @csrf
    @method('put')
    <div class="modal-body">
            <div class="row">
            
                <div class="fv-row col-md-3 ">
                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                        <span class="required">Activity Number</span>
                    </label>
                    <input type="text" name="activity_number" id="activity_number"  class="form-control" value="{{$dip->activity_number}}">
                    <div id="pactivity_numberError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-9">
                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                        <span class="required">Activity Detail</span>
                    </label>
                    <textarea name="detail" id="detail" rows="1" class="form-control">{{$dip->detail}}</textarea>
                    <div id="detailError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-4 mt-2">
                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                        <span class="required">Start Date</span>
                    </label>
                    <input type="text" name="start_date" id="start_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="{{$dip->start_date}}">
                    <div id="start_dateError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-4 mt-2">
                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                        <span class="required"> End Date</span>
                    </label>
                    <input type="text" name="end_date" id="end_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="{{$dip->end_date}}">
                    <div id="end_dateError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-4 mt-2">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Status</span>
                    </label>
                    <select   name="status" id="status" aria-label="Select Status" data-control="select2" data-placeholder="Select Status" class="form-select"  data-allow-clear="true" >
                    
                            <option value="" selected>Select Status</option>
                            <option value="Initiative" @if($dip->status == "Initiative") selected @endif >Intiative</option>
                            <option value="Not Started" @if($dip->status == "Not Started") selected @endif >Not Started</option>
                            <option value="In-Process" @if($dip->status == "In-Process") selected @endif >In-Process</option>
                            <option value="Completed" @if($dip->status == "Completed") selected @endif >Completed</option>
                    
                    </select>
                    <div id="statusError" class="error-message "></div>
                </div>   
            
            
            </div>       
    </div>
    <div class="modal-footer">
        <button type="submit" id="kt_create_dip_activity" class="btn btn-success btn-sm 5">        
            @include('partials/general/_button-indicator', ['label' => 'Update'])
        </button>
        <button type="button" class="btn btn-secondary btn-sm  edit_close" data-dismiss="modal">Close</button>
    </div>
</form>