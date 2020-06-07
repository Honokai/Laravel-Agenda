<?php

namespace App\Http\Controllers;


use App\Eventos;
use App\EventosHistorico;
use App\Relatorio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ApiController extends Controller
{
    /**
     * Metodo que entrega os eventos para o fullcalendar renderizar
     * substitui calendar.php
     * @param $id
     * @method GET
     */
    public function carregarCalendario($id) {
        if(Eventos::where('usuario_id','=',$id)->exists()) {
            $eventos = Eventos::where('usuario_id','=',$id)->get(['id as id','nome as title','data as start','observacao as description', 'tipo_atividade as atividade'])->toJson(JSON_PRETTY_PRINT);
            
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
        $data = date("Y-m-d H:i:s",strtotime(substr($request->data,0,24)));
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
        if(Eventos::where('id','=',$id)->where('usuario_id','=',$request->usuario)->exists()){
            $evento = Eventos::where('id','=',$id)->where('usuario_id','=',$request->usuario);
            
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
        $timestamps = true;
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

            $evento = new EventosHistorico;
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

            $evento->save();

            return response()->json(['Evento adicionado com sucesso.'],201);

        }else{

            return response()->json(['Ocorreu um erro'],304);

        }
    }

    /**
     * Atualizar evento existente
     * @param Request $request
     * @method PUT
     */
    public function atualizarEvento(Request $request) {

        if(Eventos::where('id','=',$request->id)->where('usuario_id','=',$request->login)->exists()){
            $data = $request->data." ".$request->hora;
            $evento = Eventos::find($request->id);
            $evento->nome = is_null($request->nome) ? $evento->nome : $request->nome;
            $evento->tipo_atividade = is_null($request->atividade) ? $evento->tipo_atividade : $request->atividade;
            $evento->status_atividade = is_null($request->status) ? $evento->status_atividade : $request->status;
            $evento->endereco = is_null($request->endereco) ? $evento->endereco : $request->endereco;
            $evento->cidade = is_null($request->cidade) ? $evento->cidade : $request->cidade;
            $evento->recomendante = is_null($request->recomendante) ? $evento->recomendante : $request->recomendante;
            $evento->q_rec = is_null($request->qrec) ? $evento->q_rec : $request->qrec;
            $evento->criacao = $evento->criacao;
            $evento->atuacao = is_null($request->atuacao) ? $evento->atuacao : $request->atuacao;
            $evento->data = $data;
            $evento->pot_negocio = is_null($request->potencial) ? $evento->pot_negocio : $request->potencial;
            $evento->observacao = is_null($request->observacoes) ? $evento->observacao : $request->observacoes;

            if($evento->save()){
                $evento = new EventosHistorico;
                $evento->usuario_id = $request->login;
                $evento->tipo_atividade = $request->atividade;
                $evento->status_atividade = $request->status;
                $evento->nome = $request->nome;
                $evento->celular = $request->celular;
                $evento->endereco = $request->endereco;
                $evento->cidade = $request->cidade;
                $evento->data = $data;
                $evento->recomendante = $request->recomendante;
                $evento->recomendações = $request->recomendacoes;
                $evento->q_rec = $request->qrec;
                $evento->atuacao = $request->atuacao;
                $evento->pot_negocio = $request->potencial;
                $evento->observacao = $request->observacoes;

                $evento->save();

                return response()->json(["Evento atualizado."],200);

            }else{

                return response()->json(["Ocorreu um erro."],201);
                
            }
        } else {

            return response()->json(["Evento não encontrado."],201);

        }

    }

    /**
     * 
     */
    public function arrastaEsoltaEvento(Request $request) {

        $data = date("Y-m-d H:i:s",strtotime(substr($request->data,0,24)));

        if(Eventos::where('usuario_id','=',$request->login)->where('id','=',$request->id)->where('nome','=',$request->nome)->exists()){

            $evento = Eventos::find($request->id);
            
            $evento->data = $data;
            $evento->criacao = $evento->criacao;

            if($evento->save()) {

                return response()->json(["Data do evento atualizada"],200);

            } else {
            
                    return response()->json(["Não foi possível atualizar a data"],201);
                }

        } else {
            return response()->json(["Erro ao buscar pelo evento.", $data],201);
        }

    }

    /**
     * Cria o relatorio de acordo com o conteudo do request
     * @param Request $request
     * @return Spreadsheet
     */
    public function criarRelatorio(Request $request){

        $relatorio = new Relatorio;
        switch ($request->relatorio ) {
            case 0:
                $itens = User::join('eventos_historicos','usuarios.id', '=', 'eventos_historicos.usuario_id')
                        ->where('usuario_id',$request->id)->select('usuarios.nome as advisor','eventos_historicos.*')
                        ->get()->sortBy('eventos_historicos.celular');  
                break;
            
            case 771:
                
                $itens = EventosHistorico::join('usuarios','eventos_historicos.usuario_id', '=', 'usuarios.id')
                        ->select('usuarios.nome as advisor','eventos_historicos.*')->get()->sortBy('eventos_historicos.celular');
                break;

            default:

                return response()->json(["Houve um erro, reporte o erro ao administrador da plataforma.<br><strong>Código de referência Rel.01 </strong>"],201);
                break;
        }
        $planilha = new Spreadsheet;
        $planilha = Relatorio::criarCabecalhoGeral();
        $comecoDeInsercao=4;
        
        foreach($itens as $key){
            $planilha->getActiveSheet()->setCellValue('a'.$comecoDeInsercao,$key['celular']);
            $planilha->getActiveSheet()->setCellValue('b'.$comecoDeInsercao,$key['advisor']);
           
            switch ($key['tipo_atividade']) {
            
                case 'PV':
                    $atividade = $key['status_atividade'];
                    $planilha = $relatorio->scopePrimeiraVisita($comecoDeInsercao,$atividade,$planilha);
                    break;
                
                case 'SV':
                    $atividade = $key['status_atividade'];
                    $planilha = $relatorio->scopeSegundaVisita($comecoDeInsercao,$atividade,$planilha);
                    break;
                
                case 'VR':
                    $atividade = $key['status_atividade'];
                    $planilha = $relatorio->scopeVisitaRelacionamento($comecoDeInsercao,$atividade,$planilha);
                    break;
                
                case 'LIG':
                    $atividade = $key['status_atividade'];
                    $planilha = $relatorio->scopeLigacao($comecoDeInsercao,$atividade,$planilha);
                    break;
    
                default:
                    break;
            }

            $planilha->getActiveSheet()->setCellValue('c'.$comecoDeInsercao,$key['criacao']);
            $planilha->getActiveSheet()->setCellValue('d'.$comecoDeInsercao,$key['alteracao']);
            $comecoDeInsercao++;
        }

        $planilha->getActiveSheet()->getStyle('A1:D1'.$comecoDeInsercao)->getAlignment()->setHorizontal('center');

        foreach(range('A','D') as $columnID) {
            $planilha->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        

        $escrever = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($planilha, "Xlsx");
        //$escrever->save(Storage::disk('public'->put($request->titulo.".xlsx")));
        
        $escrever->save(storage_path('app/' . "{$request->titulo}.xlsx"));
        //$escrever->save(Storage::disk('public'->put($request->titulo.".xlsx")));
        

        return response()->json(["item"=>"{$request->titulo}.xlsx"],200);

    }


    /**
     * Captura somente o campo observacao da tabela eventos_historicos
     * 
     * utilizado no modal de evento
     */
    public function histobs(Request $request){
        
        if(EventosHistorico::where('celular', '=', $request->celular)->where('usuario_id', '=', $request->id)->exists() ){
            
            $hist = new EventosHistorico;
            $hist = $hist::where('celular', '=', $request->celular)->where('usuario_id', '=', $request->id)
            ->select('observacao',DB::raw('DATE_FORMAT(criacao, "%d/%m/%Y %H:%i:%s") as criacao'))->orderBy('criacao','desc')->get()->toJson(JSON_PRETTY_PRINT);

            return response($hist,200);

        } else  {

            return response()->json([$request],404);

        }

    }
/*
    public function excluirUsuario(Request $request){

        if(User::){

        }else{

        }

    }
    */
}
