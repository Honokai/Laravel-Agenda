@extends('layouts.administrativo')
{{-- refatorar esta view   --}}

@section('conteudo')

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 padding-no">
        <div class="container-menu" id="container-menu">
          <div class="perfilF">
            <img id="imagemperfil" class="card-img-top" src="{{file_exists("profile/".Auth::id()."/".Auth::id().".png")==true ? "profile/".Auth::id()."/".Auth::id().".png" : "profile/padrao.png"}}" alt="Card image cap">
          </div>
          <div class="nome">
            Usuário: <br>
            <h5 class="card-title" style="font-weight:bold">{{Auth::user()->nome}}</h5>
          </div>
          <div class="link">
            <div class="text">Trocar senha **</div>
          </div>
          <div class="link">
            <div class="text" id="alterarFoto"> Trocar foto</div>
          </div>
          <div class="link">
            <div class="text" id="cardrelatorio">Relatorios</div>
          </div>
          @if (Auth::user()->acesso == 777)
            <div class="link">
              <div class="text" id="controleUsuario">Controle de usuário **</div>
            </div>
          @endif
        </div>
      </div>

      <div class="col-sm-9" id="content" style="text-align: center">
        
        <div class="card" id="fotoupload" style="overflow: hidden">
          <div class="card-body bg-dark card-dark">
            <h5 class="card-title">Selecionar foto <close id="fecharFoto"> &times; </close></h5>
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
        
        <div class="card" id="relatorio">
          <div class="card-body bg-dark card-dark">
            <h5 class="card-title">Gerar Relatórios <close id="fecharRelatorio"> &times; </close></h5>
            <hr>
            <div class="row">
              <div class="col-sm" id="divid">
                <div class="input-group mb-3" style="float:left">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Tipo de relatório</span>
                  </div>
                  <select class="custom-select" id="tiporelatorio">
                    <option value=""></option>
                    <option value="0">Relatório Geral - Usuário</option>
                    @if(Auth::user()->acesso == 777)
                      <option value="771">Relatório Geral - Todos</option>
                      <option value="772">Relatório Tipo2 - Todos</option>
                    @endif
                  </select> 
                </div>
                <div class="input-group mb-3" style="float:left">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Nome da planilha</span>
                  </div>
                  <input type="text" id="nomeplanilha" class="form-control">
                </div>
                <button id="enviarrelatorio" class="btn btn-primary">Enviar</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Parte de controle de usuário -->
        <div  id="controle" style="display: none">
          <div class="card"></div>
            <div class="card-body bg-dark card-dark">
              <h5 class="card-title">Usuários <close id="fecharControle"> &times; </close></h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
              <p class="card-text">
                <div class="container">
                  <div class="row">
                    <div class="col-12" style="text-align: right">
                      <button class="btn btn-primary btn-sm" onclick="abrirForm()">NOVO USUÁRIO +</button>
                    </div>
                  </div>
                  <div class="row" style="font-weight: bolder">
                    <div class="col-4">
                      <p class="card-text">Nome</p>
                    </div>
                    <div class="col-4">
                      Status
                    </div>
                    <div class="col-4">
                      Ações
                    </div>
                  </div>
                @foreach ( $usuarios as $usuario)
                  <div class="row" style="padding-top: 2px; padding-bottom: 2px;">
                    <div class="col-4">
                      <input class="card-text" style="display: none" id="{{$usuario->nome}}" value="{{$usuario->id}}">
                      <p class="card-text">{{$usuario->nome}}</p>
                    </div>
                    @if($usuario->online == 1)
                      <div class="col-4" style="text-align: center !important">
                        <div style="color:white;background-color:#6ab263;border-radius:5px;width:60px; display:inline-block">Online</div>
                      </div>
                    @else 
                      <div class="col-4" style="text-align: center !important">
                        <div style="color:white;background-color:#b65959;border-radius:5px;width:60px; display:inline-block">Offline</div>
                      </div>
                    @endif
                    <div class="col-4">
                      <div class="dropdown" style="text-align:center">
                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Ações
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" onclick="deletarUsuario(this.parentElement)" href="#">Excluir usuário</a>
                          <a class="dropdown-item" href="#">Modificar usuário</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </p>
            </div>
          </div>
          <p></p>
          <div class="card" id='formUsuario' style="display: none">
            <div class="card-body">
              <h4 class="card-title">Criar usuário</h4>
              <div class="row">
                <div class="col-12">
                  @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                  @endif
                  <form action="{{ url('registro') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-6">
                        <div class="input-group mb-3" style="float:left">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="">Usuário</span>
                          </div>
                          <input type="text" name="nome" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="input-group mb-3" style="float:left">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="">E-mail</span>
                          </div>
                          <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="" required>Senha</span>
                          </div>
                          <input type="password" name="senha" class="form-control @error('senha') is-invalid @enderror">
                          @error('senha')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="">Confirmação de senha</span>
                          </div>
                          <input type="password" name="senha_confirmation" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="">Nível de acesso</span>
                      </div>
                      <select name="acesso" class="custom-select form-control">
                        <option value=""></option>
                        <option value="0">Usuário comum</option>
                        <option value="777">Administrador</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-success">Criar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <p></p>
      </div>  <!-- fim de div coluna -->

      

    </div>
  </div>
<script>

  function deletarUsuario(elemento){
    let divParent = elemento.parentElement
    divParent = divParent.parentElement
    divParent = divParent.parentElement
    let id = divParent.querySelectorAll('input')
    console.log(id[0].value)
    
  }

  function abrirForm(){
    document.getElementById('formUsuario').style.display = 'block';
  }

</script>
<!--
<div class="container-fluid">
  <div class="col-12">
    <div class="row">
      <div id="cont" class="col col-3">
        <div class="card" style="min-width:150px; text-align: center">
          <img id="imagemperfil" class="card-img-top" src="{{file_exists("profile/".Auth::id()."/".Auth::id().".png")==true ? "profile/".Auth::id()."/".Auth::id().".png" : "profile/padrao.png"}}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title" style="font-weight:bold">{{Auth::user()->nome}}</h5>
            <button id="alterarFoto" class="btn btn-primary">Trocar foto</button>
            <p></p>
            <button id="cardrelatorio" class="btn btn-primary" >Relatorio</button>
          </div>
        </div>
      </div>
      <div id="cont1" class="col col-9">
        <div class="card" id="fotoupload" style="overflow: hidden">
          <div class="card-body">
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
</div>

<div id="tudo" style="text-align:center;margin-left:4%;width:100%">
  <div class="row">
    <div id="cont" class="col-sm-2">
      <div class="card" style="width: 90%; min-width:150px">
        <img id="imagemperfil" class="card-img-top" src="{{file_exists("profile/".Auth::id()."/".Auth::id().".png")==true ? "profile/".Auth::id()."/".Auth::id().".png" : "profile/padrao.png"}}" alt="Card image cap">
          <div class="card-body">
          <h5 class="card-title" style="font-weight:bold">{{Auth::user()->nome}}</h5>
            <button id="alterarFoto" class="btn btn-primary">Trocar foto</button>
            <p></p>
            <button id="cardrelatorio" class="btn btn-primary" >Relatorio</button>
        </div>
      </div>
    </div>

    <div id="cont1" class="col-md-4">
      <div class="card" id="fotoupload" style="width: 90%; display: none">
        <div class="card-body">
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
      <p id="para"style="display:none"></p>
      <div class="card" id="relatorio" style="width: 90%; display: none">
        <div class="card-body">
          <h5 class="card-title">Gerar Relatórios</h5>
          <hr>
          <div class="row" style="text-align:center;font-weight:bold">
            <div class="col-sm">
            <div class="input-group mb-3" style="float:left">
              <div class="input-group-prepend">
                <span class="input-group-text" id="">Tipo de relatório</span>
              </div>
              <select class="custom-select" id="tiporelatorio">
                <option value=""></option>
                <option value="todos">Todos</option>
                <option value="usuário">Usuário atual</option>
              </select> 
            </div>
            <div class="input-group mb-3" style="float:left">
              <div class="input-group-prepend">
                <span class="input-group-text" id="">Nome da planilha</span>
              </div>
              <input type="text" id="nomeplanilha" class="form-control">
            </div>
              <button id="enviarrelatorio" class="btn btn-primary">Enviar</button>
            </div>
          </div>
        </div>
      </div>
      <p id="par"style="display:none"></p>
      <div id="cont2" class="card" style="width: 90%;">
        <div class="card-body">
          <h5 class="card-title">Eventos para hoje</h5>
          <hr>
        <h6 class="card-subtitle mb-2 text-muted"></h6>
          <div class="row" style="text-align:center;font-weight:bold">
            <div class="col-6">
              <p class="card-text">Nome</p>
            </div>
            <div class="col-6">
              Data
            </div>
          </div>
          <div class="row" style="text-align:center">
              <div class="col-6"> 
                @foreach ( $eventos as $evento)
                  {{$evento->nome}}
                @endforeach
              </div>
              <div class="col-6"> 
                @foreach ( $eventos as $evento)
                  {{date("d/m/Y H:i:s",strtotime($evento->data))}}
                @endforeach
              </div>
          </div>
        </div>
      </div>
      <p></p>
      <div id="cont3" class="card" style="width: 90%;">
        <div class="card-body" style="text-align:left">
          <h5 class="card-title" >Usuários online</h5>
          <hr>
          <h6 class="card-subtitle mb-2 text-muted">Total: {{$user = DB::table('usuarios')->where('online',1)->count()}}</h6>
          <div class="container">
            <div class="row">
              <div class="col-6">
                <p class="card-text">Nome</p>
              </div>
              <div class="col-6">
                Status
              </div>
            </div>
          @foreach ( $usuarios as $usuario)
            <div class="row">
              <div class="col-6">
                <p class="card-text"><strong>{{$usuario->nome}}</strong></p>
              </div>
              <div class="col-6">
                <div style="color:white;background-color:#6ab263;border-radius:5px;width:60px;text-align:center">Online</div>
              </div>
            </div>
          @endforeach
          </div>  
        </div>  
      </div>
    </div>

    <div class="col-md-6">
      <div class="card" style="width: 90%">
        <div class="card-header">{{ __('Criar novo acesso') }}</div>       
          <div class="card-body">
            <form method="POST" id="form" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirme a senha') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row">
                  <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de acesso') }}</label>

                  <div class="col-md-6">
                      <select class="custom-select" id="tipo">
                        <option value="0">Comum</option>
                        <option value="1">Administrador</option>
                      </select>
                  </div>
                </div>     
                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" id="submitregistro" class="btn btn-primary">
                      {{ __('Registrar') }}
                    </button>
                  </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
<p></p>
-->
@endsection