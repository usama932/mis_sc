<x-nform-layout>
    @section('title')
        Update Action Point Status
    @endsection
    <style>
        .error-message {
           color: red;
           font-size: 12px;
           margin-top: 5px;
       }

   </style>

    <div class="card">
    
        <div class="card">
            <form class="form p-5" novalidate="novalidate" id="updateactionpointstatus" action="{{route('postupdate_actionpoint',$action_point->id)}}" method="post">  
                @csrf
             
                <input type="hidden" name="action_point_id" value="{{$action_point->monitor_visits_id}}">
                <input type="hidden" name="qb_id" id="qb_id" value="{{$action_point->quality_bench_id}}">
                <div class="card-body ">
                    <div class="card-title  border-0 my-1"">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                <h5 class="fw-bold m-3">Update Action Point Status</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="fv-row col-md-6 mt-3 action_agree_id">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Status</span>
                            </label>
                            <select name="status" id="status" aria-label="Select a Status" data-control="select2" data-placeholder="Select Status" class="form-select">
                                <option value=''>Select Status</option>
                                <option  value="Partialy Acheived" @if($action_point->status == "Partialy Acheived") selected @endif>Partialy Acheived</option>
                                <option  value="Acheived"  @if($action_point->status == "Acheived") selected @endif>Acheived</option>
                                <option  value="Not Acheived"  @if($action_point->status == "Acheived") selected @endif>Not Acheived</option>   
                            </select>
                            @error('status')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="fv-row col-md-6 mt-3 action_agree_id">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Completion Date</span>
                            </label>
                            <input type="text" name="completion_date" id="completion_date" placeholder="Select Completion Date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker">
                            @error('completion_date')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="fv-row col-md-12 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Completion Note</span>
                            </label>
                            <textarea  class="form-control " rows="1" name="comments" id="comments"></textarea>
                            @error('comments')
                            <div class="error text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                     
                    </div>
                
                
                    </div>
                    <div class="d-flex justify-content-end p-5">
                        <button type="submit" id="kt_updateactionpointstatus" class="btn btn-primary btn-sm ">
                            @include('partials/general/_button-indicator', ['label' => 'Update Action Point'])
                        </button>
                    </div>
                </div>
            
            </form>
        </div>
        
    </div>
    @push('scripts')
        <script>
              $('#completion_date').flatpickr({
                altInput: true,
                dateFormat: "Y-m-d",
                minDate: new Date().fp_incr(-90),
                maxDate: new Date().fp_incr(+30), 
            });
        </script>

    @endpush

</x-nform-layout>
