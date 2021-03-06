@extends('layouts.agenda')

@section('conteudo')
    <div id="calendar"></div>

    <div class="modal" id="tudo" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <!-- Criar campo nível na tabela e trabalhar com ele, criar campos de objetivos no usuário, não podem ser null -->
                <div class="modal-body" >
                    <div class="row">
                        <div class="col-sm">                                   
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Ativ.</span>
                                </div>
                                <select type="text" id='atividade' class="form-control custom-select" aria-label="Categoria" aria-describedby="basic-addon1">
                                    <option value=""></option>
                                    <option value="PV">PV</option>
                                    <option value="SV">SV</option>
                                    <option value="VR">VR</option>
                                    <option value="LIG">LIG</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Status</span>
                                </div>
                                <select type="text" id="status" class="form-control custom-select" aria-label="Categoria" aria-describedby="basic-addon1">
                                    <option value=""></option>
                                    <option value="Aberto">Aberto</option>
                                    <option value="ANF">ANF</option>
                                    <option value="FLW">FLW</option>
                                    <option value="AB">AB</option>
                                    <option value="TED">TED</option>
                                    <option value="D">D</option>
                                    <option value="X">X</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Nível</span>
                                </div>
                                <select type="text" id="status" class="form-control custom-select" aria-label="Categoria" aria-describedby="basic-addon1">
                                    <option value=""></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Nome</span>
                                </div>
                                <input type="text" id="nome" class="form-control" aria-label="cliente" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Celular</span>
                                </div>
                                <input type="text" id="celular" class="form-control celular">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Endereço</span>
                                </div>
                                <input type="text" id="endereco" class="form-control endereco">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Cidade</span>
                                </div>
                                <input type="text" id="cidade" class="form-control cidade">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Data</span>
                                </div>
                                <input type="date" id="data" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Horário</span>
                                </div>
                                <input type="text" id="hora" class="form-control hora" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Recomendante</span>
                                </div>
                                <input type="text" id="recomendante" class="form-control ">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Recomendações</span>
                                </div>
                                <input type="text" id="recomendacoes" class="form-control ">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Qtde recs</span>
                                </div>
                                <input type="number" id="qtderecs" class="form-control ">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Atuação</span>
                                </div>
                                <select id="atuacao" class="custom-select form-control">
                                    <option value=""></option>
                                    <option value="HUNTER">Hunter</option>
                                    <option value="FARMER">Farmer</option>
                                </select> 
                            </div>
                        </div>

                    </div>
                   <div class="row">
                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Potencial do negócio</span>
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="text" id="potencial" class="form-control potencial">
                            </div>
                        </div>
                   </div>
                    <!-- Campos ocultos, necessários para o correto posicionamento do evento-->
                    <div class="row">
                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left;display:none">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Data</span>
                                </div>
                                <input type="date" id='datainicio' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        
                        <div class="col-sm">
                            <div class="input-group mb-3" style="float:left;display:none">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Horário</span>
                                </div>
                                <input type="text" id='horarioinicio' class="form-control hora" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <!-- Termina aqui-->
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Observações</span>
                                </div>
                                <textarea class="form-control" style="resize: none;" id="observacoes" aria-label="With textarea"></textarea>
                            </div>
                        </div>
                    </div>
                    <div style="text-align:right">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Últimas observacoes
                        </button>
                    </div>
                    <div id="obsAnteriores">
                        
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="enviar" class="btn btn-success">Salvar</button>
                        <button type="button" id="excluirevento" class="btn btn-primary btn-danger" data-dismiss="modal">Excluir evento</button>
                    </div>

                </div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="criarevento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Criar atividade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action=""> 
                    <div class="modal-body">    
                        <div class="row">
                            <div class="col-sm">                                   
                                <div class="input-group mb-3" style="float:left">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Atividade</span>
                                    </div>
                                    <select type="text" id='novoatividade' class="form-control custom-select" aria-label="Categoria" aria-describedby="basic-addon1">
                                        <option value=""></option>
                                        <option value="PV">PV</option>
                                        <option value="SV">SV</option>
                                        <option value="VR">VR</option>
                                        <option value="LIG">LIG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="input-group mb-3" style="float:left">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Status</span>
                                    </div>
                                    <select type="text" id="novostatus" class="form-control custom-select" aria-label="Categoria" aria-describedby="basic-addon1">
                                        <option value=""></option>
                                        <option value="Aberto">Aberto</option>
                                        <option value="ANF">ANF</option>
                                        <option value="FLW">FLW</option>
                                        <option value="AB">AB</option>
                                        <option value="TED">TED</option>
                                        <option value="D">D</option>
                                        <option value="X">X</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="input-group mb-3" style="float:left">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Nome</span>
                                    </div>
                                    <input type="text" id="novonome" class="form-control" aria-label="cliente" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="input-group mb-3" style="float:left">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Celular</span>
                                    </div>
                                    <input type="text" id="novocelular" class="form-control celular" required=''>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <div class="input-group mb-3" style="float:left">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Endereço</span>
                                    </div>
                                    <input type="text" id="novoendereco" class="form-control endereco">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <div class="input-group mb-3" style="float:left">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cidade</span>
                                    </div>
                                    <input type="text" id="novocidade" class="form-control cidade">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm col-6">
                                <div class="input-group mb-3" style="float:left;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Data</span>
                                    </div>
                                    <input type="date" name="data" id="novadata" class="form-control" value="" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-sm col-6">
                                <div class="input-group mb-3" style="float:left;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Horário</span>
                                    </div>
                                    <input type="text" id="novahora" class="form-control hora" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="input-group mb-3" style="float:left">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Recomendante</span>
                                    </div>
                                    <input type="text" id="novorecomendante" class="form-control ">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="input-group mb-3" style="float:left">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Recomendações</span>
                                    </div>
                                    <input type="text" id="novorecomendacoes" class="form-control ">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm">
                                <div class="input-group mb-3" style="float:left">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Qtde recs</span>
                                    </div>
                                    <input type="number" id="novoqtderecs" class="form-control ">
                                </div>
                            </div>

                            <div class="col-sm">
                                <div class="input-group mb-3" style="float:left">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Atuação</span>
                                    </div>
                                    <select id="novoatuacao" class="custom-select form-control">
                                        <option value=""></option>
                                        <option value="HUNTER">Hunter</option>
                                        <option value="FARMER">Farmer</option>
                                    </select> 
                                </div>
                            </div>

                        </div>

                        <div class="input-group mb-3" style="float:left">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Potencial do negócio</span>
                                <span class="input-group-text">R$</span>
                            </div>
                            <input type="text" id="novopotencial" class="form-control potencial">
                        </div>

                        <!-- Campos ocultos, necessários para o correto posicionamento do evento-->
                        <!--  antiga
                        <div class="input-group mb-3" style="float:left;display:none">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Data</span>
                            </div>
                            <input type="date" id='novadatainicio' class="form-control" value="" aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3" style="float:left;display:none">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Horário</span>
                            </div>
                            <input type="text" id='novohorarioinicio' class="form-control hora" aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        -->

                        <!-- Termina aqui-->

                        <div class="input-group mb-3" style="float:left">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Observações</span>
                            </div>
                            <textarea class="form-control" style="resize: none;" id="novoobservacoes" aria-label="With textarea"></textarea>
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="criar" class="btn btn-primary">Criar Evento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection