<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstoqueProdutoPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque_produto', function (Blueprint $table) {
            $table->integer('estoque_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->primary(['estoque_id', 'produto_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estoque_produto');
    }
}
