<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{$user->name}} has invited you to join their project.
    <br />
    <a href="{{route('accept', $invitation->token)}}">
        <button>Join the Project</button>
    </a>
</body>
</html>