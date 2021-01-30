<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasFilosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_filos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('filo_id');
            $table->foreign('filo_id')->references('id')->on('filos')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->morphs('model');
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
        Schema::dropIfExists('model_has_filos');
    }
}
