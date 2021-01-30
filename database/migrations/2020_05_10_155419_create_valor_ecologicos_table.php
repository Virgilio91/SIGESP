<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorEcologicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor_ecologicos', function (Blueprint $table) {
            $table->id();
             $table->text('valor');
            $table->timestamps();
        });
        Schema::create('especie_valor_ecologicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('valor_ecologico_id');
            $table->unsignedBigInteger('especie_id');
            $table->foreign('valor_ecologico_id')->references('id')->on('valor_ecologicos')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
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

      Schema::dropIfExists('especie_valor_ecologicos');
        Schema::dropIfExists('valor_ecologicos');
    }
}
