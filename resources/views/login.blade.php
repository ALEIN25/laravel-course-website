<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <title>Document</title>
</head>
<body>
<h1>Login</h1>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required autofocus>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div>
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember Me</label>
    </div>

    <button type="submit">Login</button>
</form>
</body>
</html>