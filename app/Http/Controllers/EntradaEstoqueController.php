<?php

namespace App\Http\Controllers;

use App\Estoque;
use App\Produto;
use App\Fornecedor;
use App\EntradaEstoque;
use App\EntradaEstoqueItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\MovimentacaoProdutoController;

class EntradaEstoqueController extends Controller
{
    public $fields = [
        'id' => 'ID',
        'nr_docto' => 'Nr. Documento',
        'serie' => 'Série',
        'data_entrada' => ['label' => 'Data Entrada', 'type' => 'datetime'],
        'nome_razao' => 'Fornecedor'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->canListarEntradaEstoque()) {
            if ($request->searchField) {
                $entradas = DB::table('entrada_estoques')
                                ->select('entrada_estoques.*', 'fornecedores.nome_razao as nome_razao')
                                ->join('fornecedores', 'fornecedores.id', 'entrada_estoques.fornecedor_id')
                                ->where('nr_docto', $request->searchField)
                                ->orWhere('fornecedores.nome_razao', 'like', '%'.$request->searchField.'%')
                                ->paginate();
            } else {
                $entradas = DB::table('entrada_estoques')
                                ->select('entrada_estoques.*', 'fornecedores.nome_razao as nome_razao')
                                ->join('fornecedores', 'fornecedores.id', 'entrada_estoques.fornecedor_id')
                                ->paginate();
            }
            return View('entrada_estoque.index', [
                'entradas' => $entradas,
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
        if (Auth::user()->canCadastrarEntradaEstoque()) {
            return View('entrada_estoque.create', [
                'fornecedores' => Fornecedor::all(),
                'produtos' => Produto::all(),
                'estoques' => Estoque::all()
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
        //return redirect()->back()->withInput();
        if (Auth::user()->canCadastrarEntradaEstoque()) {
            /* dd($request->all()); */
            $this->validate($request, [
                'nr_docto' => 'required|numeric',
                'serie' => 'required',
                'data_doc' => 'required',
                'data_entrada' => 'required',
                'fornecedor_id' => 'required',
                'items' => 'required|array|min:1'
            ]);
            try {
                DB::beginTransaction();
                $entradaEstoque = new EntradaEstoque($request->all());
                
                $dataDoc = \DateTime::createFromFormat('d/m/Y H:i', $request->data_doc);
                $dataEntrada = \DateTime::createFromFormat('d/m/Y H:i', $request->data_entrada);
                
                $entradaEstoque->data_doc = $dataDoc->format('Y-m-d H:i:s');
                $entradaEstoque->data_entrada = $dataEntrada->format('Y-m-d H:i:s');

                $entradaEstoque->valor_total = 10; //arrumar depois

                if ($entradaEstoque->save()) {
                    $entradaEstoque->entrada_estoque_items()->createMany($request->items);

                    MovimentacaoProdutoController::entradaEstoque($entradaEstoque);

                    DB::commit();
                    Session::flash('success', __('messages.create_success', [
                        'model' => 'entrada_estoque', 
                        'name' => $entradaEstoque->nr_docto
                    ]));

                    return redirect()->action('EntradaEstoqueController@index');
                } else {
                    throw new Exception(__('messages.create_error', [
                        'model' => 'entrada_estoque', 
                        'name' => $entradaEstoque->nr_docto
                    ]));
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
     * @param  \App\EntradaEstoque  $entradaEstoque
     * @return \Illuminate\Http\Response
     */
    public function edit(EntradaEstoque $entradaEstoque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntradaEstoque  $entradaEstoque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntradaEstoque $entradaEstoque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EntradaEstoque  $entradaEstoque
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntradaEstoque $entradaEstoque)
    {
        if (Auth::user()->canExcluirEntradaEstoque()) {
            try {
                if ($entradaEstoque->delete()) {
                    Session::flash('success', __('messages.delete_success', [
                        'model' => __('models.entrada_estoque'),
                        'name' => $entradaEstoque->nr_docto 
                    ]));
                    return redirect()->action('EntradaEstoqueController@index');
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
                return redirect()->action('EntradaEstoqueController@index');
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }
}
