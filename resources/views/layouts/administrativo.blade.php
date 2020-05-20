<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/teste.js"></script>
    <script type="text/javascript" src="js/sweetalert.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="css/painel.css" rel="stylesheet">
    <style>
       @media only screen and (max-width: 629px) {

            #cont {
                width: 100%;
                margin-left: 5%;
            }

            #cont1 {
                width: 100%;
             
            }

            #cont2 {
                width: 100%;
                
            }

            #cont3 {
                width: 100%;
                
            }
            
            #cont4 {
                width: 100%;

            }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <img style="width:50px;height:40px; border-radius:5px" src="./img/logo.png" >
            <div class="container">
                
                <a class="navbar-brand" href="{{ url('/agenda') }}">
                    {{ __('Administração') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                            </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->nome }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="agenda">
                                    {{ __('Agenda') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    
                    </ul>
                </div>
            </div>
        </nav>

        <section id="opcao-lateral">
            <div id="opcao-conteudo">
                <img id="imagemperfil" class="card-img-top" src="{{file_exists("profile/".Auth::id()."/".Auth::id().".png")==true ? "profile/".Auth::id()."/".Auth::id().".png" : "profile/padrao.png"}}" alt="Card image cap">
            </div>
        </section>

        <main class="main" style="width:100%">
            <p></p>
            @yield('conteudo')
        </main>
    </div>
</body>
</html>
