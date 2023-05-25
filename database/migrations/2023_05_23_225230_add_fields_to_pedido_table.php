<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->text('hash_payment')->nullable();
            $table->text('qrcode')->nullable();
            $table->text('chave_pix')->nullable();
            $table->text('metodo_pagamento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn([
                'hash_payment',
                'qrcode',
                'chave_pix',
                'metodo_pagamento'
            ]);
        });
    }
}
