<div class="card">
    <div class="row">
        <div class="col-md-12">
            <div class="card-title  border-0 my-4"">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                        <h5 class="fw-bold m-3">Detail Action Point::</h5>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <tr>
                    <td><strong>QB </strong></td>
                    <td>{{$action_point->quality_bench_id ?? "NA"}}</td>
                </tr>
                <tr>
                    <td ><strong>Quality Bench</strong></td>
                    <td>{{$action_point->quality_bench_id}}</td>
                </tr>
                <tr>
                    <td><strong>Visit Monitor</strong></td>
                    <td>{{$action_point->monitor_visits_id ?? 'NA'}}</td>
                </tr>
                <tr>
                    <td><strong>Recommendation</strong></td>
                    <td>{{$action_point->qb_recommendation ?? "NA"}}</td>
                </tr>
                <tr>
                    <td><strong>Action Type</strong></td>
                    <td>{{$action_point->action_type ?? "NA"}}</td>
                </tr>
                <tr>
                    <td><strong>Responsible Person</strong></td>
                    <td>{{$action_point->responsible_person ?? "NA"}}</td>
                </tr>
                <tr>
                    <td><strong>Deadline </strong></td>
                    <td>{{$action_point->deadline ?? "NA"}}</td>
                </tr>
                <tr>
                    <td><strong>Created By </strong></td>
                    <td>{{$action_point->created_by ?? "NA"}}</td>
                </tr>
                <tr>
                    <td><strong>Created At </strong></td>
                    <td>{{$action_point->created_at ?? "NA"}}</td>
                </tr>
             
            </table>
            
        </div>


    </div>
</div>