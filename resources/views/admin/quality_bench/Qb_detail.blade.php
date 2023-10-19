<div class="card">
    <div class="row">
        <div class="col-md-12">
            <div class="card-title  border-0 my-4"">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                        <h5 class="fw-bold m-3">Detail Quality Bench::</h5>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <tr>
                    <td><strong>Visit Staff </strong></td>
                    <td>{{$qb->visit_staff_name ?? "NA"}}</td>
                </tr>
                <tr>
                    <td ><strong>Date Visit</strong></td>
                    <td>{{$qb->date_visit}}</td>
                </tr>
                <tr>
                    <td ><strong>Accompanied By</strong></td>
                    <td>{{$qb->accompanied_by}}</td>
                </tr>
                <tr>
                    <td ><strong>Type of visit</strong></td>
                    <td>{{$qb->type_of_visit}}</td>
                </tr>
                <tr>
                    <td ><strong>Province</strong></td>
                    <td>{{$qb->province}}</td>
                </tr>
                <tr>
                    <td ><strong>District</strong></td>
                    <td>{{$qb->district}}</td>
                </tr>
                <tr>
                    <td ><strong>Village</strong></td>
                    <td>{{$qb->village}}</td>
                </tr>
                <tr>
                    <td ><strong>Project Type</strong></td>
                    <td>{{$qb->project_type}}</td>
                </tr>
                <tr>
                    <td ><strong>Project</strong></td>
                    <td>{{$qb->project_name}}</td>
                </tr>
                <tr>
                    <td ><strong>Monitoring Type</strong></td>
                    <td>{{$qb->monitoring_type}}</td>
                </tr>
                <tr>
                    <td ><strong>QB's Not Applicable</strong></td>
                    <td>{{$qb->qb_not_applicable}}</td>
                </tr>
                <tr>
                    <td ><strong>QB's Fully Met</strong></td>
                    <td>{{$qb->qbs_fully_met}}</td>
                </tr>	
                <tr>
                    <td ><strong>QB's Not Fully Met</strong></td>
                    <td>{{$qb->qbs_not_fully_met}}</td>
                </tr>
                <tr>
                    <td ><strong>QB's Fully Met</strong></td>
                    <td>{{$qb->qbs_fully_met}}</td>
                </tr>
                <tr>
                    <td ><strong>Score Out</strong></td>
                    <td>{{$qb->score_out}}</td>
                </tr>
                <tr>
                    <td ><strong>Activity Description</strong></td>
                    <td>{{$qb->activity_description}}</td>
                </tr>
                
                <tr>
                    <td><strong>Created By </strong></td>
                    <td>{{$qb->created_by ?? "NA"}}</td>
                </tr>
                <tr>
                    <td><strong>Created At </strong></td>
                    <td>{{$qb->created_at ?? "NA"}}</td>
                </tr>
              
            </table>
            
        </div>


    </div>
</div>

