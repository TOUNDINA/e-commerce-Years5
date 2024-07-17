<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Your Password</h1>
    <p>If you've requested to reset your password, please click the following button:</p>
    <a href="{{ config('app.url_front') }}/reset-password/{{$token}}"><button>Reset Password</button></a>
    <p>If you didn't request a password reset, you can ignore this email.</p>
</body>
</html>
