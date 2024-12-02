<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>У вас уже есть аккаунт?</title>
</head>
<body>
<h2>У вас уже есть аккаунт?</h2>

<a href="{{ route('login') }}" class="button">Да, войти</a>

<a href="{{ route('register', ['type' => $type]) }}" class="button">Нет, зарегистрироваться</a>
</body>
</html>
