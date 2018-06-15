<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProdutosTableNewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('valor_unitario');
            $table->dropColumn('qtd_estoque');
            $table->double('valor_custo', 10, 3)->after('grupo_produto_id');
            $table->double('valor_venda', 10, 3)->after('valor_custo');
            $table->integer('vencimento_dias')->nullable()->after('valor_venda');
            $table->integer('vencimento_km')->nullable()->after('vencimento_dias');
            $table->boolean('controla_vencimento')->defaul(false)->after('vencimento_km');
            $table->string('numero_serie')->defaulr('')->after('controla_vencimento');
            $table->string('codigo_barras')->default('')->after('numero_serie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('codigo_barras');
            $table->dropColumn('numero_serie');
            $table->dropColumn('controla_vencimento');
            $table->dropColumn('vencimento_km');
            $table->dropColumn('vencimento_dias');
            $table->dropColumn('valor_venda');
            $table->dropColumn('valor_custo');
            $table->double('valor_unitario', 10, 3);
            $table->double('qtd_estoque', 10, 3);
        });
    }
}
