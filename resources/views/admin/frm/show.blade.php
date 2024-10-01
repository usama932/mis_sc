<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<x-default-layout>
    @section('title')
    View Feedback/Complaint
    @endsection
        <div class=" d-flex justify-content-end">
            @if (!empty($tagged))
                <h6>Tags By SC Advisor <i class="fa fa-tag"></i> :</h6>
                @foreach ($tagged as $tag)
                    <span  class="badge badge-danger mx-1 mb-1">
                        {{ $tag }} 
                    </span>
                @endforeach
            @endif
            
        </div>
        <div class=" d-flex justify-content-center">
            <h3>Respons Id.# :: {{$frm->response_id ?? ''}}  
            @if($frm->status == "Close")
                <span class="badge badge-success">{{$frm->status}}</span>
            @else
                <span class="badge badge-warning">{{$frm->status}}</span>
            @endif</h3>
        </div>
       
        @can('frm tag')
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#exampleModal">
                    Add Tag
                </button>
            </div>
        @endcan
      
    <div class="card p-2">
        <div class="row">
            <div class="col-md-6">
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Information Receiver::</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">

                    <tr>
                        <td ><strong>Name of Registrar</strong></td>
                        <td>{{$frm->name_of_registrar}}</td>
                    </tr>
                    <tr>
                        <td><strong>Date Received</strong></td>
                        <td>{{date('d-M-Y', strtotime($frm->date_received))}}</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback Channel</strong></td>
                        <td>{{$frm->channel?->name ?? "NA"}}</td>
                    </tr>
                </table>
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Client Details::</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">

                    <tr>
                        <td><strong>Name of Client</strong></td>
                        <td>{{$frm->name_of_client}}</td>
                    </tr>
                    <tr>
                        <td><strong>Type of Client</strong></td>
                        <td>{{$frm->type_of_client}}</td>
                    </tr>
                    <tr>
                        <td><strong>Gender</strong></td>
                        <td>{{$frm->gender }}</td>
                    </tr>
                    <tr>
                        <td><strong>Age</strong></td>
                        <td>{{$frm->age}}</td>
                    </tr>
                    <tr>
                        <td><strong>Province</strong></td>
                        <td>{{$frm->provinces->province_name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td>{{$frm->districts->district_name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Tehsil</strong></td>
                        <td>{{$frm->tehsils->tehsil_name ?? $frm->tehsil}}</td>
                    </tr>
                    <tr>
                        <td><strong>Union Council</strong></td>
                        <td>{{$frm->uc->uc_name ?? $frm->union_counsil}}</td>
                    </tr>
                    <tr>
                        <td><strong>Village</strong></td>
                        <td>{{$frm->village}}</td>
                    </tr>
                    <tr>
                        <td><strong>Allow Contact</strong></td>
                        <td>{{$frm->allow_contact}}</td>
                    </tr>
                    <tr>
                        <td><strong>Contact Number</strong></td>
                        <td>{{$frm->client_contact ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback Description</strong></td>
                        <td>{{$frm->feedback_description ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback Category</strong></td>
                        <td>{{$frm->category->name ?? ''}}-{{$frm->category->description ?? ''}}</td>
                    </tr>
                    @if($frm->datix_number)
                        <tr>
                            <td><strong>Datix Number</strong></td>
                            <td>{{$frm->datix_number}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td><strong>Theme</strong></td>
                        <td>{{$frm->theme_name->name ?? ""}}</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback Activity</strong></td>
                        <td>{{$frm->feedback_activity}}</td>
                    </tr>
                    <tr>
                        <td><strong>Project Name</strong></td>
                        <td>{{$frm->project->name ?? "NA"}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Feedback Refferal Details::</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped mr-3">
                    <tr>
                        <td ><strong>Feedback Reffered Share (Yes/No)</strong></td>
                        <td class="mx-auto">{{$frm->feedback_referredorshared ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Refferal Name</strong></td>
                        <td class="mx-auto">{{$frm->referral_name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Refferal Postion</strong></td>
                        <td>{{$frm->referral_position ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Refferal Date</strong></td>
                        
                        <td>@if(!empty($frm->date_ofreferral))
                            {{date('d-M-Y', strtotime($frm->date_ofreferral))  ?? ''}} @else NA @endif</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback Summary</strong></td>
                        <td>{{$frm->feedback_summary ?? ''}}</td>
                    </tr>
                 
                </table>
               
                @if($responses->count() > 0)
                    <div class="card-title  border-0 my-4"">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                <h5 class="fw-bold m-3">Feedback Responses::</h5>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm mr-3">
                        <tr>
                            <th>
                                <strong>Feedback Response</strong>
                            </th>
                            <th>
                                <strong>Status</strong>
                            </th>
                            <th>
                                <strong>Follow-up date</strong>
                            </th>
                           
                        
                        </tr>
                        @foreach($responses as $response)
                            <tr>
                                <td>{{$response->response_summary ?? "--" }}</td>
                                <td>{{$response->status }}</td>
                                <td>@if($response->status == 'Open')
                                     {{date('d-M-Y', strtotime($response->follow_up_date)) }}
                                    @else

                                    @endif
                                </td>
                               
                            </tr>
                        @endforeach
                    </table>
                @endif
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">FeedbackDetails::</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped mr-3">
                    <tr>
                        <td><strong>Closed Date</strong></td>
                        <td>@if($frm->status == "Close" && $frm->date_of_respbackgiven  !== null ) {{ date('d-M-Y', strtotime($frm->date_of_respbackgiven)) ?? ''}} @else @endif</td>
                    </tr>
                    {{-- <tr>
                        <td><strong>Response Summary</strong></td>
                        <td>{{$frm->response_summary ?? ''}}</td>
                    </tr> --}}
                    <tr>
                        <td><strong>Closing the loop (Days)</strong></td>
                        <td>@php
                            if($frm->status == "Close" && $frm->date_of_respbackgiven  !== null )
                            {  
                                $dayss = round((strtotime($frm->date_of_respbackgiven) -  strtotime($frm->date_received) )/ 86400)  ?? '';
                                echo $dayss;
                              
                            }
                            else{           
                                $dayss =  (strtotime(date("Y-m-d")) - strtotime($frm->date_received)) / 86400;
                                echo $dayss;
                            }
                            @endphp
                           
                        </td>
                    </tr>
                   
                    <tr>
                        <td><strong>Satisfaction</strong></td>
                        <td>{{$frm->type_ofaction_taken ?? ''}}</td>
                    </tr>
                 
                    
                </table>
            
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Record Details::</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped mr-3">
                  
                    <tr>
                        <td><strong>Created By</strong></td>
                        <td>{{$frm->user->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Created At</strong></td>
                        <td>{{date('d-M-Y', strtotime($frm->created_at)) ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated By</strong></td>
                        <td>{{$frm->user1->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated At</strong></td>
                        <td>{{$frm->updated_at ?? ''}}</td>
                    </tr>
                </table>
            </div>


        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="add-tag" method="post" action="{{ route('add-frmTag') }}">
                        @csrf
                        <div class="fv-row col-md-12 form-group" id="ta-field">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Thematic Area</span>
                            </label>
                            <input type="hidden" value="{{ $frm->id  }}" name="frm_id">
                            <select name="tags[]" id="tags" class="form-select" aria-label="Select Tag" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple required>
                                <option value="">Select Thematic Area</option>
                                <option value="Unsafe Programming" @if($tagged) @if(in_array('Unsafe Programming', $tagged)) selected @endif @endif>Unsafe Programming</option>
                                <option value="Report to Datix"  @if($tagged) @if(in_array('Report to Datix', $tagged)) selected @endif @endif>Report to Datix</option>
                            </select>
                            <div id="tagsError" class="error-message "></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary  btn-sm"  id="frm_form_btn">Submit</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
{{-- @push('script')
<script>
    $(document).ready(function() {
        $("#frm_form_btn").click(function(e){
            alert('asda');
            e.preventDefault();
            let form = $('#add-tag')[0];
            let data = new FormData(form);
        
            $.ajax({
                url: "{{ route('add-frmTag') }}",
                type: "POST",
                data : data,
                dataType:"JSON",
            
                success: function(response) {
    
                if (response.errors) 
                {
                var errorMsg = '';
                $.each(response.errors, function(field, errors) {
                    $.each(errors, function(index, error) {
                        errorMsg += error + '<br>';
                    });
                });
                iziToast.error({
                    message: errorMsg,
                    position: 'topRight'
                });
                
                }
                else {
                iziToast.success({
                    message: response.success,
                    position: 'topRight'
                    
                });
                }
                        
                },
                error: function(xhr, status, error) {
                    let errorMsg = 'An error occurred.';
                    if (xhr.status === 0) {
                        errorMsg = 'A network error occurred.';
                    } else if (xhr.status === 419) { // CSRF token mismatch (example)
                        errorMsg = 'The form submission failed due to a security issue. Please refresh the page and try again.';
                    } else {
                        errorMsg = 'Server error encountered. Please try again later.';
                    }
                    iziToast.error({
                        message: errorMsg,
                        position: 'topRight'
                    });
                }
        
            });
        
        })
    });
</script>
@endpush --}}
</x-default-layout>
