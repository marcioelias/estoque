<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_razao');
            $table->string('apelido_fantasia');
            $table->string('cpf_cnpj');
            $table->string('rg_ie');
            $table->string('im')->nullable();
            $table->integer('tipo_pessoa_id')->unsigned();
            $table->string('endereco');
            $table->string('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('cep');
            $table->integer('uf_id')->unsigned();
            $table->string('fone');
            $table->string('email')->nullable();
            $table->boolean('ativo')->default(true);
            $table->foreign('uf_id')->references('id')->on('ufs');
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
        Schema::dropIfExists('fornecedores');
    }
}
