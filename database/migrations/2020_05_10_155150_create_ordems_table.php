<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classe_id');
            $table->foreign('classe_id')->references('id')->on('classes')->constrained()
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
        Schema::dropIfExists('ordems');
    }
}
