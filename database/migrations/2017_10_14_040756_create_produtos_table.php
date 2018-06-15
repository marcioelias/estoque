<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('produto_descricao')->unique();
            $table->string('produto_desc_red');
            $table->integer('unidade_id')->unsigned();
            $table->double('valor_unitario', 10, 3);
            $table->integer('grupo_produto_id')->unsigned();
            $table->double('qtd_estoque', 10, 3);
            $table->boolean('ativo')->default(true);
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->foreign('grupo_produto_id')->references('id')->on('grupo_produtos');
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
        Schema::dropIfExists('produtos');
    }
}
