<x-default-layout>
    @section('title')
        <div class="d-flex">
            <div class="justify-content-start">
            View Feedback Registry 
            </div>
        <div class="" style="margin-left: 150px !important;  margin-right: 0 !important;">
            <h3>Respons Id.# :: {{$frm->response_id ?? ''}}  
            @if($frm->status == "Close")
                <span class="badge badge-success">{{$frm->status}}</span>
            @else
                <span class="badge badge-warning">{{$frm->status}}</span>
            @endif</h3>
        </div>
        
        </div>
        
    @endsection

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
                        <td>{{$frm->theme_name->name ?? "NA"}}</td>
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
                        <td>{{ date('d-M-Y', strtotime($frm->date_of_respbackgiven)) ?? ''}}</td>
                    </tr>
                    {{-- <tr>
                        <td><strong>Response Summary</strong></td>
                        <td>{{$frm->response_summary ?? ''}}</td>
                    </tr> --}}
                    <tr>
                        <td><strong>Closing the loop (Days)</strong></td>
                        <td>@if(!empty($frm->date_received))
                            {{round((strtotime($frm->date_of_respbackgiven) -  strtotime($frm->date_received) )/ 86400)  ?? ''}}
                            @else NA @endif
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
    @push('scripts')
   
    @endpush
</x-default-layout>
