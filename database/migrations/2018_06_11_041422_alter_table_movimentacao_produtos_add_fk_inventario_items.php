<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableMovimentacaoProdutosAddFkInventarioItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movimentacao_produtos', function (Blueprint $table) {
            $table->integer('inventario_id')->unsigned()->nullable()->after('entrada_estoque_id');
            $table->foreign('inventario_id')->references('id')->on('inventarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimentacao_produtos', function (Blueprint $table) {
            $table->dropForeign('movimentacao_produtos_inventario_id_foreign');
            $table->dropColumn('inventario_id');
        });
    }
}
