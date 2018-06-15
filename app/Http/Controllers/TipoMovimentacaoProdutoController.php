<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoMovimentacaoProduto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TipoMovimentacaoProdutoController extends Controller
{
    public $fields = [
        'id' => 'ID',
        'tipo_movimentacao_produto' => 'Tipo de Movimentação',
        'eh_entrada' => ['label' => 'Entrada', 'type' => 'bool'],
        'ativo' => ['label' => 'Ativo', 'type' => 'bool'],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->canListarTipoMovimentacaoProduto()) {
            if ($request->searchField) {
                $tipoMovimentacaoProdutos = TipoMovimentacaoProduto::where('tipo_movimentacao_produto', 'like', '%'.$request->searchField.'%')->paginate();
            } else {
                $tipoMovimentacaoProdutos = TipoMovimentacaoProduto::paginate();
            }
            
            return View('tipo_movimentacao_produto.index', [
                'tipoMovimentacaoProdutos' => $tipoMovimentacaoProdutos,
                'fields' => $this->fields
            ]);
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->canCadastrarTipoMovimentacaoProduto()) {
            return View('tipo_movimentacao_produto.create');
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->canCadastrarTipoMovimentacaoProduto()) {
            $this->validate($request, [
                'tipo_movimentacao_produto' => 'required|string|min:5'
            ]);

            try {
                $tipoMovimentacaoProduto = new TipoMovimentacaoProduto($request->all());
                if ($tipoMovimentacaoProduto->save()) {
                    Session::flash('success', __('messages.create_success', [
                        'model' => __('models.tipo_movimentacao_produto'),
                        'name' => $tipoMovimentacaoProduto->tipo_movimentacao_produto
                    ]));
                    return redirect()->action('TipoMovimentacaoProdutoController@index');
                } else {
                    Session::flash('success', __('messages.create_error', [
                        'model' => __('models.tipo_movimentacao_produto'),
                        'name' => $tipoMovimentacaoProduto->tipo_movimentacao_produto
                    ]));
                    return redirect()->back()->withInput();
                }
            } catch (\Exception $e) {
                Session::flash('error', __('messages.exception', [
                    'exception' => $e->getMessage()
                ]));
                return redirect()->back()->withInput();
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoMovimentacaoProduto  $tipoMovimentacaoProduto
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoMovimentacaoProduto $tipoMovimentacaoProduto)
    {
        if (Auth::user()->canAlterarTipoMovimentacaoProduto()) {
            return View('tipo_movimentacao_produto.edit', [
                'tipoMovimentacaoProduto' => $tipoMovimentacaoProduto
            ]);
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoMovimentacaoProduto  $tipoMovimentacaoProduto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoMovimentacaoProduto $tipoMovimentacaoProduto)
    {
        if (Auth::user()->canAlterarTipoMovimentacaoProduto()) {
            $this->validate($request, [
                'tipo_movimentacao_produto' => 'required|string|min:5'
            ]);

            try {
                $tipoMovimentacaoProduto->tipo_movimentacao_produto = $request->tipo_movimentacao_produto;
                $tipoMovimentacaoProduto->ativo = $request->ativo;

                if ($tipoMovimentacaoProduto->save()) {
                    Session::flash('success', __('messages.update_success', [
                        'model' => __('models.tipo_movimentacao_produto'),
                        'name' => $tipoMovimentacaoProduto->tipo_movimentacao_produto
                    ]));
                    return redirect()->action('TipoMovimentacaoProdutoController@index');
                } else {
                    Session::flash('success', __('messages.update_error', [
                        'model' => __('models.tipo_movimentacao_produto'),
                        'name' => $tipoMovimentacaoProduto->tipo_movimentacao_produto
                    ]));
                    return redirect()->back()->withInput();
                }
            } catch (\Exception $e) {
                Session::flash('error', __('messages.exception', [
                    'exception' => $e->getMessage()
                ]));
                return redirect()->back()->withInput();
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoMovimentacaoProduto  $tipoMovimentacaoProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoMovimentacaoProduto $tipoMovimentacaoProduto)
    {
        if (Auth::user()->canExcluirTipoMovimentacaoProduto()) {
            try {
                if ($tipoMovimentacaoProduto->delete()) {
                    Session::flash('success', __('messages.delete_success', [
                        'model' => __('models.tipo_movimentacao_produto'),
                        'name' => $tipoMovimentacaoProduto->tipo_movimentacao_produto
                    ]));
                    return redirect()->action('TipoMovimentacaoProdutoController@index');
                }
            } catch (\Exception $e) {
                switch ($e->getCode()) {
                    case 23000:
                        Session::flash('error', __('messages.fk_exception'));
                        break;
                    default:
                        Session::flash('error', __('messages.exception', [
                            'exception' => $e->getMessage()
                        ]));
                        break;
                }
                return redirect()->action('TipoMovimentacaoProdutoController@index');
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }
}
