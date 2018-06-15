<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarioItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventario_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->double('qtd_estoque', 10, 3)->default(0);
            $table->double('qtd_contada', 10, 3)->default(0);
            $table->double('qtd_ajuste', 10, 3)->default(0);
            $table->foreign('inventario_id')->references('id')->on('inventarios')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos');
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
        Schema::dropIfExists('inventario_items');
    }
}
