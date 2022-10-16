<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRifasImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rifas_imagens', function (Blueprint $table) {
            $table->id();
            $table->text('path');
            $table->unsignedBigInteger('rifa_id');
            $table->foreign('rifa_id')->references('id')->on('rifas');
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
        Schema::dropIfExists('rifas_imagens');
    }
}
