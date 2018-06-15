<?php

namespace App\Http\Controllers;

use App\Estoque;
use App\Produto;
use App\Unidade;
use App\Fornecedor;
use App\Permission;
use App\GrupoProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProdutoController extends Controller
{
    protected $fields = array(
        'id' => 'ID',
        'produto_descricao' => 'Descrição',
        'produto_desc_red' => 'Descrição Reduzida',
        'unidade' => 'Unidade',
        'grupo_produto' => 'Grupo',
        'valor_custo' => 'Preço de Custo',
        'valor_venda' => 'Preço de Venda',
        'ativo' => ['label' => 'Ativo', 'type' => 'bool']
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->canListarProduto()) {
            if ($request->searchField) {
                $produtos = DB::table('produtos')
                                ->select('produtos.*', 'unidades.unidade', 'grupo_produtos.grupo_produto')
                                ->join('unidades', 'unidades.id', 'produtos.unidade_id')
                                ->join('grupo_produtos', 'grupo_produtos.id', 'produtos.grupo_produto_id')
                                ->where('produto_descricao', 'like', '%'.$request->searchField.'%')
                                ->orWhere('produto_desc_red', 'like', '%'.$request->searchField.'%')
                                ->paginate();
            } else {
                $produtos = DB::table('produtos')
                                ->select('produtos.*', 'unidades.unidade', 'grupo_produtos.grupo_produto')
                                ->join('unidades', 'unidades.id', 'produtos.unidade_id')
                                ->join('grupo_produtos', 'grupo_produtos.id', 'produtos.grupo_produto_id')
                                ->paginate();
            }

            return View('produto.index')->withProdutos($produtos)->withFields($this->fields);
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
        if (Auth::user()->canCadastrarProduto()) {
            return View('produto.create', [
                'unidades' => Unidade::all(),
                'grupoProdutos' => GrupoProduto::all(),
                'estoques' => Estoque::all(),
                'fornecedores' => Fornecedor::all()
            ]);
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
        //dd($request->all());
        if (Auth::user()->canCadastrarProduto()) {
            $this->validate($request, [
                'produto_descricao' => 'required|string|min:3|max:60|unique:produtos',
                'produto_desc_red' => 'nullable|string|min:3|max:10',
                'unidade_id' => 'required',
                'grupo_produto_id' => 'required',
            ]);

            try {
                DB::beginTransaction();
                $produto = new Produto($request->all());

                if ($produto->save()) {
                    $produto->fornecedores()->sync($request->fornecedores);
                    $produto->estoques()->sync($request->estoques);

                    DB::commit();
                    Session::flash('success', __('messages.create_success', [
                        'model' => __('models.produto'),
                        'name' => $produto->produto_descricao 
                    ]));
                    return redirect()->action('ProdutoController@index');
                }
            } catch (\Exception $e) {
                DB::rollback();
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
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        if (Auth::user()->canAlterarProduto()) {
            return View('produto.edit', [
                'produto' => $produto,
                'unidades' => Unidade::all(),
                'grupoProdutos' => GrupoProduto::all(),
                'estoques' => Estoque::all(),
                'fornecedores' => Fornecedor::all()
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
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        if (Auth::user()->canAlterarProduto()) {
            $this->validate($request, [
                'produto_descricao' => 'required|string|min:3|max:60|unique:produtos,id,'.$request->id,
                'produto_desc_red' => 'nullable|string|min:3|max:10',
                'unidade_id' => 'required',
                'grupo_produto_id' => 'required',
            ]);

            try {
                DB::beginTransaction();
                $produto->fill($request->all());

                if ($produto->save()) {
                    $produto->fornecedores()->sync($request->fornecedores);
                    $produto->estoques()->sync($request->estoques);

                    DB::commit();
                    Session::flash('success', __('messages.update_success', [
                        'model' => __('models.produto'),
                        'name' => $produto->produto_descricao 
                    ]));
                    return redirect()->action('ProdutoController@index');
                }
            } catch (\Exception $e) {
                DB::rollback();
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
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        if (Auth::user()->canExcluirProduto()) {
            try {
                $produto = Produto::find($produto->id);
                if ($produto->delete()) {
                    Session::flash('success', __('messages.delete_success', [
                        'model' => __('models.produto'),
                        'name' => $produto->produto_descricao 
                    ]));
                    return redirect()->action('ProdutoController@index');
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
                return redirect()->action('ProdutoController@index');
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }
}
