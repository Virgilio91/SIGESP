<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasFamiliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_familias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('familia_id');
            $table->foreign('familia_id')->references('id')->on('familias')->constrained()
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
        Schema::dropIfExists('model_has_familias');
    }
}
