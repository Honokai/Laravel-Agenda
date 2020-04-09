@extends('layouts.administrativo')

@section('conteudo')
<div class="container" style="text-align:center">
    <div class="row">
      <div class="col-sm">
        <div class="card" style="width: 30rem;">
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
                <div class="col-sm" style="color:green">
                  Online
                </div>
              </div>
                
            @endforeach
            </div>  
          </div>
        </div>
      </div>
      <div class="col-sm">
        <div class="card" style="width: 30rem;">
          <div class="card-body">
            <h5 class="card-title">Resumo geral de eventos</h5>
          <h6 class="card-subtitle mb-2 text-muted"></h6>
          @foreach ( $eventos as $evento)
            <p class="card-text">{{$evento->nome}}</p>
          @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection