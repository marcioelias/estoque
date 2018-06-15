<?php

use Illuminate\Database\Seeder;

class UnidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Limpando tabela unidades');
        $this->truncateUnidadesTable();

        $this->command->info('Criando Unidades');

        DB::table('unidades')->insert([[
            'unidade' => 'UN',
            'permite_fracionamento' => false
        ],
        [
            'unidade' => 'LT',
            'permite_fracionamento' => true
        ],
        [
            'unidade' => 'KG',
            'permite_fracionamento' => true
        ]]);
    }

    public function truncateUnidadesTable() {
        Schema::disableForeignKeyConstraints();
        DB::table('unidades')->truncate();
        \App\Unidade::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
