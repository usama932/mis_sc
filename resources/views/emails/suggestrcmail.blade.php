<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRM Tracker Update!</title>
    <style>
        body {
            text-align: center;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
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
            margin: 0 auto 20px;
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
            font-weight: bold;
        }
        .custom-btn {
            display: inline-block;
            //padding: 10px 20px;
            font-size: 12px;
            border-radius: 5px;
            color:white;
            background-color: #007bff;
            border: none;
            text-align: center;
            text-decoration: none;
            margin-top: 20px;
        }
        .custom-btn:hover {
            background-color: #0056b3;
        }
        p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <a href="https://pakistan.savethechildren.net/" rel="noopener" target="_blank">
            <img alt="Save the Children" src="https://mis-sc.pk/assets/media/logos/logo.png"/>
        </a>
    </div>
    <div>
        <p>This is a system-generated email. Please do not reply. For any query, contact the MEAL-MIS Team.</p>
    </div>
    <div class="email-content">
        <p>Dear Concerned,</p>
        <p>Following are the FRM details for {{$details['feedback_activity']}} in {{$details['village']}} received on {{$details['date_received']}} for your consideration. 
            Please log in to the <a href="https://mis-sc.pk/">MIS</a> and click the <a href="{{ route('frm-managements.show', $details['id']) }}" class="custom-btn">FRM link</a> to see complete FRM details.</p>
        <table>
            <thead>
                <tr>
                    <th colspan="2">FRM Response ID: {{$details['response_id']}}</th>
                    <th>Received Date</th>
                    <th colspan="2">{{$details['date_received']}}</th>
                </tr>
                <tr>
                    <th>Feedback Description</th>
                    <th>Feedback Category</th>
                    <th>Feedback Activity</th>
                    <th>View Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$details['feedback_description']}}</td>
                    <td>{{$details['feedback_category']}}</td>
                    <td>{{$details['feedback_activity']}}</td>
                    <td><a href="{{route('frm-managements.show', $details['id'])}}" class="custom-btn">View</a></td>
                </tr>
            </tbody>
        </table>
        <p>{{$details['message']}}</p>
        <p>Regards,</p>
        <p>MIS Team</p>
    </div>
</div>
</body>
</html>