<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=a, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>
    <a href="{{ route('mahasiswa.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
    <form action="{{ route('mahasiswa.logout') }}" method="POST" id="logout-form">
        @csrf
    </form>
</p>
</body>
</html>