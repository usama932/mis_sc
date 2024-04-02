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
        <th>Assesment Code</th>
        <th>Staff Organization</th>
        <th>Project</th>
        <th>Partner</th>
        <th>Province</th>
        <th>District</th>
        <th>Theme</th>
        <th>Activity</th>
        <th>Village</th>
        <th>Date Visit</th>
        <th>Total Quality Benchmarks (QBs)</th>
        <th>Total QBs Not Fully Met</th>
        <th>Total QBs Fully met</th>
        <th>Total number of QBs not applicable for this visit</th>
        <th>Score Out</th>
        <th>Qb Status</th>
        
    </tr>
    @foreach($qbs as $qb)
      <tr>
        <td>{{$qb->assement_code ?? ''}}</td>
        <td>{{$qb->staff_organization ?? ''}}</td>
        <td>{{$qb->project->name ?? ''}}</td>
        <td>{{$qb->partners?->slug ?? ''}}</td>
        <td>{{$qb->provinces?->province_name ?? ''}}</td>
        <td>{{$qb->districts?->district_name ?? ''}}</td>
        <td>{{$qb->theme_name->name}}</td>
        <td>{{$qb->activity_description}}</td>
        <td>{{$qb->village}}</td>
        <td>{{$qb->date_visit}}</td>
        <td>{{$qb->total_qbs}}</td>
        <td>{{$qb->qbs_not_fully_met}}</td>
        <td>{{$qb->qbs_fully_met}}</td>
        <td>{{$qb->qb_not_applicable}}</td>
        <td>{{$qb->score_out}}</td>
        <td>{{$qb->qb_status}}</td>
      </tr>
    @endforeach
</table>