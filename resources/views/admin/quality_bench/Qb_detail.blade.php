<x-default-layout>
 
    @section('title')
         Quality Benchmarks (QB's)
    @endsection
    <div class="card p-3">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Detail Quality Bench::</h5>
                        </div>
                    </div>
                </div>
                
                <div class="row"> 
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td><strong>Visit Staff ::</strong></td>
                        <td>{{$qb->visit_staff_name ?? " "}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Date Visit ::</strong></td>
                        <td>{{ date('d-M-Y', strtotime($qb->date_visit)) ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Accompanied By ::</strong></td>
                        <td>{{$qb->accompanied_by ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Type of visit ::</strong></td>
                        <td>{{$qb->type_of_visit ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Province ::</strong></td>
                        <td>{{$qb->provinces?->province_name ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>District ::</strong></td>
                        <td>{{$qb->districts?->district_name ?? '' }}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Village ::</strong></td>
                        <td>{{$qb->village}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Project Type ::</strong></td>
                        <td>{{$qb->project_type}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Project ::</strong></td>
                        <td>{{$qb->project->name ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Monitoring Type ::</strong></td>
                        <td>{{$qb->monitoring_type ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>QB's Not Applicable ::</strong></td>
                        <td>{{$qb->qb_not_applicable ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>QB's Fully Met ::</strong></td>
                        <td>{{$qb->qbs_fully_met ?? ''}}</td>
                    </div>	
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>QB's Not Fully Met ::</strong></td>
                        <td>{{$qb->qbs_not_fully_met ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>QB's Fully Met ::</strong></td>
                        <td>{{$qb->qbs_fully_met ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Score Out ::</strong></td>
                        <td>{{$qb->score_out ?? ''}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td ><strong>Activity Description ::</strong></td>
                        <td>{{$qb->activity_description ?? ''}}</td>
                    </div>
                    
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td><strong>Created By ::</strong></td>
                        <td>{{$qb->user->name ?? ""}}</td>
                    </div>
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td><strong>Created At ::</strong></td>
                        <td>{{date('d-M-Y', strtotime($qb->created_at)) ?? ""}}</td>
                    </div>
                
                </div>
                <div class="card-title  border-0 mt-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Detail QB Monitor Visit::</h5>
                        </div>
                    </div>
                </div>
                @if($qb->monitor_visit->count() > 0)
                <div class="row"> 
                    @foreach($qb->monitor_visit as $monitor_visit)
                    <div class="col-md-3 col-sm-3 mt-5">
                        <td><strong>Activity Nu ::</strong></td>
                        <td>{{$monitor_visit->activity_number ?? " "}}</td>
                    </div>
                </div>
                @endif
                
            </div>


        </div>
    </div>
</x-default-layout>
