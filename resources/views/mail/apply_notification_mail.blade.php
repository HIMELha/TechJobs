<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - New Job Application Received </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h1 {
            color: #333;
        }
        p {
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>New Job Application Received for {{ $title }}</h1>
    <p>Hello,{{ $employer }}</p>
    <p>A new job application has been received through your website. Please review the applicant's details as soon as possible. <a href="">Click here to check</a></p>
    <p>Thank you!</p>
</div>

</body>
</html>
