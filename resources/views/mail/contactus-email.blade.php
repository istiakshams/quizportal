<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        h2 {
            font-size: 20px;
            font-weight: bold;
        }

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
        <h2>New Message Details:</h2>
        <p><strong>Name</strong>: {{ $name }}</p>
        <p><strong>Email</strong>: {{ $email }}</p>
        <p><strong>Message</strong>: {{ $msg}}</p>
    </div>
</body>

</html>