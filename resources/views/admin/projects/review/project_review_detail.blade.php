<table class="table table-striped">
    <tr>
        <td><strong>Meeting Title </strong></td>
        <td>{{$review->meeting_title ?? ""}}</td>
    </tr>
    <tr>
        <td ><strong>Review Date</strong></td>
        <td>{{date('M d,Y', strtotime($review->review_date)) ?? "" }}</td>
    </tr>
    <tr>
        <td><strong>Project</strong></td>
        <td>{{$review->project?->name ?? ""}}</td>
    </tr>
    <tr>
        <td><strong>Created By</strong></td>
        <td>{{$review->user?->name ?? ""}}</td>
    </tr>
    <tr>
        <td><strong>Created At </strong></td>
        <td>{{date('M d,Y', strtotime($review->created_at)) ?? ""}}</td>
    </tr>
  
</table>