<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasOrdemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_ordems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordem_id');
            $table->foreign('ordem_id')->references('id')->on('ordems')->constrained()
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
        Schema::dropIfExists('model_has_ordems');
    }
}
