<x-default-layout>
    @section('title')
        Monitoring Visits Detail ({{$qb->assement_code ?? ''}})
    @endsection
    <style>
        /* Custom styles for accordion */
        .accordion-button {
            background-color: #007bff; /* Change to your desired header background color */
            color: white; /* Change to your desired text color */
            text-emphasis: bold;
            border: none; /* Remove default border */
            border-radius: 0.25rem; /* Add border radius if desired */
            padding: 1rem; /* Adjust padding as needed */
            margin-bottom: 0.5rem; /* Add margin between accordion items */
        }

        .accordion-button:hover {
            background-color: #0056b3; /* Change to your desired hover background color */
        }
        .accordion-button:not(.collapsed) {
            font-weight: bold; /* Make text bold when accordion is expanded */
            color:white; /* Change text color to black when accordion is expanded */
            
        }
        .accordion-item {
        border: 1px solid transparent; /* Add transparent border to accordion item */
        border-radius: 0.25rem; /* Add border radius if desired */
        overflow: hidden; /* Hide overflowing content */
        }
        .accordion-item:not(.collapsed) {
            border-color: #000; /* Change border color when accordion is expanded */
        }
        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.5); /* Add focus effect */
        }

        .accordion-button.collapsed {
            background-color: #0056b3; /* Change to your desired collapsed background color */
        }

        .accordion-button.collapsed:hover {
            background-color: #00417a; /* Change to your desired collapsed hover background color */
        }
    </style>

    <div class="container">
        <div class="card p-3">
            <div class="row">
                <!-- Edit Button Section -->
                @can('edit quality benchmarks')
                <div class="col-md-12 text-right mb-3  justify-content-end d-flex">
                    <a href="{{ route('quality-benchs.edit',$qb->id)}}" class="btn btn-primary btn-sm" target="_blank">Edit Monitoring Visit</a>
                </div>
                @endcan

                <div class="col-md-12">
                    <div class="card-title border-0 my-4">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1  rounded p-3"  style="background-color: #F2A900;">
                                <h5 class="fw-bold m-0">Summary</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Basic Info Summary -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Project:</strong>
                                    <span>{{$qb->project->name ?? ''}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Project Type:</strong>
                                    <span>{{$qb->project_type}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Partner:</strong>
                                    <span>{{$qb->partner}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Province:</strong>
                                    <span>{{$qb->provinces?->province_name ?? ''}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>District:</strong>
                                    <span>{{$qb->districts?->district_name ?? ''}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Tehsil:</strong>
                                    <span>{{$qb->tehsils?->tehsil_name ?? ''}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Village:</strong>
                                    <span>{{$qb->village}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Type of visit:</strong>
                                    <span>{{$qb->type_of_visit ?? ''}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Accompanied By:</strong>
                                    <span>{{$qb->accompanied_by ?? ''}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Monitoring Type:</strong>
                                    <span>{{$qb->monitoring_type ?? ''}}</span>
                                </div>
                                <div class="col-md-6 col-sm-6 mt-3">
                                    <strong>Activity Description:</strong>
                                    <span>{{$qb->activity_description ?? ''}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Total QBs:</strong>
                                    <span>{{$qb->total_qbs ?? ''}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>QBs Fully Met:</strong>
                                    <span>{{$qb->qbs_fully_met ?? ''}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>QBs Not Applicable:</strong>
                                    <span>{{$qb->qb_not_applicable ?? ''}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>QBs Not Fully Met:</strong>
                                    <span>{{$qb->qbs_not_fully_met ?? ''}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Date Visit:</strong>
                                    <span>{{ date('M d, Y', strtotime($qb->date_visit)) ?? ''}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>QB Filled By:</strong>
                                    <span>{{$qb->qb_filledby ?? ""}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Staff Organization:</strong>
                                    <span>{{$qb->staff_organization ?? ""}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Score Out:</strong>
                                    <span>{{$qb->score_out ?? ''}}</span>
                                </div>
                                {{-- <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>Created By:</strong>
                                    <span>{{$qb->user->name ?? ""}}</span>
                                </div>
                                <div class="col-md-3 col-sm-3 mt-3">
                                    <strong>QB Created At:</strong>
                                    <span>{{date('M d,Y', strtotime($qb->created_at)) ?? ""}}</span>
                                </div> --}}
                            </div>
                            
                        </div>

                        <div class="separator separator-dashed separator-content border-warning my-15">
                            <i class="ki-duotone ki-abstract-19 fs-4 text-warning "><strong>Action Points</strong></i>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="accordion" id="actionPointsAccordion">  
                                @foreach($qb->action_point->sortBy('monitor_visits_id') as $action_point)
                                    <div class="accordion-item mt-5">
                                        <h2 class="accordion-header" id="heading{{$loop->index}}" >
                                            <button style="background-color: #F2A900;" class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->index}}" aria-expanded="false" aria-controls="collapse{{$loop->index}}">
                                             <strong> ({{$loop->iteration }}/{{$loop->count}})&nbsp&nbsp&nbsp {{ $action_point->monitor_visit->gap_issue ?? ''}}
                                                <div class="justify-content-end d-flex">{{$action_point->status}}</div>
                                            </strong> </button>
                                        </h2>
                                        <div id="collapse{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="heading{{$loop->index}}" data-bs-parent="#actionPointsAccordion">
                                            <div class="accordion-body">
                                                <!-- Action Point Detail Content -->
                                                <div class="row">
                                                    <div class="col-md-4 mt-3">
                                                        <td> <strong>Activity:</strong> </td>
                                                        @if($action_point->monitor_visit->activity_type == "act")
                                                            <td> Activity #{{$action_point->monitor_visit->activity_number ?? ""}}  </td>
                                                        @else
                                                            <td>General Observation     </td>
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
                                                        <td><strong>QB Recommendations  </strong></td>
                                                        <td>{{$action_point->qb_recommendation ?? " "}}</td>
                                                    </div>
                                                    <div class="col-md-4 col-sm-3 mt-5"> 
                                                        <td><strong>Action point Agreed (Yes/No)</strong></td>
                                                        <td>{{$action_point->action_agree ?? " "}}</td>
                                                    </div>
                                                    <div class="col-md-4 col-sm-3 mt-5"> 
                                                        <td><strong>Action Type</strong></td>
                                                        <td>{{$action_point->action_type ?? " "}}</td>
                                                    </div>
                                                   
                                                    <div class="col-md-4 col-sm-3 mt-5"> 
                                                        <td class="fs-7"><strong>Responsible Person </strong></td>
                                                        <td  class="fs-7">{{$action_point->responsible_person ?? " "}}</td>
                                                    </div>
                                                    <div class="col-md-12 col-sm-6 mt-5"> 
                                                        <td><strong>Actions Decided </strong></td>
                                                        <td>{{$action_point->qb_recommendation ?? " "}}</td>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3 mt-5"> 
                                                        <td class="fs-7"><strong>Deadline  </strong></td>
                                                        <td class="fs-7">{{date('M d, Y', strtotime($action_point->deadline ?? " ")) }}</td>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3 mt-5"> 
                                                        <td class="fs-7"><strong>Completion Date  </strong></td>
                                                        <td class="fs-7">{{date('M d, Y', strtotime($action_point->action_achiev?->completion_date ?? " ")) }}</td>
                                                    </div>
                                                    <div class="col-md-6 col-sm-3 mt-5"> 
                                                        <td><strong>Completion Note  </strong></td>
                                                        <td>{{$action_point->action_achiev?->comments ?? " " }}</td>
                                                    </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
