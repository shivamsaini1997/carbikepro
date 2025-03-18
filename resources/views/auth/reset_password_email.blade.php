<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #333333;
        }
        .content {
            line-height: 1.8;
            color: #333333;
            padding-bottom: 20px;
        }
        .content p {
            margin: 0;
            margin-bottom: 15px;
            font-size: 16px;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666666;
            padding-top: 20px;
        }
        .footer p {
            margin: 0;
            margin-bottom: 10px;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Password Reset Request</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>You recently requested to reset your password for your account. Click the button below to reset it.</p>
            <p style="text-align: start;">
                <a href="{{$url}}"  class="button btn btn-primary" style="color:#fff;">Reset Your Password</a></p>
            <p>If you did not request a password reset, please ignore this email or reply to let us know.</p>
            <p>Thank you,<br>Car Bike</p>
        </div>

    </div>
</body>
</html>

