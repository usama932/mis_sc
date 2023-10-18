<x-default-layout>
    @section('title')
        View Feedback Registry
    @endsection
    <div class="card">
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
                        <td>{{$frm->provinces->province_name ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td>{{$frm->districts->district_name ?? 'NA'}}</td>
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
                        <td>{{$frm->client_contact ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback Description</strong></td>
                        <td>{{$frm->feedback_description}}</td>
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
                        <td class="mx-auto">{{$frm->feedback_referredorshared ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Refferal Name</strong></td>
                        <td class="mx-auto">{{$frm->referral_name ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Refferal Postion</strong></td>
                        <td>{{$frm->referral_position ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Refferal Date</strong></td>
                        
                        <td>@if(!empty($frm->date_ofreferral))
                            {{date('d-M-Y', strtotime($frm->date_ofreferral))  ?? 'NA'}} @else NA @endif</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback Summary</strong></td>
                        <td>{{$frm->feedback_summary ?? 'NA'}}</td>
                    </tr>
                 
                </table>
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">FeedbackDetails::</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped mr-3">
                    <tr>
                        <td><strong>Date of Response Given Back</strong></td>
                        <td>{{ date('d-M-Y', strtotime($frm->date_of_respbackgiven)) ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Response Summary</strong></td>
                        <td>{{$frm->response_summary ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Number of Day back to response</strong></td>
                        <td>@if(!empty($frm->date_received))
                            {{round((strtotime($frm->date_of_respbackgiven) -  strtotime($frm->date_received) )/ 86400)  ?? 'NA'}}
                            @else NA @endif
                        </td>
                    </tr>
                    <tr>
                        <td ><strong>Status</strong></td>
                        <td class="mx-auto">{{$frm->status ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Satisfiction</strong></td>
                        <td>{{$frm->type_ofaction_taken ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Created By</strong></td>
                        <td>{{$frm->user->name ?? 'NA'}}</td>
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
                <table class="table table-striped mr-3">
                    <thead>
                        <th>
                            S.No#
                        </th>
                        <th>
                            Follow-up date
                        </th>
                        <th>
                            Feedback Response
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($responses as $response)
                            <tr>
                                <td class="mx-auto">{{$loop->index + 1}}</td>
                                <td class="mx-auto">{{$response->follow_up_date }}</td>
                                <td class="mx-auto">{{$response->response_summary ?? "NA" }}</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
                @endif
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
                        <td>{{$frm->user->name ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Created At</strong></td>
                        <td>{{date('d-M-Y', strtotime($frm->created_at)) ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated By</strong></td>
                        <td>{{$frm->user1->name ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated At</strong></td>
                        <td>{{$frm->updated_at ?? 'NA'}}</td>
                    </tr>
                </table>
            </div>


        </div>
    </div>
</x-default-layout>
