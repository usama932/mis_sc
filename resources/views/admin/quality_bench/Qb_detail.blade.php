<x-default-layout>
    @section('title')
        Monitoring Visits Detail ({{$qb->assement_code ?? ''}})
    @endsection
    <style>
        .accordion-button {
            background-color: #f2a900;
            color: white;
            border: none;
            border-radius: 0.25rem;
            padding: 1rem;
            margin-bottom: 0.5rem;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .accordion-button:hover {
            background-color: #f2a900;
        }

        .accordion-button:not(.collapsed) {
            background-color: #f2a900;
        }

        .accordion-item {
            border: 1px solid transparent;
            border-radius: 0.25rem;
            overflow: hidden;
            margin-top: 20px;
        }

        .accordion-button.collapsed {
            background-color: #f2a900;
        }

        .accordion-button.collapsed:hover {
            background-color: #f2a900;
        }

        .accordion-button:focus {
            box-shadow: #f5e8c8;
        }

        .accordion-header {
            background-color: #f2f2f2;
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }

        .accordion-body {
            padding: 1rem;
        }

        .accordion-body > .row {
            margin-bottom: 20px;
        }

        .separator {
            border-bottom: 2px solid #ddd;
            margin: 20px 0;
        }

        .card-title {
            background-color: #f2a900;
            border-radius: 0.25rem;
            padding: 1rem;
            margin-bottom: 20px;
        }

        .card-title h5 {
            font-weight: bold;
            color: white;
            margin: 0;
        }

        .card-content {
            padding: 20px;
            background-color: #f3f2ee;
            border-radius: 0.25rem;
            margin-bottom: 20px;
        }

        .btn-edit {
            margin-bottom: 20px;
        }
    </style>

    <div class="card-content">
        <!-- Edit Button Section -->
        @can('edit quality benchmarks')
        <div class="text-end btn-edit">
            <a href="{{ route('quality-benchs.edit',$qb->id)}}" class="btn btn-primary btn-sm" target="_blank">Edit Monitoring Visit</a>
        </div>
        @endcan

        <div class="card-title">
            <h5 class="fw-bold m-0">Summary</h5>
        </div>

        <table class="table  table-striped mx-3">
            
            <tr class="m-2">
                <td class="fs-7"><strong>Project:</strong></td>
                <td class="fs-7">{{$qb->project->name ?? ''}}</td>

                <td class="fs-7"><strong>Project Type:</strong></td>
                <td class="fs-7">{{$qb->project_type}}</td>

                <td class="fs-7"><strong>Type of visit:</strong></td>
                <td class="fs-7">{{$qb->type_of_visit ?? ''}}</td>
            </tr>
            <tr>
            
                <td class="fs-7"><strong>Monitoring Type:</strong></td>
                <td class="fs-7">{{$qb->monitoring_type ?? ''}}</td>

                <td class="fs-7"><strong>Accompanied By:</strong></td>
                <td class="fs-7">{{$qb->accompanied_by ?? ''}}</td>

                <td class="fs-7"><strong>Partner:</strong></td>
                <td class="fs-7">{{$qb->partners?->name ?? $qb->partner}}</td>

            </tr>
            
            <tr>
                <td class="fs-7"><strong>Province:</strong></td>
                <td class="fs-7">{{$qb->provinces?->province_name ?? ''}}</td>

                <td class="fs-7"><strong>District:</strong></td>
                <td class="fs-7">{{$qb->districts?->district_name ?? ''}}</td>

                <td class="fs-7"><strong>Tehsil:</strong></td>
                <td class="fs-7">{{$qb->tehsils?->tehsil_name ?? ''}}</td>
                
            </tr>
            <tr>
                <td class="fs-7"><strong>Village:</strong></td>
                <td class="fs-7">{{$qb->village}}</td>

                <td class="fs-7"><strong>Activity Visited:</strong></td>
                <td class="fs-7">{{$qb->activity_description ?? ''}}</td>

                <td class="fs-7"><strong>DIP Activity:</strong></td>
                <td class="fs-7">
                    @if($qb->dipactivity)
                        @foreach ($qb->dipactivity as $dipactivity)
                        <option value="{{ $dipactivity?->activity?->id }}" selected> {{ $dipactivity?->activity?->activity_number}} - {{ $dipactivity?->activity?->activity_title }}</option>
                        @endforeach
                    @endif
                </td>  
            </tr>
            <tr>
                <td class="fs-7"><strong>QB Base Monitoring</strong></td>
                <td class="fs-7"> 
                @if($qb->qb_base_monitoring == 1)
                   <span class="badge bg-success">Yes</span>
                @else
                    <span class="badge bg-light">No</span>
                @endif
                </td>

                <td class="fs-7"><strong>Total QBs:</strong></td>
                <td class="fs-7">{{$qb->total_qbs ?? '0'}}</td>

                <td class="fs-7"><strong>QBs Fully Met:</strong></td>
                <td class="fs-7">{{$qb->qbs_fully_met ?? ''}}</td>
            </tr>
            <tr>
                <td class="fs-7"><strong>QBs Not Applicable:</strong></td>
                <td class="fs-7">{{$qb->qb_not_applicable ?? ''}}</td>

                <td class="fs-7"><strong>QBs Not Fully Met:</strong></td>
                <td class="fs-7">{{$qb->qbs_not_fully_met ?? ''}}</td>

                <td class="fs-7"><strong>Score Out:</strong></td>
                <td class="fs-7">{{$qb->score_out ?? ''}}</td>

                <td></td>
            </tr>
            <tr>
                <td class="fs-7"><strong>Staff Organization:</strong></td>
                <td class="fs-7">{{$qb->staff_organization ?? ""}}</td>
                <td class="fs-7"><strong>QB Filled By:</strong></td>
                <td class="fs-7">{{$qb->qb_filledby ?? ""}}</td>
                <td class="fs-7"><strong>Date Visit:</strong></td>
                <td class="fs-7">{{ date('M d, Y', strtotime($qb->date_visit)) ?? ''}}</td>
            </tr>
            
        </table>
        
        <div class="accordion" id="actionPointsAccordion">
            @foreach($qb->action_point->sortBy('monitor_visits_id') as $action_point)
                <div class="accordion-item">
                    <div class="accordion-header" id="heading{{$loop->index}}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->index}}" aria-expanded="false" aria-controls="collapse{{$loop->index}}">
                            <div class="row">
                                <div class="col-md-9">
                                    ({{$loop->iteration }}/{{$loop->count}})&nbsp;&nbsp;&nbsp;{{ $action_point->monitor_visit->gap_issue ?? ''}}
                                </div>
                                <div class="col-md-3  text-end">
                                    @if($action_point->status == 'Acheived')
                                    <span class="text-end badge badge-success">{{$action_point->status}}</span>
                                    @elseif($action_point->status == 'To be Acheived')
                                        <span class=" text-end badge badge-primary">{{$action_point->status}}</span>
                                    @elseif($action_point->status == 'Not Acheived')
                                        <span class="text-end badge badge-danger">{{$action_point->status}}</span>
                                    @else
                                        <span class=" text-end badge badge-secondary">{{$action_point->status}}</span>
                                    @endif
                                </div>
                            </div>
                        </button>
                    </div>
                    <div id="collapse{{$loop->index}}" class="accordion-collapse collapse show" aria-labelledby="heading{{$loop->index}}" data-bs-parent="#actionPointsAccordion">
                        <div class="accordion-body">
                            <!-- Action Point Detail Content -->
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <td><strong>QB No:</strong></td>
                                    @if($action_point->monitor_visit->activity_type == "act")
                                        <td>.# {{$action_point->monitor_visit->activity_number ?? ""}}  </td>
                                    @else
                                        <td>General Observation</td>
                                    @endif
                                </div>

                                <div class="col-md-12 mt-3">
                                    <td><strong>QB :</strong> </td>
                                    <td>{{$action_point->monitor_visit->qbs_description ?? ""}}</td>
                                </div>
                                
                                <div class="col-md-12 mt-3">
                                    <td><strong>Debrief Note:</strong></td>
                                        <td> {{$action_point->db_note ?? ""}}</td>
                                </div>

                                <div class="col-md-12 col-sm-6 mt-5"> 
                                    <td><strong>Actions to make QBs fully met based on recommendations</strong></td>
                                    <td>{{$action_point->qb_recommendation ?? " "}}</td>
                                </div>

                                <div class="col-md-4 col-sm-3 mt-5"> 
                                    <td><strong>Action point Agreed (Yes/No)</strong></td>
                                    <td>{{$action_point->action_agree ?? " "}}</td>
                                </div>

                                @if($action_point->action_agree == "Yes")
                                    <div class="col-md-4 col-sm-3 mt-5"> 
                                        <td><strong>Action Type</strong></td>
                                        <td>{{$action_point->action_type ?? " "}}</td>
                                    </div>
                                    <div class="col-md-4 col-sm-3 mt-5"> 
                                        <td class="fs-7"><strong>Responsible Person </strong></td>
                                        <td  class="fs-7">{{$action_point->responsible_person ?? " "}}</td>
                                    </div> 
                                    <div class="col-md-2 col-sm-3 mt-5"> 
                                        <td class="fs-7"><strong>Deadline  </strong></td>
                                        @if(!empty($action_point->deadline) && $action_point->deadline == Null)
                                        <td class="fs-7">{{date('M d, Y', strtotime($action_point->deadline ?? " ")) }}</td>
                                        @endif
                                    </div>
                                    <div class="col-md-2 col-sm-3 mt-5"> 
                                        <td class="fs-7"><strong>Completion Date  </strong></td>
                                        @if(!empty($action_point->action_achiev?->completion_date) && $action_point->action_achiev?->completion_date == Null)
                                            <td class="fs-7">{{date('M d, Y', strtotime($action_point->action_achiev?->completion_date ?? " ")) }}</td>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-3 mt-5"> 
                                        <td><strong>Completion Note  </strong></td>
                                        <td>{{$action_point->action_achiev?->comments ?? " " }}</td>
                                    </div>
                                @endif

                                <div class="separator border-2 "></div>

                                <div class="col-md-3 col-sm-3 mt-5"> 
                                    <td><strong>Created By  </strong></td>
                                    <td>{{$action_point->user?->name ?? " "}}</td>
                                </div>
                                
                                <div class="col-md-3 col-sm-3 mt-5"> 
                                    <td><strong>Created At  </strong></td>
                                    <td class="fs-8">{{date('M d, Y H:i:s', strtotime($action_point->created_at ?? " ")) }}</td>
                                </div>

                                <div class="col-md-3 col-sm-3 mt-5"> 
                                    <td><strong>Updated By  </strong></td>
                                    <td>{{$action_point->user1?->name ?? " "}}</td>
                                </div>

                                <div class="col-md-3 col-sm-3 mt-5"> 
                                    <td><strong>Updated At  </strong></td>
                                    <td>{{date('M d, Y H:i:s', strtotime($action_point->updated_at ?? " ")) }}</td>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card-title m-">
            <h5 class="fw-bold ">Attachment & Comments</h5>
        </div>
        @if(!empty($qb->qbattachement))
            <table  class="table  table-striped mx-3"   >
                <tr class="m-2 ">
                    <td class="fs-7"><strong>Attachement:</strong></td>
                    <td class="fs-7"><a class="btn btn-primary btn-sm mx-15" href="{{ route('showPDF.qb_attachments', $qb->qbattachement?->id)}}" target="_blank">View Attachment</a></td>
                </tr>
                <tr class="mt-4">
                    <td class="fs-7"><strong>Comments:</strong></td>
                    <td class="fs-7">{{$qb->qbattachement?->comments ?? ''}}</td>
                </tr>
            </table>
        @endif
    </div>
   
</x-default-layout>
