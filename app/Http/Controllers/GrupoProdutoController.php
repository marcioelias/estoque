<?php

namespace App\Http\Controllers;

use App\GrupoProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GrupoProdutoController extends Controller
{
    protected $fields = array(
        'id' => 'ID',
        'grupo_produto' => 'Grupo Produto',
        'ativo' => ['label' => 'Ativo', 'type' => 'bool']
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->canListarGrupoProduto()) {
            if (isset($request->searchField)) {
                $grupoProdutos = GrupoProduto::where('grupo_produto', 'like', '%'.$request->searchField.'%')
                                                ->paginate();
            } else {
                $grupoProdutos = GrupoProduto::paginate();
            }

            return View('grupo_produto.index', [
                'grupoProdutos' => $grupoProdutos,
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
        if (Auth::user()->canCadastrarGrupoProduto()) {
            return View('grupo_produto.create');
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
        if (Auth::user()->canCadastrarGrupoProduto()) {
            $this->validate($request, [
                'grupo_produto' => 'required|string|min:3|max:80|unique:grupo_produtos'
            ]);

            try {
                $grupoProduto = new GrupoProduto($request->all());

                if ($grupoProduto->save()) {
                    Session::flash('success', __('messages.create_success', [
                        'model' => __('models.grupo_produto'),
                        'name' => $grupoProduto->grupo_produto
                    ]));
                    return redirect()->action('GrupoProdutoController@index');
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
     * @param  \App\GrupoProduto  $grupoProduto
     * @return \Illuminate\Http\Response
     */
    public function edit(GrupoProduto $grupoProduto)
    {
        if (Auth::user()->canAlterarGrupoProduto()) {
            return View('grupo_produto.edit', [
                'grupoProduto' => $grupoProduto
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
     * @param  \App\GrupoProduto  $grupoProduto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GrupoProduto $grupoProduto)
    {
        if (Auth::user()->canAlterarGrupoProduto()) {
            $this->validate($request, [
                'grupo_produto' => 'required|string|min:3|max:80|unique:grupo_produtos,id,'.$grupoProduto->id
            ]);

            try {
                $grupoProduto->grupo_produto = $request->grupo_produto;
                $grupoProduto->ativo = $request->ativo;

                if ($grupoProduto->save()) {
                    Session::flash('success', __('messages.update_success', [
                        'model' => __('models.grupo_produto'),
                        'name' => $grupoProduto->grupo_produto
                    ]));
                    return redirect()->action('GrupoProdutoController@index');
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
     * @param  \App\GrupoProduto  $grupoProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrupoProduto $grupoProduto)
    {
        if (Auth::user()->canAlterarGrupoProduto()) {
            try {
                if ($grupoProduto->delete()) {
                    Session::flash('success', __('messages.delete_success', [
                        'model' => __('models.grupo_produto'),
                        'name' => $grupoProduto->grupo_produto
                    ]));
                    return redirect()->action('GrupoProdutoController@index');
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
                return redirect()->action('GrupoProdutoController@index');
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        } 
    }
}
