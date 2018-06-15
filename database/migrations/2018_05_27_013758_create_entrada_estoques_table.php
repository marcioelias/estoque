<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradaEstoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrada_estoques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nr_docto');
            $table->string('serie');
            $table->datetime('data_doc');
            $table->datetime('data_entrada');
            $table->integer('fornecedor_id')->unsigned();
            $table->double('valor_total', 10,3);
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
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
        Schema::dropIfExists('entrada_estoques');
    }
}
