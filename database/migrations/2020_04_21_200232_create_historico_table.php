<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateHistoricoTable extends Migration
{
    /**
     * Run the migrations.
     * Tabela historica de alteração dos itens cadastrados
     * @return void
     */
    public function up()
    {
        Schema::create('historico', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('usuario_id')->unsigned();
            $table->string('tipo_atividade');
            $table->string('status_atividade');
            $table->string('nome');
            $table->string('celular');
            $table->string('endereco');
            $table->string('cidade');
            $table->timestamp('data');
            $table->timestamp('criacao')->default(DB::raw('CURRENT_TIMESTAMP')); //data de criação de registro
            $table->timestamp('alteracao')->default(DB::raw('CURRENT_TIMESTAMP')); //data de alteração de registro
            $table->string('recomendante');
            $table->string('recomendações', 100);
            $table->integer('q_rec');
            $table->string('atuacao');
            $table->string('pot_negocio');
            $table->string('observacao', 255)->nullable();
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico');
    }
}
