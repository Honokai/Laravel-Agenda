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
        $eventos = DB::table('eventos')->join('usuarios','eventos.usuario_id','=','usuarios.id')
                    ->select('eventos.nome','eventos.data','usuarios.nome as usuario')
                    ->where(DB::raw('date(data)'),$hoje)->get();
        return $eventos;
    }
}
