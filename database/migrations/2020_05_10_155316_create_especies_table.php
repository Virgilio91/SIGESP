<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedBigInteger('genero_id');
            $table->foreign('genero_id')->references('id')->on('generos')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('nome_cientifico');
            $table->string('nome_comum');
            $table->text('historia_ocorrencia');
            $table->enum('nivel__conservacao', ['Extinta', 'Em via de Extinção', 'Em abundancia', 'quase extinta','Estacionária']);
            $table->enum('categoria_especie', ['Exótica','Endémica']);
            $table->string('image',200)->nullable();
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
        Schema::dropIfExists('especies');
    }
}
