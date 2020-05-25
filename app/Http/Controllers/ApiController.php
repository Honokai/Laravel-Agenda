<?php

namespace App\Http\Controllers;

use App\Eventos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /**
     * Metodo que entrega os eventos para o fullcalendar renderizar
     * substitui calendar.php
     * @param $id
     * @method GET
     */
    public function carregarCalendario($id) {
        if(Eventos::where('usuario_id', $id)->exists()) {
            $eventos = Eventos::where('usuario_id', $id)->get(['id as id','nome as title','data as start','observacao as description'])->toJson(JSON_PRETTY_PRINT);
            
            return response($eventos, 200);

        }else{

            return response()->json([
                "Nenhum evento"
              ], 201);

        }
    }

    /**
     * Carrega o evento ao ativar o eventClick fullCalendar
     * @param Request $request
     * @method GET
     */
    public function carregarEvento(Request $request, $id) {
        $data = date("Y:m:d H:i:s",strtotime(substr($request->data,0,24)));
        if(Eventos::where('data','=',$data)->where('usuario_id','=',$id)->where('nome','=',$request->nome)->exists()) {
            $evento = Eventos::where('id','=',$request->id)->where('data','=',$data)->where('usuario_id','=',$id)->where('nome','=',$request->nome)->get()->toJson(JSON_PRETTY_PRINT);
            
            return response($evento, 200);

        }else{

            return response()->json(['Ocorreu um erro ao carregar o evento',$request->id,
            $data, $request->nome],201);

        }
    }

    /**
     * Apagar evento
     * @param Request $request
     * @method DELETE
     */
    public function deletarEvento(Request $request, $id) {
        if(Eventos::where('id',$id)->where('usuario_id',$request->usuario)->exists()){
            $evento = Eventos::where('id',$id)->where('usuario_id',$request->usuario);
            
            if($evento->delete()){

                return response()->json(['Evento excluído com sucesso.'],201);

            }else{

                return response()->json(['Ocorreu um erro'],304);

            }

        }
    }

    /**
     * Cadastro de novos eventos
     * @param Request $request
     * @method POST
     */
    public function cadastraEvento(Request $request) {
        $evento = new Eventos;
        $evento->usuario_id = $request->login;
        $evento->tipo_atividade = $request->atividade;
        $evento->status_atividade = $request->status;
        $evento->nome = $request->nome;
        $evento->celular = $request->celular;
        $evento->endereco = $request->endereco;
        $evento->cidade = $request->cidade;
        $evento->data = $request->data;
        $evento->recomendante = $request->recomendante;
        $evento->recomendações = $request->recomendacoes;
        $evento->q_rec = $request->qrec;
        $evento->atuacao = $request->atuacao;
        $evento->pot_negocio = $request->potencial;
        $evento->observacao = $request->observacoes;

        if($evento->save()) {

            return response()->json(['Evento adicionado com sucesso.'],201);

        }
    }

    /**
     * Atualizar evento existente
     * @param Request $request
     * @method PUT
     */
    public function atualizarEvento(Request $request) {

    }


}
