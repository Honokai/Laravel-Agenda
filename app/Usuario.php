<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class Usuario extends Model
{
    
    public static function online(){

        $usuarios = DB::table('usuarios')->select('nome')->where('online',1)->get();
        return $usuarios;

    }

    public static function eventosProximos(int $id){
        $eventos = DB::table('agenda')->select('nome','data_ag')->where('usuario_id',$id)->get();
        return $eventos;
    }
}
