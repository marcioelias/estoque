<?php

namespace App\Http\Controllers;

use App\Estoque;
use App\Produto;
use App\Parametro;
use App\Inventario;
use App\GrupoProduto;
use App\EntradaEstoque;
use App\MovimentacaoProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimentacaoProdutoController extends Controller
{
    static public function entradaEstoque(EntradaEstoque $entradaEstoque) {
        try {
            foreach ($entradaEstoque->entrada_estoque_items as $item) {
                $entradaEstoque->movimentacao_produto()->create([
                    'data_movimentacao' => $entradaEstoque->data_entrada,
                    'estoque_id' => $entradaEstoque->estoque_id,
                    'produto_id' => $item->produto_id,
                    'tipo_movimentacao_produto_id' => 1,
                    'quantidade_movimentada' => $item->quantidade,
                    'entrada_estoque_id' => $entradaEstoque->id
                ]);
            }

            return true;
                /* $entradas[] = [
                    'data_movimentacao_produto' => $entradaEstoque->data_entrada,
                    'estoque_id' => $entradaEstoque->estoque_id,
                    'produto_id' => $item->produto_id,
                    'tipo_movimentacao_produto_id' => 1,
                    'quantidade_movimentada' => $item->quantidade,
                    'entrada_estoque_id' => $entradaEstoque->id
                ];
            }
            return $entradaEstoque->movimentacao_produto()->createMany($entradas); */

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        } 
    }


    static public function consolidarInventario(Inventario $inventario) {
        try {
            foreach ($inventario->inventario_items as $item) {
                /* 
                    3 = Entrada - Inventario
                    4 = Saída - Inventário
                */
                $tipoMov = ($item->qtd_ajuste > 0) ? 3 : 4;
                $qtd = ($item->qtd_ajuste < 0) ? $item->qtd_ajuste * -1 : $item->qtd_ajuste;

                $inventario->movimentacao_produto()->create([
                    'data_movimentacao' => $inventario->data_fechamento,
                    'estoque_id' => $inventario->estoque_id,
                    'produto_id' => $item->produto_id,
                    'tipo_movimentacao_produto_id' =>  $tipoMov,
                    'quantidade_movimentada' => $qtd,
                    'inventario_id' => $inventario->id
                ]);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    static public function saldoProduto(Produto $produto) {
        try {
            $entradas = (new MovimentacaoProduto)->produto()->get();
            //->tipo_movimentacao_produto()->where('eh_entrada', true)->get();

            dd($entradas);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function paramRelatorioPosicaoEstoque() {
        return View('relatorios.estoque.param_relatorio_posicao_estoque', [
            'estoques' => Estoque::all(),
            'grupo_produtos' => GrupoProduto::all(),
            'produtos' => Produto::all() 
        ]);
    }

    public function relatorioPosicaoEstoque(Request $request) {
        $parametros = array();
        $whereData = '1 = 1';

        if ($request->estoque_id > 0) {
            $whereData = 'movimentacao_produtos.estoque_id = '.$request->estoque_id;
            array_push($parametros, 'Estoque: '.(Estoque::find($request->estoque_id)->estoque)); 
        }
        if (($request->grupo_produto_id > 0) && ($request->produto_id < 0)) {
            $whereData = 'produtos.grupo_produto_id = '.$request->grupo_produto_id;
            array_push($parametros, 'Grupo de Produto: '.(GrupoProduto::find($request->grupo_produto_id)->grupo_produto)); 
        } else {
            if ($request->produto_id > 0) {
                $whereData = 'produtos.id = '.$request->produto_id;
                array_push($parametros, 'Produto: '.(Produto::find($request->produto_id)->produto_descricao));
            }
        }

        $produtos = DB::table('movimentacao_produtos')
                    ->select(
                        'produtos.id',
                        'produtos.produto_descricao',
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
                    ->groupBy('produtos.produto_descricao')
                    ->leftJoin('produtos', 'produtos.id', 'movimentacao_produtos.produto_id')
                    ->leftJoin('tipo_movimentacao_produtos', 'tipo_movimentacao_produtos.id', 'movimentacao_produtos.tipo_movimentacao_produto_id')
                    ->whereRaw($whereData)
                    ->get();

        return View('relatorios.estoque.relatorio_posicao_estoque')
                    ->withProdutos($produtos)
                    ->withTitulo('Posicão de Estoque')
                    ->withParametros($parametros)
                    ->withParametro(Parametro::first());
    }
}
