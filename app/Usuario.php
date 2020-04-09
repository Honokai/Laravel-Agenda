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
}
