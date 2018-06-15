<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEntradaEstoqueTableAddFkEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrada_estoques', function (Blueprint $table) {
            $table->integer('estoque_id')->unsigned()->after('fornecedor_id');
            $table->foreign('estoque_id')->references('id')->on('estoques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrada_estoques', function (Blueprint $table) {
            $table->dropForeign('entrada_estoque_estoques_id_foreign');
            $table->dropColumn('estoque_id');
        });
    }
}
