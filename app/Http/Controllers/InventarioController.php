<?php

namespace App\Http\Controllers;

use App\Estoque;
use App\Produto;
use App\Parametro;
use App\Inventario;
use App\InventarioItem;
use Illuminate\Http\Request;
use App\Rules\ValidInventario;
use App\Rules\ValidInventarioItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\MovimentacaoProdutoController;

class InventarioController extends Controller
{
    public $fields = [
        'id' => 'ID',
        'estoque' => 'Estoque',
        'data_abertura' => ['label' => 'Abertura', 'type' => 'datetime'],
        'data_fechamento' => ['label' => 'Fechamento', 'type' => 'datetime'],
        'fechado' => ['label' => 'Fechado', 'type' => 'bool']
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->canListarInventario()) {
            if ($request->searchFields) {
                $inventarios = DB::table('inventarios')
                                ->select('inventarios.*', 'estoques.estoque')
                                ->join('estoques', 'estoques.id', 'inventarios.estoque_id')
                                ->where('estoques.estoque', 'like', '%'.$request->searchField.'%')
                                ->paginate();
            } else {
                $inventarios = DB::table('inventarios')
                                ->select('inventarios.*', 'estoques.estoque')
                                ->join('estoques', 'estoques.id', 'inventarios.estoque_id')
                                ->paginate();
            }

            return View('inventario.index', [
                'fields' => $this->fields,
                'inventarios' => $inventarios
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
        if (Auth::user()->canCadastrarInventario()) {
            return View('inventario.create')->withEstoques(Estoque::all());
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
        if (Auth::user()->canCadastrarInventario()) {
            $this->validate($request, [
                'estoque_id' => ['required', new ValidInventario, new ValidInventarioItem]
            ]);

            try {
                DB::beginTransaction();
                $inventario = new Inventario($request->all());
                
                if ($inventario->save()) {
                    $estoque = Estoque::find($inventario->estoque_id);
                    
                    $produtos = $estoque->produtos()->get();

                    foreach ($produtos as $produto) {
                        $items[] = [
                            'produto_id' => $produto->id,
                            'qtd_estoque' => $estoque->saldo_produto($produto)
                        ]; 
                    }

                    $inventario->inventario_items()->createMany($items);

                    DB::commit();

                    Session::flash('success', __('messages.create_success', [
                        'model' => 'inventario',
                        'name' => $inventario->id
                    ]));

                    return redirect()->action('InventarioController@index');
                } else {
                    throw new \Exception(__('messages.create_error', [
                        'model' => 'inventario',
                        'name' => $inventario->id
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
     * Display the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Inventario $inventario)
    {
        if (Auth::user()->canListarInventario()) {
            return View('inventario.show')->withInventario($inventario)->withTitulo($inventario->estoque->estoque.' - Inventário: '.$inventario->id)->withParametro(Parametro::first());
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventario $inventario)
    {
        if (Auth::user()->canCadastrarInventario()) {
            
            foreach ($inventario->inventario_items as $item) {
                $items[] = $item->produto;
            }
            return View('inventario.edit')
                        ->withInventario($inventario)
                        ->withItems($items);
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventario $inventario)
    {
        if (Auth::user()->canAlterarInventario()) {
            try {
                DB::beginTransaction();
                $inventario->fechado = $request->fechado;
                $inventario->data_fechamento = ($inventario->fechado) ? (new \DateTime)->format('Y-m-d H:n:s') : null;

                if (!$inventario->save()) {
                    throw new \Exception(__('messages.update_error', [
                        'model' => 'inventario',
                        'name' => $inventario->id
                    ]));
                }

                if ($inventario->fechado) {
                    /* atualizar quantidade em estoque e contabilizar quantidade do ajuste */
                    foreach($request->items as $id => $item) {
                        $inventarioItem = InventarioItem::find($id);
                        $inventarioItem->qtd_contada = ($item['qtd_contada']) ? $item['qtd_contada'] : 0;   
                        $inventarioItem->qtd_estoque = (Estoque::find($inventario->estoque_id))->saldo_produto($inventarioItem->produto);
                        $inventarioItem->qtd_ajuste = $inventarioItem->qtd_contada - $inventarioItem->qtd_estoque;
                        if (!$inventarioItem->save()) {
                            throw new \Exception('Não foi possível salvar o item: '.$key);
                        }
                    }

                    /* inclui a movimentação de estoque que faz a consolidação do inventário */
                    MovimentacaoProdutoController::consolidarInventario($inventario);
                } else {
                    foreach($request->items as $id => $item) {
                        $inventarioItem = InventarioItem::find($id);
                        $inventarioItem->qtd_contada = ($item['qtd_contada']) ? $item['qtd_contada'] : 0;
                        if (!$inventarioItem->save()) {
                            throw new \Exception('Não foi possível salvar o item: '.$key);
                        }
                    }
                }

                DB::commit();
                Session::flash('success', __('messages.update_success', ([
                    'model' => 'inventario',
                    'name' => $inventario->id
                ])));

                return redirect()->action('InventarioController@index');


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
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventario $inventario)
    {
        if (Auth::user()->canExcluirInventario()) {
            try {
                if ($inventario->delete()) {
                    Session::flash('success', __('messages.delete_success', [
                        'model' => __('models.inventario'),
                        'name' => $inventario->id 
                    ]));
                    return redirect()->action('InventarioController@index');
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
                return redirect()->action('InventarioController@index');
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }
}
