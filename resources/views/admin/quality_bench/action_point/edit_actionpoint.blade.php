<x-nform-layout>
    @section('title')
        Edit Action Point Detail
    @endsection
    <style>
        .error-message {
           color: red;
           font-size: 12px;
           margin-top: 5px;
       }

   </style>

    <div class="card">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
      
        <div class="card">
            <form class="form p-5"  id="qb_action_point_form"  novalidate="novalidate" action="{{route('action_points.update',$action_point->id)}}" method="post">  
                @csrf
                @method("put")
                <input type="hidden" name="quality_bench_id" id="qb_id" value="{{$qb->id}}">
                <div class="card-body ">
                    <div class="card-title  border-0 my-1"">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                <h5 class="fw-bold m-3">Edit Action Point Detail</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      
                        <div class="fv-row col-md-8 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Debrief Notes against identify Gap</span>
                            </label>
                            <textarea class="form-control"  name="db_note" >{{$action_point->db_note ?? ''}}</textarea>
                        </div>
                        <div class="fv-row col-md-4 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Action Point Agree</span>
                            </label>
                            <select   name="action_agree" id="action_agree" @error('action_agree') is-invalid @enderror aria-label="Select a Action Point Agree" data-control="select2" data-placeholder="Select a Action Point Agree..." class="form-select  agree_id" required>
                             
                                @if($action_point->action_agree == "Yes")
                                    <option  value="Yes" @if($action_point->action_agree == "Yes") selected @endif>Yes</option>
                                @else
                                    <option value="">Select Action Point Agree</option>
                                    <option  value="Yes" @if($action_point->action_agree == "Yes") selected @endif>Yes</option>
                                    <option  value="No" @if($action_point->action_agree == "No") selected @endif>No</option>
                                @endif
                               
                            </select>
                        </div>
                        <div class="fv-row col-md-12 mt-3 action_agree_id">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Actions to make QB Fully Met</span>
                            </label>
                            <textarea  class="form-control "  name="qb_recommendation" id="qb_recommendation">{{$action_point->qb_recommendation ?? ''}}</textarea>
                        </div>
                        <div class="fv-row col-md-3 mt-3 action_agree_id">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Action Type</span>
                            </label>
                            <select   name="action_type" id="action_type" aria-label="Select a Action Type" data-control="select2" data-placeholder="Select a Action Type..." class="form-select">
                                <option value="">Select Action Type</option>
                                <option  value="Administrative"  @if($action_point->action_type == "Administrative") selected @endif>Administrative</option>
                                <option  value="Technical" @if($action_point->action_type == "Technical") selected @endif>Technical</option>
                                <option  value="Both (Technical/Administrative)" @if($action_point->action_type == "Both (Technical/Administrative)") selected @endif>Both (Technical/Administrative)</option>
                            </select>
                        </div>
                        <div class="fv-row col-md-3 mt-3 action_agree_id">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Who is responsible?</span>
                            </label>
                            <input class="form-control" placeholder="Enter Who is Responsible" name="responsible_person" id="responsible_person" value="{{$action_point->responsible_person ?? ''}}" >
                        </div>
                        <div class="fv-row col-md-3 mt-3 action_agree_id">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Status</span>
                            </label>
                            <select name="status" id="status" aria-label="Select a Status" data-control="select2" data-placeholder="Select Status" class="form-select" readonly>
                                <option value="">Select Status</option>
                                <option  value="To be Acheived" @if($action_point->status == "To be Acheived") selected @endif>To be Acheived</option>
                                <option  value="Partialy Acheived" @if($action_point->status == "Partialy Acheived") selected @endif>Partialy Acheived</option>
                                {{-- <option  value="Acheived" @if($action_point->status == "Acheived") selected @endif>Acheived</option>
                                <option  value="Not Acheived" @if($action_point->status == "Not Acheived") selected @endif>Not Acheived</option>    --}}
                            </select>
                        </div>
                        <div class="fv-row col-md-3 mt-3 action_agree_id deadline">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="">Deadline</span>
                            </label>
                            <input type="text"  @error('deadline') is-invalid @enderror name="deadline" id="deadline" placeholder="Select Deadline"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="{{date('Y-m-d', strtotime($action_point->deadline ?? ''))}} " >
                        </div>
                     
                    </div>
                
                
                    </div>
                    <div class="d-flex justify-content-end p-5">
                        <button type="submit" id="kt_action_point_submit" class="btn btn-primary btn-sm ">
                            @include('partials/general/_button-indicator', ['label' => 'Update Action Point'])
                        </button>
                    </div>
                </div>
            
            </form>
        </div>
        
    </div>
    @push('scripts')
        <script>
            $(document).ready(function(){
                $(".agree_id").change(function(){

                    $(this).find("option:selected").each(function(){
                        var optionValue = $(this).attr("value");

                        if(optionValue == "Yes"){
                            $('.action_agree_id').show();

                        }else if(optionValue == "No")
                        {
                            $('.action_agree_id').hide();
                        }
                        else{
                            $('.action_agree_id').hide();
                        }
                    });
                }).change();
                $("#status").change(function(){
                    
                    $(this).find("option:selected").each(function(){
                        
                        var optionValue = $(this).attr("value");

                        if(optionValue == "To be Acheived" || optionValue == "Partialy Acheived"){
                            $('.deadline').show();
                        }
                        else{
                            $('.deadline').hide();
                        }
                    });
                });
            });

            $('#deadline').flatpickr({
                altInput: true,
                dateFormat: "Y-m-d",
                minDate: new Date().fp_incr(-30),
                maxDate: new Date().fp_incr(+60), 
            });
        </script>

    @endpush

</x-nform-layout>
