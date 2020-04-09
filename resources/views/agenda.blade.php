@extends('layouts.agenda')

@section('conteudo')
    <div id="calendar"></div>
    <div class="modal" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="card-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="nav nav-tabs card-header-tabs" id="listadados" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="abaevento" href="#tabevento" role="tab" aria-controls="evento" aria-selected="true">Evento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  id='acontecimentos'href="#feedback" role="tab" aria-controls="feedback" aria-selected="false">Acontecimentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="abacriar" href="#Criarevento" role="tab" aria-controls="Criarevento" aria-selected="false">Criar evento</a>
                    </li>
                </ul>
            </div>
            <div class="modal-body" >
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="tabevento" role="tabpanel">
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Categoria</span>
                                </div>
                                <select type="text" id='categoria' class="form-control" aria-label="Categoria" aria-describedby="basic-addon1">
                                    <option value=""></option>
                                    <option value="Crítico">Crítico</option>
                                    <option value="Atenção">Atenção</option>
                                </select>
                            </div>
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Nome Evento</span>
                                </div>
                                <input type="text" id='nomevento' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Data</span>
                                </div>
                                <input type="date" id='datainicio' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Horário</span>
                                </div>
                                <input type="text" id='horarioinicio' class="form-control hora" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Data término</span>
                                </div>
                                <input type="date" id='datatermino' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">Horário término</span>
                                </div>
                                <input type="text" id='horariotermino' class="form-control hora" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3" style="float:left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Descrição</span>
                                </div>
                                <textarea class="form-control" id='descricaoevento' aria-label="With textarea"></textarea>
                            </div>
                        <div class="modal-footer">
                            <button type="button" id="enviar" class="btn btn-primary">Salvar</button>
                            <button type="button" id="excluirevento" class="btn btn-primary btn-danger" data-dismiss="modal">Excluir evento</button>
                        </div>
                    </div>
                    <div class="tab-pane" id="feedback" role="tabpanel">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Feedback</span>
                            </div>
                            <textarea class="form-control" id='feedbackdescricao' aria-label="With textarea"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="adicionardescricao" class="btn btn-primary" style="display: none">Adicionar descrição</button>
                            <button type="button" id="atualizardescricao" class="btn btn-primary" style="display: none">Atualizar descrição</button>
                        </div>
                    </div>
                    <div class="tab-pane" id="Criarevento" role="tabpanel">
                        <div class="input-group mb-3" style="float:left">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Categoria</span>
                            </div>
                            <select type="text" id='novacategoria' class="form-control" aria-label="Categoria" aria-describedby="basic-addon1">
                                <option value=""></option>
                                <option value="Crítico">Crítico</option>
                                <option value="Atenção">Atenção</option>
                            </select>
                        </div>
                        <div class="input-group mb-3" style="float:left">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Nome Evento</span>
                            </div>
                            <input type="text" id='novonomevento' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3" style="float:left">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Data</span>
                            </div>
                            <input type="date" id='novodatainicio' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3" style="float:left">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Horário</span>
                            </div>
                            <input type="text" id='novohorarioinicio' class="form-control hora" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3" style="float:left">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Data término</span>
                            </div>
                            <input type="date" id='novodatatermino' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3" style="float:left">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Horário término</span>
                            </div>
                            <input type="text" id='novohorariotermino' class="form-control hora" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3" style="float:left">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Descrição</span>
                            </div>
                            <textarea class="form-control" id='novodescricaoevento' aria-label="With textarea"></textarea>
                        </div>
                    <div class="modal-footer">
                        <button type="button" id="criar" class="btn btn-primary">Criar Evento</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
@endsection