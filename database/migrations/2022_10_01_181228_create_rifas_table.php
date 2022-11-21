<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rifas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->string('resumo')->nullable();


            $table->string('premio');
            $table->integer('status')->default(false);
            $table->boolean('mostrar_data_sorteio')->default(false);
            $table->dateTime('periodo');
            $table->float('valor_por_numero');
            $table->integer('quantidade_de_numeros');
            $table->integer('quantidade_maxima_de_numeros');
            $table->float('porcentagem_comissao_vendas');
            $table->boolean('has_compra_minima')->default(false);
            $table->string('contato_whatsapp');

            $table->boolean('is_compra_automatica')->default(false);

            $table->boolean('has_top_five')->default(false);
            $table->string('premio_top_five')->nullable();
            $table->boolean('definir_ganhador_top_five')->default(false);
            $table->string('nome_ganhador_top_five')->nullable();
            $table->string('telefone_ganhador_top_five')->nullable();
            $table->integer('total_cotas_ganhador_top_five')->nullable();

            $table->boolean('has_botao_whatsapp')->default(false);
            $table->string('texto_botao_whatsapp')->nullable();
            $table->string('tipo_botao_whatsapp')->nullable();
            $table->string('contato_botao_whatsapp')->nullable();
            $table->string('id_grupo_botao_whatsapp')->nullable();

            $table->string('numero_sorteado')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rifas');
    }
}
