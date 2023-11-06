
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Detail Monitor Visit::</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">
                    <tr>
                        <td ><strong>Activity Number</strong></td>
                        <td>{{$monitor_visit->activity_number}}</td>
                    </tr>
                    <tr>
                        <td><strong>Activity Findings</strong></td>
                        <td>{{$monitor_visit->qbs_description ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>QB Met (Yes/no) </strong></td>
                        <td>{{$monitor_visit->qb_met ?? ""}}</td>
                    </tr>
                    <tr>
                        <td><strong>QB Met (Yes/no) </strong></td>
                        <td>{{$monitor_visit->qb_met ?? ""}}</td>
                    </tr>
                    <tr>
                        <td><strong>Gap/Issue </strong></td>
                        <td>{{$monitor_visit->gap_issue ?? ""}}</td>
                    </tr>
                    <tr>
                        <td><strong>Created By </strong></td>
                        <td>{{$monitor_visit->user->name ?? ""}}</td>
                    </tr>
                    <tr>
                        <td><strong>Created At </strong></td>
                        <td>{{date('d-M-Y', strtotime($monitor_visit->created_at)) ?? ""}}</td>
                    </tr>
                  
                </table>
                
            </div>


        </div>
    </div>

