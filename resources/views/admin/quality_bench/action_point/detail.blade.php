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
                    <td><strong>Visit Monitor</strong></td>
                    <td>{{$action_point->monitor_visits_id ?? ''}}</td>
                </tr>
                <tr>
                    <td><strong>Recommendation</strong></td>
                    <td>{{$action_point->qb_recommendation ?? ""}}</td>
                </tr>
                <tr>
                    <td><strong>Action Type</strong></td>
                    <td>{{$action_point->action_type ?? ""}}</td>
                </tr>
                <tr>
                    <td><strong>Responsible Person</strong></td>
                    <td>{{$action_point->responsible_person ?? ""}}</td>
                </tr>
                <tr>
                    <td><strong>Deadline </strong></td>
                    <td>{{$action_point->deadline ?? ""}}</td>
                </tr>
                <tr>
                    <td><strong>Created By </strong></td>
                    <td>{{$action_point->user->name ?? "NA"}}</td>
                </tr>
                <tr>
                    <td><strong>Created At </strong></td>
                    <td>{{date('d-M-Y', strtotime($qb->created_at)) ?? ""}}</td>
                </tr>
             
            </table>
            
        </div>


    </div>
</div>