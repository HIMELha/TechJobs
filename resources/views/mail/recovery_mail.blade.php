<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery - TechJobs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            padding: 12px 0;
            text-align: center;
            color: white;
            background-color: #05c5e7;
        }
        .content {
            padding: 20px;
        }
        .footer {
            padding: 20px;
            text-align: center;
            background-color: #ffffff;
        }
        .footer p {
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Password Recovery - TechJobs</h2>
        </div>
        <div class="content">
            <p>Hello {{ $name }},</p>
            <p>We received a request to reset your password. Please use the following link reset your password:</p>
            <a href="{{ $link }}">Reset Password</a>
            <p>If you did not request this password reset, you can ignore this email.</p>
            <p>Thank you.</p>
        </div>
        <div class="footer">
            <p>This is an automated message from TechJobs, please do not reply to this email.</p>
        </div>
    </div>

</body>
</html>
