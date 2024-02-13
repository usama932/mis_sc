<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment as Focal Person for {{ $details['project'] }} Project</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            color: #2F3044;
            background-color: #edf2f7;
        }

        table {
            max-width: 600px;
            margin: 0 auto;
            border-collapse: collapse;
        }

        td {
            padding: 20px;
        }

        img {
            max-height: 50px;
            width: auto;
        }

        .header {
            background-color: #ffffff;
            border-radius: 6px;
        }

        .content {
            font-size: 17px;
        }

        .credentials {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 6px;
        }

        .button {
            display: inline-block;
            padding: 8px 20px;
            font-size: 14px;
            border-radius: 4px;
            color: #ffffff;
            background-color: #009ef7;
            border: 0;
            text-decoration: none;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #6d6e7c;
        }
    </style>
</head>
<body>

    <table>
        <tr>
            <td align="center" class="header">
                <a href="https://pakistan.savethechildren.net/" rel="noopener" target="_blank">
                    <img alt="Logo" src="https://mis-sc.pk/assets/media/logos/logo.png" style="max-height: 50px; width: auto;">
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <table class="header" style="background-color: #ffffff; border-radius: 6px;">
                    <tr>
                        <td class="content" style="padding: 20px; font-size: 17px;">
                            <strong>Assignment as Focal Person for {{ $details['project'] }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="content" style="padding: 20px; font-size: 17px;">
                            Dear ,
                            <br>

                            I trust this message finds you well.

                            I am pleased to inform you that, You are the focal person for the {{ $details['project'] }}.
                            Sign-In for further Information  
                            </td>
                    </tr>
                    <tr>
                        <td class="content credentials" style="padding: 20px; font-size: 17px; background-color: #f9f9f9; border-radius: 6px;">
                            <p><strong>Email:</strong> {{ $details['email'] }}</p>
                            <p><strong>Password:</strong> {{ $details['password'] }}</p>
                            
                            Kindly ensure the confidentiality of these credentials and refrain from sharing them with unauthorized individuals. Upon your initial login, 
                            it is imperative that you change the password to enhance the security of the account.
                        </td>
                    </tr>
                   
                    <tr>
                        <td class="content" style="text-align: center; padding: 20px; font-size: 17px;">
                            <a href="https://mis-sc.pk/" class="button" style="display: inline-block; padding: 8px 20px; font-size: 14px; border-radius: 4px; color: #ffffff; background-color: #009ef7; border: 0; text-decoration: none;">
                                MIS-SC-PK
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="content" style="padding: 20px; font-size: 17px;">
                            Should you have any queries or require further assistance, please do not hesitate to contact 
                            <a href="mailto:usama.qayyum@savethechildren.org" style="color: #009ef7; text-decoration: none;">Administrator</a> 
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="footer" style="text-align: center; padding: 20px; font-size: 13px; color: #6d6e7c;">
                &copy; 2024 Save the Children
            </td>
        </tr>
    </table>

</body> 
</html>
