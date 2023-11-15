<style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    
    th, td {
      text-align: left;
      padding: 8px;
    }
    
    tr:nth-child(even) {background-color: #f2f2f2;}
    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
        }
</style>
<table id="customers">
  
    <tr>
        <th >S.No.#</th>
        <th>Name of staff Visit</th>
        <th>Date Visit</th>
        <th>Accompanied By</th>
        <th>Type of Visit</th>
        <th>Province</th>
        <th>District</th>
        <th>Tehsil</th>
        <th>Project Type</th>
        <th>Project</th>
        <th>Monitor Type</th>
        <th>No.# QB's Applicable</th>
        <th>No.# QB's Fully Met</th>
        <th>No.# QB's Fully Not Met</th>
        <th>Score Out</th>
        <th>Activity Description</th>
        <th>Activity</th>
        <th>Action Agree</th>
        <th>Recommendation</th>
        <th>Action Type</th>
        <th>Responsible Person</th>
        <th>Deadline</th>
        <th>Created By</th>
        
    </tr>
    @foreach($qbs as $qb)
        @foreach($qb->action_point as $action_point)
            <tr>
                <td>#.000{{$qb->id}}</td>
                <td>{{$qb->visit_staff_name}}</td>
                <td>{{$qb->date_visit}}</td>
                <td>{{$qb->accompanied_by}}</td>
                <td>{{$qb->type_of_visit}}</td>
                <td>{{$qb->provinces?->province_name ?? ''}}</td>
                <td>{{$qb->districts?->district_name ?? ''}}</td>
                <td>{{$qb->village}}</td>
                <td>{{$qb->project_type}}</td>
                <td>{{$qb->project->name}}</td>
                <td>{{$qb->monitoring_type}}</td>
                <td>{{$qb->qb_not_applicable}}</td>
                <td>{{$qb->qbs_fully_met}}</td>
                <td>{{$qb->qbs_not_fully_met}}</td>
                <td>{{$qb->score_out}}</td>
                <td>{{$qb->activity_description}}</td>
                <td>{{$action_point?->monitor_visit?->activity_number ?? ''}}</td>
                <td>{{$action_point->action_agree ?? ''}}</td>
                <td>{{$action_point->qb_recommendation ?? ''}}</td>
                <td>{{$action_point->action_type ?? ''}}</td>
                <td>{{$action_point->responsible_person ?? ''}}</td>
                <td>{{$action_point->deadline ?? ''}}</td>
                <td>{{$qb->user->name}}</td>
            </tr>
        @endforeach
    @endforeach
</table>