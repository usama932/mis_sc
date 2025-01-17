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
        @php
            use Carbon\Carbon;
            $dateVisit = Carbon::parse($details['date_visit']);
            $completionDate = Carbon::parse($details['completion_date']); // Ensure you have this date in your $details array
            $daysDifference = $completionDate->diffInDays($dateVisit);
        @endphp
        <p>Dear Concerned,</p>
        <p>Following are the completed action point details of the QB activity {{$details['activity']}} in {{$details['village']}} that was visited on {{$details['date_visit']}}. The action point wase completed in <strong>{{ $daysDifference  ?? ''}}</strong> days.
            Please log in to <a href="https://mis-sc.pk/">MIS</a> and click this <a href="{{ route('quality-benchs.show', $details['id']) }}" class="custom-btn">QB link</a> to see the complete visit details</p>
        <table>
            <thead>
                <tr>
                    <th  colspan="2" width="40%">QB unique ID:</th>
                    <th  colspan="2" width="40%"> {{$details['response_id']}}</th>
                    <th  colspan="1"  width="40%">Visit Date</th>
                    <th  colspan="2" width="20%"> {{$details['date_visit']}}</th>
                </tr>
                <tr>
                    <th width="30%">Gap Identified</th>
                    <th width="30%">Action Decided</th>
                    <th width="5%">Deadline</th>
                    <th width="5%">Completion Date</th>
                    <th width="20%">Completion Note</th>
                    <th width="5%">Status</th>
                    <th width="5%">View Detail</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($details))
                    <tr>
                        <td>{{$details['gap']}}</td>
                        <td>{{$details['qb_recommendation']}}</td>
                        <td>{{$details['deadline']}}</td>
                        <td>{{$details['completion_date']}}</td>
                        <td>{{$details['comments']}}</td>
                        <td>{{$details['status']}}</td>
                        <td><a href="{{route("action_points.show",$details["action_id"])}}">View</a></td>
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
