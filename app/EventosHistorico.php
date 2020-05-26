<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventosHistorico extends Model
{
    protected $table = 'eventos_historicos';

    public $timestamps = false;   //UPDATED_AT AND CREATED_AT CANCELA

    protected $fillable = ['usuario_id', 'tipo_atividade',
    'status_atividade','nome','celular','endereco',
    'cidade','data','criacao','alteracao','recomendante',
    'recomendações','q_rec','atuacao','pot_negocio','observacao'];

}
