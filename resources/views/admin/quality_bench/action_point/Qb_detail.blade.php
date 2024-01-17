<x-default-layout>
 
    @section('title')
         Quality Benchmarks (QB's)
    @endsection
    <div class="card p-3">
        <div class="row">
            @can('edit quality benchmarks')
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('action_points.edit',$action_point->id) }}" class="btn btn-primary me-md-2 btn-sm" target="_blank">Edit QB</a>
            </div>
            @endcan
            <div class="col-md-6 ">
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Detail Quality Bench::</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped p-3">
                    <tr>
                        <td><strong>Unique Code</strong></td>
                        <td>{{$action_point->qb?->assement_code ?? " "}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Date Visit</strong></td>
                        <td>{{ date('d-M-Y', strtotime($action_point->qb?->date_visit)) ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Accompanied By</strong></td>
                        <td>{{$action_point->qb->accompanied_by ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Type of visit</strong></td>
                        <td>{{$action_point->qb?->type_of_visit ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Province</strong></td>
                        <td>{{$action_point->qb?->provinces?->province_name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>District</strong></td>
                        <td>{{$action_point->qb?->districts?->district_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td ><strong>Village</strong></td>
                        <td>{{$action_point->qb?->village}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Project Type</strong></td>
                        <td>{{$action_point->qb?->project_type}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Project</strong></td>
                        <td>{{$action_point->qb?->project->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Monitoring Type</strong></td>
                        <td>{{$action_point->qb?->monitoring_type ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>QB's Not Applicable</strong></td>
                        <td>{{$action_point->qb?->qb_not_applicable ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>QB's Fully Met</strong></td>
                        <td>{{$action_point->qb?->qbs_fully_met ?? ''}}</td>
                    </tr>	
                    <tr>
                        <td ><strong>QB's Not Fully Met</strong></td>
                        <td>{{$action_point->qb?->qbs_not_fully_met ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>QB's Fully Met</strong></td>
                        <td>{{$action_point->qb?->qbs_fully_met ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Score Out</strong></td>
                        <td>{{$action_point->qb?->score_out ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Activity Description</strong></td>
                        <td>{{$action_point->qb?->activity_description ?? ''}}</td>
                    </tr>
                    
                    <tr>
                        <td><strong>QB Created By </strong></td>
                        <td>{{$action_point->qb?->user->name ?? ""}}</td>
                    </tr>
                    <tr>
                        <td><strong>QB Created At </strong></td>
                        <td>{{date('d-M-Y', strtotime($action_point->qb?->created_at)) ?? ""}}</td>
                    </tr>
                
                </table>
                
            </div>
            <div class="col-md-6 ">
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Detail QB Action Point::</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped p-3">
                    <tr>
                        <td><strong>Activity Number</strong></td>
                        <td>{{$action_point->monitor_visit?->activity_number ?? " "}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Gap/Issues</strong></td>
                        <td>{{ $action_point->monitor_visit?->gap_issue ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Debrief Notes against identified Gap(s)</strong></td>
                        <td>{{$action_point->db_note ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Action point agreed (Yes/No)</strong></td>
                        <td>{{$action_point->action_agree ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Actions to make QBs above fully met</strong></td>
                        <td>{{$action_point->qb_recommendation ?? ''}}</td>
                    </tr>
                    <tr>
                        <td ><strong>Action Type (Administrative/ Technical/ Both)</strong></td>
                        <td>{{$action_point->action_type ?? '' }}</td>
                    </tr>
                    <tr>
                        <td ><strong>Responsible Person</strong></td>
                        <td>{{$action_point->responsible_person ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>{{$action_point->status ?? ""}}</td>
                    </tr>
                    <tr>
                        <td><strong>Deadline </strong></td>
                        <td>@if($action_point->deadline != '') {{date('d-M-Y', strtotime($action_point->deadline)) ?? ""}} @endif</td>
                    </tr>
                    <div class="col-md-3 col-sm-3 mt-5"> 
                        <td><strong>Completion Date </strong></td>
                        <td>{{date('d-M-Y', strtotime($action_point->completion_date ?? " ")) }}</td>
                    </div>
                    <tr>
                        <td><strong>QB Created By </strong></td>
                        <td>{{$action_point->qb?->user->name ?? ""}}</td>
                    </tr>
                    <tr>
                        <td><strong>QB Created At </strong></td>
                        <td>{{date('d-M-Y', strtotime($action_point->qb?->created_at)) ?? ""}}</td>
                    </tr>
                
                </table>
                
            </div>


        </div>
    </div>
</x-default-layout>
