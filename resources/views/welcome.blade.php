<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/Login/login.css') }}">
    <title>Robin's App</title>
</head>
<body class="flexCenterColumn black">
    <div class="formWrapper flexCenterColumn">
        <div class="logo flexCenterColumn">
            <img src="{{ asset('imgs/logo.png') }}" alt="Logo">
        </div>
        <div class="title">
            <h2>Robbin's App</h2>
        </div>

        @if (session('message'))
            @if (session('message') == "si")
                <div class="success message">
                    Sí está registrado
                </div>
            @elseif (session('message') == "no")
                <div class="fail message">
                    ¡Verifique sus credenciales!
                </div>
            @endif
        @endif

        <form method="POST" action="{{ route('login') }}" class="flexCenterColumn">
            @csrf
            <div class="formField">
                <label for="user">Ingrese su usuario:</label>
                <input type="text" name="user" id="user">
            </div>
            <div class="formField">
                <label for="password">Ingrese su clave:</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="formField">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>
</body>
</html>