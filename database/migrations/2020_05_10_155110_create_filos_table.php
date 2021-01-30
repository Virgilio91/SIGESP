<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reino_id');
            $table->foreign('reino_id')->references('id')->on('reinos')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('nome');
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
        Schema::dropIfExists('filos');
    }
}
