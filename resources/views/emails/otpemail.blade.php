<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your One-Time Password Request!</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #2F3044; background-color: #edf2f7;">

    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: 0 auto; border-collapse: collapse;">
        <tr>
            <td align="center" style="max-height: 50px; width: auto; padding:40px;" >
                <a href="https://pakistan.savethechildren.net/" rel="noopener" target="_blank">
                    <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" style="max-height: 50px; width:50px !important;" />
                </a>
            </td>
        </tr>
        <tr>
            <td align="left">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #ffffff; border-radius: 6px;">
                    <tr>
                        <td style="padding: 20px;">
                            <div style="font-size: 17px; padding-bottom: 30px;">
                                <strong>Your One-Time Password Request!</strong>
                            </div>
                            <div style="padding-bottom: 30px;">
                                Dear Guest User,<br/>
                                Your request has been processed successfully.
                            </div>
                            <div style="text-align: center; padding-bottom: 40px;">
                                <p>Your One-Time Password is</p>
                                <button style="padding: 8px 20px; font-size: 14px; border-radius: 4px; color: #ffffff; background-color: #009ef7; border: 0;">
                                    {{ $details['otp'] }}
                                </button>
                            </div>
                            <div style="padding-bottom: 30px;">
                                Do not reply to this email. Please contact
                                <a href="mailto:usama.qayyum@savethechildren.org">Administrator</a> for any query.
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" style="font-size: 13px; padding: 20px; color: #6d6e7c;">
            </td>
        </tr>
    </table>

</body>
</html>
