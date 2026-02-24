<!DOCTYPE html>
<html>
<head>
    <title>Приветственное письмо</title>
</head>
<body>
<h1>Привет, {{ $userDto->name }}!</h1>

<p>Спасибо за регистрацию. Твой email: {{ $userDto->email }} подтвержден.</p>

<p>Удачного дня!</p>
</body>
</html>
