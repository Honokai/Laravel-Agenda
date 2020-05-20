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
    <script src="js/painel.js"></script>
    <script type="text/javascript" src="js/sweetalert.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   
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
    <link rel="stylesheet" href="css/painelv2.css">
</head>
<body>

    <div class="top-barra">
      
        <a id="menu" href="#" style="position: absolute">
            <div class="barra1"></div>
            <div class="barra2"></div>
            <div class="barra3"></div>
        </a>
        
        <img src="https://logospng.org/download/ebay/logo-ebay-256.png" class="logo">
        <a href="#" class="direita">Bem vindo, {{Auth::user()->nome}}</a>
    </div>
    <div id="menulateral" class="barralateral">
        <div id="backperfil" class="backperfil">
            <img class="perfil" id="perfil" src="profile/1/1.png" alt="" srcset="">
        </div>
        <p class="nome">Usuário: <br>{{Auth::user()->nome}}</p>
        <a href="#" id="alterarFoto">Alterar foto</a>
        <a href="#" id="Relatórios"> Relatórios</a>
        <a href="#" id="Usuários">Usuários</a>
        <a href="#" id="Páginas">Páginas</a>
    </div>

    <main class="main" style="width:100%">
        <p></p>
        @yield('conteudo')
    </main>

</body>
</html>
