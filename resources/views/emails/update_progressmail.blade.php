
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Activity Progress Details</title>
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
                <p>This is an automated email, please do not reply. For any inquiries, contact the MEAL-MIS Team.</p>
            </div>
            <div class="email-content">
                <p>Dear Team,</p>
                <p>Please find below the progress details for the activity titled "<strong>{{$details['activity']}}</strong>".</p>
                <table>
                    <thead>
                        <tr>
                            <th width="5%">Activity Number</th>
                            <th width="40%">Activity Title</th>
                            <th width="10%">Status</th>
                            <th width="40%">Remarks</th>
                            <th width="5%">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$details['activity_number']}}</td>
                            <td>{{$details['activity']}}</td>
                            <td>{{$details['status']}}</td>
                            <td>{{$details['remarks']}}</td>
                            <td><a href="{{route("activity_dips.show",$details["activity_id"])}}" class="custom-btn">View</a></td>
                        </tr>
                    </tbody>
                </table>
                <p>Best regards,</p>
                <p>MIS Team</p>
            </div>
        </div>
    </body>
</html>
