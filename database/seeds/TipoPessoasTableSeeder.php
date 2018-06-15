<?php

use Illuminate\Database\Seeder;

class TipoPessoasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Limpando tabela tipo_pessoas');
        $this->truncateTipoPessoasTable();

        $this->command->info('Criando Tipos de Pessoa');
        DB::table('tipo_pessoas')->insert([
            [
                'tipo_pessoa' => 'Física'
            ],
            [
                'tipo_pessoa' => 'Jurídica'
            ]
        ]);
    }

    public function truncateTipoPessoasTable()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('tipo_pessoas')->truncate();
        \App\TipoPessoa::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
