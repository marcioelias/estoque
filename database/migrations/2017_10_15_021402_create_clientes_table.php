<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_razao')->unique();
            $table->string('fantasia')->nullable();
            $table->string('cpf_cnpj');
            $table->string('rg_ie');
            $table->integer('tipo_pessoa_id')->unsigned();
            $table->string('fone1')->nullable();
            $table->string('fone2')->nullable();
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
            $table->string('endereco');
            $table->string('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->integer('uf_id')->unsigned();
            $table->boolean('ativo')->default(true);
            $table->foreign('tipo_pessoa_id')->references('id')->on('tipo_pessoas');
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
        Schema::dropIfExists('clientes');
    }
}
