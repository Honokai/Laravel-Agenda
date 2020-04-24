<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Agenda - Inicio</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="css/welcome.css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/agenda') }}">Agenda</a>
                    @else
                        <a href="{{ route('login') }}">Entrar</a>
                    @endauth
                    <img src="./img/logo.png">
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{config('app.name','Agenda')}}
                </div>
            </div>
        </div>
    </body>
</html>
