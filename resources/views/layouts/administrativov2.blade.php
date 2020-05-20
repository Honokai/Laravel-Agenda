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
        <div class="icon">
            <a id="menu" href="#" style="position: absolute">Menu</a>
            <a id="close" href="#" style="visibility:hidden; position: absolute">Fechar menu</a>
        </div>
        <img src="https://logospng.org/download/ebay/logo-ebay-256.png" class="logo">
        <a href="#" class="direita">Bem vindo, {{Auth::user()->nome}}</a>
    </div>
    <div id="menulateral" class="barralateral">
        <div id="backperfil" class="backperfil">
            <img class="perfil" id="perfil" src="profile/1/1.png" alt="" srcset="">
        </div>
        
        <p class="nome">Usuário: <br>{{Auth::user()->nome}}</p>
        <a href="#">Alterar foto</a>
        <a href="#"> Relatórios</a>
        <a href="#">Usuários</a>
        <a href="#">Páginas</a>
    </div>
    
    <div class="content" style="margin-top:10px">
        <div class="conteudo" id="conteudo">
            <div class="card" id="fotoupload" style="margin-left: 20px; margin-right: 20px; ">
                <div class="card-body" style="border: 3px solid black">
                  <h5 class="card-title">Selecionar foto</h5>
                  <hr>
                  <div class="row" style="text-align:center;font-weight:bold">
                    <div class="col-sm">
                      <form id="upload" enctype="multipart/form-data" method="post">
                        <input type="text" id="userid" name="id" style="display:none" value="{{Auth::id()}}">
                        <input id="foto" type="file" name="arquivo">
                        <p></p>
                      </form>
                      <button id="enviarfoto" class="btn btn-primary">Enviar</button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    

<!--
    <main class="main" style="width:100%">
        <p></p>
        @yield('conteudo')
    </main>

-->
</body>
</html>
