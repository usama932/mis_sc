<x-default-layout>
 
    @section('title')
        Monitoring Visits Detail ({{$qb->assement_code ?? ''}})
    @endsection
    <div class="card p-3">
        <div class="row">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('quality-benchs.edit',$qb->id)}}" class="btn btn-primary me-md-2 btn-sm" target="_blank">Edit Monitoring Visit</a>
            </div>
            <div class="col-md-12 ">

                {{-- Basic Info --}}
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Summary </h5>
                        </div>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Project  </strong></td>
                        <td>{{$qb->project->name ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Project Type  </strong></td>
                        <td>{{$qb->project_type}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Partner </strong></td>
                        <td>{{$qb->partner}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Province  </strong></td>
                        <td>{{$qb->provinces?->province_name ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>District  </strong></td>
                        <td>{{$qb->districts?->district_name ?? '' }}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Tehsil  </strong></td>
                        <td>{{$qb->tehsils?->tehsil_name ?? '' }}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Village  </strong></td>
                        <td>{{$qb->village}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Type of visit  </strong></td>
                        <td>{{$qb->type_of_visit ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Accompanied By  </strong></td>
                        <td>{{$qb->accompanied_by ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Monitoring Type  </strong></td>
                        <td>{{$qb->monitoring_type ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Activity Description  </strong></td>
                        <td>{{$qb->activity_description ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Total QBs</strong></td>
                        <td>{{$qb->total_qbs ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong> QBs Fully Met</strong></td>
                        <td>{{$qb->qbs_fully_met ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>QB's Not Applicable  </strong></td>
                        <td>{{$qb->qb_not_applicable ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>QB's Not Fully Met  </strong></td>
                        <td>{{$qb->qbs_not_fully_met ?? ''}}</td>
                    </div>	
                  
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Date Visit  </strong></td>
                        <td>{{ date('d-M-Y', strtotime($qb->date_visit)) ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td><strong>QB Fiiled By </strong></td>
                        <td>{{$qb->qb_filledby ?? " "}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td><strong>Staff Organization</strong></td>
                        <td>{{$qb->staff_organization ?? " "}}</td>
                    </div>
                 
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Score Out  </strong></td>
                        <td>{{$qb->score_out ?? ''}}</td>
                    </div>
                   
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td><strong>Created By  </strong></td>
                        <td>{{$qb->user->name ?? ""}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td><strong>Created At  </strong></td>
                        <td>{{date('d-M-Y', strtotime($qb->created_at)) ?? ""}}</td>
                    </div>
                
                </div>


                {{-- Qbs Not Fully Met --}}
                <div class="separator border-4 my-10"></div>
                <div class="card-title  border-0 mt-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1" style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Detail QB's Not Fully Met </h5>
                        </div>
                    </div>
                </div>
                @if($qb->monitor_visit->count() > 0)
                <div class="row"> 
                    @foreach($qb->monitor_visit as $monitor_visit)
                        <h4 class="my-5">QB's Not Fully Met.# {{$loop->index +1}}</h4>
                        <div class="col-md-3 col-sm-3 mt-5"> 
                            <td><strong>Activity Number  </strong></td>
                            <td>{{$monitor_visit->activity_number ?? " "}}</td>
                        </div>
                        <div class="col-md-12 col-sm-6 mt-5"> 
                            <td><strong>Quality Benchmark Activity Detail  </strong></td>
                            <td>{{$monitor_visit->qbs_description ?? " "}}</td>
                        </div>
                        <div class="col-md-12 col-sm-6 mt-5"> 
                            <td><strong>Gap/issue  </strong></td>
                            <td>{{$monitor_visit->gap_issue ?? " "}}</td>
                        </div>
                        <div class="col-md-3 col-sm-3 mt-5"> 
                            <td><strong>Created By  </strong></td>
                            <td>{{$monitor_visit->user?->name ?? " "}}</td>
                        </div>
                        <div class="col-md-3 col-sm-3 mt-5"> 
                            <td><strong>Updated By  </strong></td>
                            <td>{{$monitor_visit->user1?->name ?? " "}}</td>
                        </div>
                        <div class="col-md-3 col-sm-3 mt-5"> 
                            <td><strong>Created At  </strong></td>
                            <td>{{date('d-M-Y H:i:s', strtotime($monitor_visit->created_at ?? " ")) }}</td>
                        </div>
                        <div class="col-md-3 col-sm-3 mt-5"> 
                            <td><strong>Updated At  </strong></td>
                            <td>{{date('d-M-Y H:i:s', strtotime($monitor_visit->updated_at ?? " ")) }}</td>
                        </div>
                        <div class="separator border-2 my-10"></div>
                    @endforeach
                </div>
                @else
                <h5 class="text-center text-danger mt-3">There's No Qbs data</h5>
                @endif

                {{-- Action Points --}}
                <div class="separator border-4 my-10"></div>
                <div class="card-title  border-0 mt-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1" style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Action Point Details </h5>
                        </div>
                    </div>
                </div>
                @if($qb->action_point->count() > 0)
                    <div class="row"> 
                        @foreach($qb->action_point as $action_point)
                            <h4 class="my-5">Action Point Detail .# ( {{$action_point->monitor_visit->activity_number ?? ''}} )</h4>
                            <div class="col-md-12 col-sm-6 mt-5"> 
                                <td><strong>Debrief Notes against identified Gap  </strong></td>
                                <td>{{$action_point->db_note ?? " "}}</td>
                            </div>
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Action point Agreed (Yes/No)   </strong></td>
                                <td>{{$action_point->action_agree ?? " "}}</td>
                            </div>
                        
                            <div class="col-md-12 col-sm-6 mt-5"> 
                                <td><strong>Actions to make QBs above fully met  </strong></td>
                                <td>{{$action_point->qb_recommendation ?? " "}}</td>
                            </div>
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Action Type  </strong></td>
                                <td>{{$action_point->action_type ?? " "}}</td>
                            </div>
                        
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Responsible Person </strong></td>
                                <td>{{$action_point->responsible_person ?? " "}}</td>
                            </div>
                        
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Status  </strong></td>
                                <td>{{$action_point->status ?? " "}}</td>
                            </div>
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Deadline  </strong></td>
                                <td>{{date('d-M-Y', strtotime($action_point->deadline ?? " ")) }}</td>
                            </div>
                        
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Created By  </strong></td>
                                <td>{{$action_point->user?->name ?? " "}}</td>
                            </div>
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Updated By  </strong></td>
                                <td>{{$action_point->user1?->name ?? " "}}</td>
                            </div>
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Created At  </strong></td>
                                <td>{{date('d-M-Y H:i:s', strtotime($action_point->created_at ?? " ")) }}</td>
                            </div>
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Updated At  </strong></td>
                                <td>{{date('d-M-Y H:i:s', strtotime($action_point->updated_at ?? " ")) }}</td>
                            </div>
                            <div class="separator border-2 my-10"></div>
                        @endforeach
                    </div>
                @else
                    <h5 class="text-center text-danger mt-3">There's No Qbs data</h5>
                @endif
                

                {{-- Attachments --}}
                
                {{-- Attachments and Generral Observations --}}
                <div class="separator border-4 my-10"></div>
                <div class="card-title  border-0 mt-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1" style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Attachments and Generral Observations </h5>
                        </div>
                    </div>
                </div>
                @if(!empty($qb->qbattachement))
                    <div class="row"> 
                   
                            <div class="col-md-12 col-sm-6 mt-5"> 
                                <td><strong>Comments  </strong></td>
                                <td>{{$qb->qbattachement->comments ?? " "}}</td>
                            </div>
                        
                            <div class="col-md-12 col-sm-6 mt-5"> 
                                <td><strong>Attachments  </strong></td>
                                <td>    
                                    @if(!empty($qb->qbattachement) && $qb->qbattachement->document != '')
                                        <a class="btn btn-sm  btn-danger mx-5" title="Download Attachment" href="{{ route('showPDF.qb_attachments', $qb->qbattachement->id) }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                                                <!-- SVG path code -->
                                            </svg> Download Attachment
                                        </a>
                                    @endif
                                </td>
                            </div>
                        
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Created By  </strong></td>
                                <td>{{$qbattachement->user?->name ?? " "}}</td>
                            </div>
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Updated By  </strong></td>
                                <td>{{$qbattachement->user1?->name ?? " "}}</td>
                            </div>
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Created At  </strong></td>
                                <td>{{date('d-M-Y H:i:s', strtotime($qbattachement->created_at ?? " ")) }}</td>
                            </div>
                            <div class="col-md-3 col-sm-3 mt-5"> 
                                <td><strong>Updated At  </strong></td>
                                <td>{{date('d-M-Y H:i:s', strtotime($qbattachement->updated_at ?? " ")) }}</td>
                            </div>
                            <div class="separator border-2 my-10"></div>
                       
                    </div>
                @else
                    <h5 class="text-center text-danger mt-3">There's No Qbs data</h5>
                @endif

            </div>


        </div>
    </div>
</x-default-layout>
