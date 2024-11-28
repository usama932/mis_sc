

<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h3 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <div class="d-flex align-items-center">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-10px me-5">
                        <span class="symbol-label bg-light-danger">
                            <i class="fa fa-info-circle fs-2x text-danger">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bold">FRM Detail</a>
                        
                    </div>
                    
                </div>
            </button>
        </h3>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="card-header border-0">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <table class="table table-striped m-4 p-4">
                                <tr>
                                    <td class="fs-8"><strong>Response #.id</strong></td>
                                    <td>{{$frm->response_id ?? ''}}</td>
                                </tr>
                              
                                <tr>
                                    <td><strong>Province</strong></td>
                                    <td>{{$frm->provinces->province_name ?? ''}}</td>
                                </tr>
                        
                                <tr>
                                    <td><strong>Tehsil</strong></td>
                                    <td>{{$frm->tehsils->tehsil_name ?? $frm->tehsil}}</td>
                                </tr>
                            
                                <tr>
                                    <td><strong>Project</strong></td>
                                    <td>{{$frm->project?->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td class="fs-9"><strong>Feedback Channel</strong></td>
                                    <td>{{$frm->channel?->name ?? "NA"}}</td>
                                </tr>
                                <tr>
                                    <td class="fs-9"><strong>Feedback Reffered or Shared</strong></td>
                                    <td>{{$frm->feedback_referredorshared ?? ""}}</td>
                                </tr>
                                <tr>
                                    <td class="fs-9"><strong>Reffered To(Name)</strong></td>
                                    <td>{{$frm->referral_name ?? "NA"}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Created By</strong></td>
                                    <td>{{$frm->user->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Created At</strong></td>
                                    <td>{{date('M d,Y H:i:s', strtotime($frm->created_at)) ?? ''}}</td>
                                </tr>
                              
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped m-4 p-4">
                              
                                <tr>
                                    <td><strong>Respondent Name</strong></td>
                                    <td>{{$frm->name_of_client ?? ''}}</td>
                                </tr>
                              
                                <tr>
                                    <td class="fs-8"><strong>District</strong></td>
                                    <td>
                                        {{$frm->districts->district_name ?? ''}}
                                    </td>
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
                                    <td><strong>Theme</strong></td>
                                    <td>{{$frm->theme_name->name ?? ""}}</td>
                                </tr>
                                <tr>
                                    <td class="fs-9"><strong>Date of feedback Referred </strong></td>
                                    <td>{{date('M d,Y', strtotime($frm->date_ofreferral ?? ""))}}</td>
                                </tr>
                                <tr>
                                    <td class="fs-9"><strong>Reffered To(Position)</strong></td>
                                    <td>{{$frm->referral_position ?? "NA"}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Updated By</strong></td>
                                    <td>{{$frm->user1->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Updated At</strong></td>
                                    <td>{{date('M d,Y H:i:s', strtotime( $frm->updated_at ?? ''))}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <tr>
                                <td><strong>Feedback Description</strong></td>
                                <td>
                                {{$frm->feedback_description ?? ''}} 
                                </td>
                            </tr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>