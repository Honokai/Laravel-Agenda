<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaTable extends Migration
{  
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('usuario_id')->unsigned();
            $table->string('tipo_atividade');
            $table->string('status_atividade');
            $table->string('nome');
            $table->string('celular');
            $table->string('endereco');
            $table->string('cidade');
            $table->timestamp('data')->nullable();
            $table->string('recomendante');
            $table->string('recomendações', 100);
            $table->integer('q_rec');
            $table->string('atuacao');
            $table->string('pot_negocio');
            $table->timestamp('data_ag')->nullable();
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
        Schema::dropIfExists('agenda');
    }
}
