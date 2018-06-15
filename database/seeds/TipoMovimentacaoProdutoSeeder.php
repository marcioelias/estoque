<?php

use Illuminate\Database\Seeder;

class TipoMovimentacaoProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Limpando tabela tipo_movimentacao_produtos');
        $this->truncateTipoMovimentacaoProdutosTable();

        $this->command->info('Criando Tipos de Movimentação de Produto');

        DB::table('tipo_movimentacao_produtos')->insert(
            [
                [
                    'tipo_movimentacao_produto' => 'Entrada',
                    'eh_entrada' => true
                ],
                [
                    'tipo_movimentacao_produto' => 'Saída',
                    'eh_entrada' => false
                ],
                [
                    'tipo_movimentacao_produto' => 'Entrada - Inventário',
                    'eh_entrada' => true
                ],
                [
                    'tipo_movimentacao_produto' => 'Saída - Inventário',
                    'eh_entrada' => false
                ]
            ]
        );
    }

    public function truncateTipoMovimentacaoProdutosTable() {
        Schema::disableForeignKeyConstraints();
        DB::table('tipo_movimentacao_produtos')->truncate();
        \App\TipoMovimentacaoProduto::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
