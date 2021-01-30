<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondicoesLocalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condicoes_localidades', function (Blueprint $table) {
            $table->id();
            $table->string('reproducao');
            $table->text('alimentacao');
            $table->string('vegetacao');
            $table->string('abrigo');
            $table->text('observacoes');
            $table->timestamps();
        });
        Schema::create('condicoes_especies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('condicoes_localidade_id');
           $table->foreign('condicoes_localidade_id')->references('id')->on('condicoes_localidades')->constrained()
           ->onUpdate('cascade')
           ->onDelete('cascade');
           $table->unsignedBigInteger('especie_id');
           $table->foreign('especie_id')->references('id')->on('especies')->constrained()
           ->onUpdate('cascade')
           ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('condicoes_especies');
        Schema::dropIfExists('condicoes_localidades');
    }
}
