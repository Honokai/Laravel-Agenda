<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    protected $table = 'eventos';

    public $timestamps = false;

    protected $fillable = ['usuario_id', 'tipo_atividade',
    'status_atividade','nome','celular','endereco',
    'cidade','data','criacao','alteracao','recomendante',
    'recomendações','q_rec','atuacao','pot_negocio','observacao'];

}
