
<div class="card">
    <div class="row">
        <div class="col-md-12">
            <div class="card-title  border-0 my-4"">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                        <h5 class="fw-bold m-3">Detail QB Attachment::</h5>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <tr>
                    <td><strong>Comments </strong></td>
                    <td>{{$qb_attachment->comments ?? ""}}</td>
                </tr>
                <tr>
                    <td ><strong>document</strong></td>
                    <td>{{$qb_attachment->document ?? ''}}</td>
                </tr>
                <tr>
                    <td><strong>Created By </strong></td>
                    <td>{{$qb_attachment->user->name ?? ""}}</td>
                </tr>
                <tr>
                    <td><strong>Created At </strong></td>
                    <td>{{date('d-M-Y', strtotime($qb->created_at)) ?? ""}}</td>
                </tr>
              
            </table>
            
        </div>


    </div>
</div>

