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
        tr {
            padding-left: 20px; /* Adjust as needed */
            padding-right:20px; /* Adjust as needed */
        }

   </style>


    <div class="card">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h2><i class="fa-solid fa-info-circle mx-4"></i>QB Detail</h2>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card-header border-0 pt-6">
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <table class="table table-striped m-4 p-4">
                                            <tr>
                                                <td class="fs-8"><strong>Unique Code #</strong></td>
                                                <td  class="fs-8">{{$action_point->qb?->assement_code ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <td  class="fs-8"><strong>Project</strong></td>
                                                <td  class="fs-8">{{$action_point->qb?->project?->name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <td class="fs-7"><strong>Province:</strong></td>
                                                <td class="fs-7">{{$action_point->qb?->provinces?->province_name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <td class="fs-7"><strong>District:</strong></td>
                                                <td class="fs-7">{{$action_point->qb?->districts?->district_name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <td class="fs-7"><strong>Tehsil:</strong></td>
                                                <td class="fs-7">{{$action_point->qb?->tehsils?->tehsil_name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <td  class="fs-8"><strong>Action Type</strong></td>
                                                <td  class="fs-8">{{$action_point->action_type ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <td  class="fs-8"><strong>Responsible Person</strong></td>
                                                <td  class="fs-8">{{$action_point->responsible_person ?? ''}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td  class="fs-8"><strong>Created By</strong></td>
                                                <td  class="fs-8">{{$action_point->user->name ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <td  class="fs-8"><strong>Created At</strong></td>
                                                <td  class="fs-8">{{date('M d, Y', strtotime($action_point->created_at)) ?? ''}}</td>
                                            </tr>
                                        
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-striped m-4 p-4">
                                            <tr>
                                                <td class="fs-8"><strong>QB Description</strong></td>
                                                <td  class="fs-8">{{$action_point->monitor_visit?->qbs_description ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <td  class="fs-8"><strong>Gap/Issue</strong></td>
                                                <td  class="fs-8">{{$action_point->monitor_visit?->gap_issue ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <td  class="fs-8"><strong>Debrief Note</strong></td>
                                                <td  class="fs-8">{{$action_point->db_note ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <td  class="fs-8"><strong>Action Point</strong></td>
                                                <td  class="fs-8">{{$action_point->qb_recommendation ?? ''}}</td>
                                            </tr>
                                           
                                            <tr>
                                                <td> <strong>Deadline</strong></td>
                                                <td>{{date('M d, Y', strtotime($action_point->deadline)) ?? ''}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
