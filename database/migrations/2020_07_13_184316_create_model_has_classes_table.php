<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classe_id');
            $table->foreign('classe_id')->references('id')->on('classes')->constrained()
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
        Schema::dropIfExists('model_has_classes');
    }
}
