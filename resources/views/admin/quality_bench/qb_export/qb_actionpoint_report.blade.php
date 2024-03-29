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
        <th>QB Unique Code</th>
        <th>Project</th>
        <th>Partner</th>
        <th>Province</th>
        <th>District</th>
        <th>Tehsil</th>
        <th>Theme</th>
        <th>Activity</th>
        <th>Village</th>
        <th>Date Visit</th>
        <th>QB #/Observations</th>
        <th>Action Type</th>
        <th>Issue/gap identified</th>
        <th>Action to make QBs fully met</th>
        <th>Responsible Person</th>
        <th>Deadline</th>
        <th>Status</th>
        <th>Date Completed</th>
        <th>Completion Note</th>
        <th>Created by</th>
        <th>Created at</th>
        <th>Updated by</th>
        <th>Updated at</th>
    </tr>
    @foreach($qbs as $qb)
        @foreach($qb->action_point as $action_point)
            <tr>
                <td>{{$qb->assement_code ?? ''}}</td>
                <td>{{$qb->project?->name ?? ''}}</td>
                <td>{{$qb->partner ?? ''}}</td>
                <td>{{$qb->provinces?->province_name ?? ''}}</td>
                <td>{{$qb->districts?->district_name ?? ''}}</td>
                <td>{{$qb->tehsils?->tehsil_name ?? ''}}</td>
                <td>{{$qb->theme_name?->name ?? ''}}</td>
                <td>{{$qb->activity_description}}</td>
                <td>{{$qb->village}}</td>
                <td>{{$qb->date_visit ?? ''}}</td>
                <td>
                    @if($action_point->monitor_visit?->activity_type == "act")
                        {{$action_point->monitor_visit?->activity_number ?? ''}}
                    @elseif(action_point->monitor_visit?->activity_type == "obs")
                        General Observation
                    @else
                    @endif
                </td>
                <td>
                    {{$action_point->monitor_visit?->action_type ?? ''}}
                </td>
                <td>
                    {{$action_point->monitor_visit?->gap_issue ?? ''}}
                </td>
                <td>{{$action_point->qb_recommendation ?? ''}}</td>
                <td>{{$action_point->responsible_person ?? ''}}</td>
                <td>{{$action_point->deadline ?? ''}}</td>
                <td>{{$action_point->status ?? ''}}</td>
                <td>@if(!empty($action_point->action_achiev?->completion_date)){{$action_point->action_achiev?->completion_date ?? ''}} @endif</td>
                <td>@if($action_point->action_achiev?->comments != 'N/A' &&  !empty($action_point->action_achiev?->comments)){{$action_point->action_achiev?->comments ?? ''}}@else  @endif</td>
                <td>{{$action_point->user?->name ?? ''}}</td>
                <td>{{$action_point->created_at->format('M d,Y') ?? ''}}</td>
                <td>{{$action_point->user1?->name ?? ''}}</td>
                <td>{{$action_point->updated_at->format('M d,Y') ?? ''}}</td>
            </tr>
        @endforeach
    @endforeach
</table>