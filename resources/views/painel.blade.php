@extends('layouts.administrativo')
{{-- refatorar esta view   --}}

@section('conteudo')
<div class="" style="text-align:center;margin-left:1%;width:100%">
  <div class="row">
    <div class="col-2">
      <div class="card" style="max-width: 300px;">
        <img class="card-img-top" src="{{file_exists("profile/".Auth::id()."/".Auth::id().".png")==true ? "profile/".Auth::id()."/".Auth::id().".png" : "profile/padrao.png"}}" alt="Card image cap">
          <div class="card-body">
          <h5 class="card-title" style="font-weight:bold">{{Auth::user()->nome}}</h5>
            <p class="card-text">Vejamos</p>
            <button id="alterarperfil" class="btn btn-primary">Alterar perfil</button>
            <p></p>
            <button id="trocarfoto" class="btn btn-primary">Trocar foto</button>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card" style="width: 27rem;">
        <div class="card-body">
          <h5 class="card-title">Eventos para hoje</h5>
          <hr>
        <h6 class="card-subtitle mb-2 text-muted"></h6>
          <div class="row" style="text-align:center;font-weight:bold">
            <div class="col-sm">
              <p class="card-text">Nome</p>
            </div>
            <div class="col-sm">
              Data
            </div>
          </div>
          <div class="row" style="text-align:center">
              <div class="col-sm"> 
                @foreach ( $eventos as $evento)
                  {{$evento->nome}}
                @endforeach
              </div>
              <div class="col-sm"> 
                @foreach ( $eventos as $evento)
                  {{date("d/m/Y H:i:s",strtotime($evento->data_ag))}}
                @endforeach
              </div>
          </div>
        </div>
      </div>
      <p></p>
      <div class="card" style="width: 27rem;">
        <div class="card-body" style="text-align:left">
          <h5 class="card-title" >Usuários online</h5>
          <hr>
          <h6 class="card-subtitle mb-2 text-muted">Total: {{$user = DB::table('usuarios')->where('online',1)->count()}}</h6>
          <div class="container">
            <div class="row">
              <div class="col-sm">
                <p class="card-text">Nome</p>
              </div>
              <div class="col-sm">
                Status
              </div>
            </div>
          @foreach ( $usuarios as $usuario)
            <div class="row">
              <div class="col-sm">
                <p class="card-text"><strong>{{$usuario->nome}}</strong></p>
              </div>
              <div class="col-sm">
                <div style="color:white;background-color:#6ab263;border-radius:5px;width:60px;text-align:center">Online</div>
              </div>
            </div>
          @endforeach
          </div>  
        </div>
      </div>
    </div>

    <div class="col-6">
      <div class="card" style="width:30rem">
        <div class="card-header">{{ __('Criar novo acesso') }}</div>       
          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                        <option value="comum">Comum</option>
                        <option value="admnistrador">Administrador</option>
                      </select>
                  </div>
                </div>     
                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
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
@endsection