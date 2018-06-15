<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimentacaoProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacao_produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('data_movimentacao');
            $table->integer('estoque_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->integer('tipo_movimentacao_produto_id')->unsigned();
            $table->double('quantidade_movimentada', 10, 3);
            $table->integer('entrada_estoque_id')->unsigned()->nullable();
            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('tipo_movimentacao_produto_id')->references('id')->on('tipo_movimentacao_produtos');
            $table->foreign('entrada_estoque_id')->references('id')->on('entrada_estoques')->onDelete('cascade');
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
        Schema::dropIfExists('movimentacao_produtos');
    }
}
