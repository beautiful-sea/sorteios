<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente')->nullable();
            $table->string('email_cliente')->nullable();
            $table->string('telefone_cliente');
            $table->string('status')->default('PENDENTE');
            $table->boolean('is_ganhador')->default(false);
            $table->float('valor_do_desconto')->nullable();
            $table->float('valor_da_compra');

            $table->unsignedBigInteger('rifa_id');
            $table->timestamps();

            $table->foreign('rifa_id')->references('id')->on('rifas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
