<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda</title>
    <script type="text/javascript" src="js/sweetalert.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="js/tooltip.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/main.css"/>
    <link rel="stylesheet" type="text/css" href="style/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/app.css"/>
    <script type="text/javascript" src="mask/jquery.mask.js"></script>  
    <script type="text/javascript" src="js/painel.js"></script> 
    <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>
  <!--  TESTE -->
    <link rel="stylesheet" type="text/css" href="style/jquery.dataTables.min.css"/>
    <link href='packages/core/main.css' rel='stylesheet' />
    <link href='packages/daygrid/main.css' rel='stylesheet' />
    <link href='packages/list/main.css' rel='stylesheet' />
    <link href='packages/timegrid/main.css' rel='stylesheet' />
    <link href='packages/bootstrap/main.css' rel='stylesheet' />

    
    <script src='packages/core/main.js'></script>
    <script src='packages/daygrid/main.js'></script>
    <script src='packages/timegrid/main.js'></script>
    <script src='packages/interaction/main.js'></script>
    <script src='packages/core/locales/pt-br.js'></script>
    <script src='packages/bootstrap/main.js'></script>
    <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
    <script src='packages/list/main.js'></script>
    <script type="text/javascript" src="js/validacao.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          timezone: 'America/Fortaleza',
          locale:'pt-br',
          height: 600,
          overflow: true,
          contentHeight: "auto",
          contentWidth: "auto",
          plugins: [ 'interaction','dayGrid', 'timeGrid', 'bootstrap', 'list'],
          selectable: true,
          navLinks: true,
          editable: true,
          eventLimit: true, // for all non-TimeGrid views
          views: {
            timeGrid: {
              eventLimit: 2 // adjust to 6 only for timeGridWeek/timeGridDay
            },
            dayGrid: {
              eventLimit:2
            }
          },
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridDay,timeGridWeek,dayGridMonth,listWeek'
          },
          eventSources: [{
            url: "api/eventos/"+{{Auth::id()}},
              /*extraParams: {
                login: {{Auth::id()}},
              },*/  
              textColor: 'white'
            }
          ],
          eventRender: function(info) {
            if(info.view.type == 'dayGridMonth' || info.view.type == 'listWeek'){
              var user = document.createElement('div');
              user.innerHTML = info.event.extendedProps.description;
              info.el.lastChild.lastChild.appendChild(user);
              if(info.event.extendedProps.atividade == "PV"){
                info.el.style.backgroundColor  = "#ff6347";
                info.el.style.borderColor = "black";
              }
              if(info.event.extendedProps.atividade == "SV"){
                info.el.style.backgroundColor  = "#ffa900";
                info.el.style.borderColor = "blue";
              }
            }else{
              if(info.event.extendedProps.atividade == "PV"){
                info.el.style.backgroundColor  = "#ff6347";
                info.el.style.borderColor = "black";
              }
              if(info.event.extendedProps.atividade == "SV"){
                info.el.style.backgroundColor  = "#ffa900";
                info.el.style.borderColor = "blue";
              }
              var user = document.createElement('div');
              user.style.display = 'inline-block';
              user.innerHTML = info.event.extendedProps.description;
              info.el.appendChild(user);
            }
          },
          dateClick: function(dateClickInfo ){
            document.getElementById("novadata").value = dateClickInfo.dateStr;
            $("#criarevento").modal('toggle');
          },
          eventDrop: function(info){
            timezone: 'America/Noronha';
            $.ajax({
              url: "api/update/evento.php",
              method: 'POST',
              data: {
                login: {{Auth::id()}},
                data: info.event.start.toString(),
                nome: info.event.title
              }
            });
          },
          eventResize: function(info){
            timezone: 'America/Noronha';
            $.ajax({
              url: "api/update/evento.php",
              type: 'POST',
              data: {
                login: {{Auth::id()}},
                data: info.event.start.toString(),
                dataend: info.event.end.toString(),
                nome: info.event.title
              },
            });
          },  
          eventClick: function(info){
            
            $.ajax({
              url:"api/get/dadoevento.php",
              type: 'GET',
              data: {
                id: info.event.id,
                login: {{Auth::id()}},
                data: info.event.start.toString(),
                nome: info.event.title
              },
              success: function(data){
                try {
                  let resposta = JSON.parse(data);
                  resposta = resposta[0];
                  document.getElementById("idevento").value = resposta.id;
                  document.getElementById("atividade").value = resposta.tipo_atividade;
                  document.getElementById("status").value = resposta.status_atividade;
                  document.getElementById("nome").value = resposta.nome;
                  document.getElementById("celular").value = resposta.celular;
                  document.getElementById("endereco").value = resposta.endereco;
                  document.getElementById("cidade").value = resposta.cidade;
                  document.getElementById("data").value =  resposta.data.substring(0,10);
                  document.getElementById("hora").value = resposta.data.substring(11,19);
                  document.getElementById("recomendante").value = resposta.recomendante;
                  document.getElementById("recomendacoes").value = resposta.recomendações;
                  document.getElementById("qtderecs").value = resposta.q_rec;
                  document.getElementById("atuacao").value = resposta.atuacao;
                  document.getElementById("potencial").value = resposta.pot_negocio;
                  document.getElementById("observacoes").value = resposta.observacao;
                } catch (error) {
                  console.log(error);
                }
                
              },
              error: function(data){
                console.log(data);
              }
            });
            $("#tudo").modal('toggle');
          }
        });
        calendar.render();
      });
    </script>
</head>
<body>  
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
      <img class="logo" src="./img/logo.png" >
        <div class="container">
            <a class="navbar-brand" href="{{ url('/agenda') }}">
                {{ config('app.name', 'Agenda') }}
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
                                Bem vindo, {{ Auth::user()->nome }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('painel') }}">
                                  {{ __('Painel administrativo') }}
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
    <p></p>
    <input type="text" id='login' style="display: none;" value="{{ Auth::id() }}">
    <input type="text" id='idevento' style="display: none;" value="">
    
    @yield('conteudo')
</body>
</html>