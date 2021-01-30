<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provincia_id');
            $table->foreign('provincia_id')->references('id')->on('provincias')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('nome');
            $table->enum('Categoria', ['Transfronteiriço','Conservação Total','Conservação de Uso Sustentável']);
            $table->enum('Tipo', ['Reserva Natural Integral','Parque Nacional ','Monumento Cultural e Natural',
            'Reserva especial','Área de protecção ambiental','Coutada oficial','Área de conservação comunitária',
            'Santuário','Fazenda do bravio'])->nullable();
            $table->string('area_cobertura')->nullable();
            $table->timestamps();
        });


        schema::create('especie_acs', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('ac_id');
            $table->foreign('ac_id')->references('id')->on('acs')->constrained()
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
        Schema::dropIfExists('especie_acs');
        Schema::dropIfExists('acs');
    }
}
