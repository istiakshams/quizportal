<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        p {
            font-size: 16px;
        }

        .signature {
            font-style: italic;
        }
    </style>
</head>
<body>
<div>
    <p><strong>Profile</strong>: {{ $prof }}</p>
    <p><strong>Status</strong>: {{ ucfirst($status) }}</p>
    <p><strong>Message</strong>: {{ $msg }}</p>
</div>
</body>
</html>