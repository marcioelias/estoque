<?php

namespace App;

use App\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    public $fillable = ['estoque', 'ativo'];

    public function produtos() {
        return $this->belongsToMany(Produto::class);
    }

    public function saldo_produto(Produto $produto) { 
        $saldo = DB::table('movimentacao_produtos')
                    ->select(
                        'produtos.id',
                        DB::raw(
                            'SUM(
                                CASE tipo_movimentacao_produtos.eh_entrada
                                    WHEN 1 THEN
                                        movimentacao_produtos.quantidade_movimentada
                                    WHEN 0 THEN
                                        movimentacao_produtos.quantidade_movimentada * -1
                                END
                            ) as posicao'
                        )
                    )
                    ->groupBy('produtos.id')
                    ->leftJoin('produtos', 'produtos.id', 'movimentacao_produtos.produto_id')
                    ->leftJoin('tipo_movimentacao_produtos', 'tipo_movimentacao_produtos.id', 'movimentacao_produtos.tipo_movimentacao_produto_id')
                    ->where('produtos.id', $produto->id)
                    ->first();

        /* dd($saldo->posicao); */

        return $saldo->posicao;
        
        
        /* $entradas = DB::table('entrada_estoques')
                        ->join('entrada_estoque_items', 'entrada_estoques.id', 'entrada_estoque_items.entrada_estoque_id')
                        ->where('entrada_estoques.estoque_id', $this->id)
                        ->where('entrada_estoque_items.produto_id', $produto->id)
                        ->sum('entrada_estoque_items.quantidade');
        
        $saidas = 0; //falta implementar assim que o sistema estiver controlando as saídas do estoque;
        
        return $entradas - $saidas; */
    }
}
