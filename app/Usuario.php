<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Usuario extends Model
{
    
    public static function online(){

        $usuarios = DB::table('usuarios')->select('nome')->where('online',1)->get();
        return $usuarios;

    }

    public static function eventosProximos(int $id){
        $hoje = today()->format('Y-m-d');
        $eventos = DB::table('agenda')->select('nome','data_ag')->where('usuario_id','=',$id)->where(DB::raw('date(data_ag)'),$hoje)->get();
        return $eventos;
    }
}
