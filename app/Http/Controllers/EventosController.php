<?php

namespace App\Http\Controllers;

use App\Eventos as Eventos;
use App\User;
use Illuminate\Http\Request;
use DateTime;


class EventosController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
/*
    public function eventoAmanha(){
        $data = new DateTime('tomorrow');

        $evento = Eventos::select('eventos.nome as evento,eventos.data as data,usuarios.nome as nome, usuarios.email as email')->join('usuario','eventos.usuario_id','=','usuarios.id')
        ->where('data', '=', $data->format('Y-m-d'));
        
        foreach($evento as $item){
            $usuario = new User;
            $usuario->nome = $item->nome;
            $usuario->evento = $item->evento;
            $usuario->data = $item->data;
            $usuario->email = $item->email;
            $usuario->AlertaEvento;
        }
        
    }
    */
}
