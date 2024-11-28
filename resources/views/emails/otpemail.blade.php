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
                    <img alt="Logo" src="https://mis-sc.pk/assets/media/logos/logo.png"/>
                </a>
            </td>
        </tr>
        <tr>
            <td align="left">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #ffffff; border-radius: 6px;">
                    <tr>
                        <td style="padding: 20px; font-size: 17px;">
                            <strong>Your One-Time Password Request!</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px;">
                            Dear Guest User,<br/>
                            Your request has been processed successfully.
                        </td>
                    </tr>
                    <tr>
                       
                        <td style="text-align: center; padding: 20px;">
                            <p>Your One-Time Password is</p>
                            <div id="copyButton" style="  padding: 8px 20px; font-size: 14px; border-radius: 4px; color: #ffffff; background-color: #009ef7; border: 0;">
                                {{ $details['otp'] }}
                            </div>
                        </td>
                       
                    </tr>
                    <tr>
                        <td style="padding: 20px;">
                            Do not reply to this email. Please contact
                            <a href="mailto:usama.qayyum@savethechildren.org" style="color: #009ef7; text-decoration: none;">Administrator</a> for any query.
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
    <script>
        document.getElementById("copyButton").addEventListener("click", function() {
            copyToClipboard("{{ $details['otp'] }}");
            alert("OTP copied to clipboard!");
        });
    
        function copyToClipboard(text) {
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = text;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
        }
    </script>
</body> 
</html>
