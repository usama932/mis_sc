<table class="table table-striped">
    <tr>
        <td><strong>Meeting Title </strong></td>
        <td>{{$review->meeting_title ?? ""}}</td>
    </tr>
    <tr>
        <td><strong>Responsible Person </strong></td>
        <td>{{$review->rp?->name ?? ""}}</td>
    </tr>
    <tr>
        <td ><strong>DIP Identified</strong></td>
        <td>{{$review->dip_identified ?? ''}}</td>
    </tr>
    <tr>
        <td ><strong>Review Date</strong></td>
        <td>{{date('M d,Y', strtotime($review->review_date)) ?? "" }}</td>
    </tr>
    <tr>
        <td ><strong>Action Agree</strong></td>
        <td>{{$review->action_agreed ?? ''}}</td>
    </tr>
    <tr>
        <td ><strong>Deadline</strong></td>
        <td>{{date('M d,Y', strtotime($review->deadline)) ?? "" }}</td>
    </tr>
    <tr>
        <td ><strong>Status/strong></td>
        <td>{{$review->status ?? ''}}</td>
    </tr>
    <tr>
        <td><strong>Project</strong></td>
        <td>{{$review->project?->name ?? ""}}</td>
    </tr>
    <tr>
        <td><strong>Created At </strong></td>
        <td>{{date('M d,Y', strtotime($review->created_at)) ?? ""}}</td>
    </tr>
  
</table>