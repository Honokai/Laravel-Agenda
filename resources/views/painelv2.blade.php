@extends('layouts.administrativov2')

@section('conteudo')
<div class="content" style="margin-top:10px">
    <div class="conteudo" id="conteudo">
        <div class="card" id="fotoupload" style="margin-left: 20px; margin-right: 20px;">
            <div class="card-body" >
            <h5 class="card-title">Selecionar foto <a onclick="fecharFoto()" style="float: right">&times;</a></h5> 
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
    <div id="todosEventos" class="card"  style="margin-left: 20px; margin-right: 20px; margin-top: 10px">
        <div class="card-body">
          <h5 class="card-title centro">Eventos para hoje de todos usuários</h5>
          <hr>
        <h6 class="card-subtitle mb-2 text-muted"></h6>
          <div class="row" style="text-align:center;font-weight:bold">
            <div class="col-4">
                <p class="card-text">Usuário</p>
            </div>
            <div class="col-4">
              <p class="card-text">Nome</p>
            </div>
            <div class="col-4">
              Data
            </div>
          </div>
          <div class="row" style="text-align:center">
                <div class="col-4"> 
                    @foreach ( $eventos as $evento)
                    {{$evento->usuario}}
                    @endforeach
                </div>
                <div class="col-4"> 
                @foreach ( $eventos as $evento)
                  {{$evento->nome}}
                @endforeach
              </div>
              <div class="col-4"> 
                @foreach ( $eventos as $evento)
                  {{date("d/m/Y H:i:s",strtotime($evento->data))}}
                @endforeach
              </div>
          </div>
        </div>
    </div>
</div>



@endsection