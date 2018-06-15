<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableProdutosNumeroSerieNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (PHP_VERSION_ID > 70100) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->string('numero_serie')->nullable()->change();
                $table->string('codigo_barras')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (PHP_VERSION_ID > 70100) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->string('numero_serie')->nullable(false)->change();
                $table->string('codigo_barras')->nullable(false)->change();
            });
        }
    }
}
