<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosHistoricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos_historicos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('usuario_id')->unsigned();
            $table->string('tipo_atividade');
            $table->string('status_atividade');
            $table->string('nome');
            $table->string('celular');
            $table->string('endereco');
            $table->string('cidade');
            $table->timestamp('data')->onUpdate('no action');
            $table->timestamp('criacao')->default(DB::raw('CURRENT_TIMESTAMP'))->onUpdate('no action'); //data de criação de registro
            $table->timestamp('alteracao')->default(DB::raw('CURRENT_TIMESTAMP')); //data de alteração de registro
            $table->string('recomendante');
            $table->string('recomendações', 100);
            $table->integer('q_rec');
            $table->string('atuacao');
            $table->string('pot_negocio');
            $table->string('observacao', 255)->nullable();
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos_historicos');
    }
}
