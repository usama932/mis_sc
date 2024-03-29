<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quality Benchmark Update!</title>
    <style>
        body {
            text-align: center;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo img {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .email-content {
            text-align: left;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .no-gap-issues {
            font-style: italic;
        }
       
        .custom-btn {
            display: inline-block;
            padding: 8px 200px;
            font-size: 14px;
            border-radius: 4px;
            color: white;
            background-color: #007bff;
            border: none;
            text-align: center;
            text-decoration: none;
        }

        .custom-btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <a href="https://pakistan.savethechildren.net/" rel="noopener" target="_blank">
            <img alt="Logo" src="https://mis-sc.pk/assets/media/logos/logo.png"/>
        </a>
    </div>
    <div>
        <p>This is system generated email, Please do not reply. For any query contact MEAL-MIS Team</p>
    </div>
    <div class="email-content">
     
        <p>Dear Concerned,</p>
        <p>Following are the action point details of the QB activity {{$details['activity']}} in {{$details['village']}} visited on {{$details['date_visit']}} along with their deadlines for your consideration. 
            Please login into <a href="https://mis-sc.pk/">MIS</a> and click this <a href="{{ route('quality-benchs.show', $details['id']) }}" class="custom-btn">QB link</a> to see complete visit details.</p>
        <table>
            <thead>
                <tr>
                    <th colspan="2" width="40%">QB unique ID: {{$details['response_id']}}</th>
                    <th width="40%">Visit Date</th>
                    <th     colspan="2" width="20%"> {{$details['date_visit']}}</th>
                </tr>
                <tr>
                    <th width="40%">Gap Identified</th>
                    <th width="40%">Action Decided</th>
                    <th width="20%">Deadline</th>
                    <th width="10%">Completion Date</th>
                    <th width="25%">Completion Note</th>
                    <th width="5%">Status</th>
                    <th width="20%">View Detail</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($details['action_point']))
                    <tr>
                        <td>{{$action_point->monitor_visit?->gap_issue}}</td>
                        <td>{{$action_point->qb_recommendation}}</td>
                        <td>{{$action_point->deadline}}</td>
                        <td>{{$action_point->action_achiev?->completion_date ?? ''}}</td>
                        <td>{{$action_point->action_achiev?->comments ?? ''}}</td>
                        <td>{{$action_point->action_achiev?->status ?? ''}}</td>
                        <td>{{$action_point->responsible_person}}</td>
                        <td><a href="{{route('action_points.show',$action_point->id)}}" >View</a></td>
                    </tr>
                @else
                    <tr>
                        <td colspan="3" class="no-gap-issues">No gap issues found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
       <p>Regards,</p>
       <p>MIS Team</p>
    </div>
</div>
</body>
</html>
