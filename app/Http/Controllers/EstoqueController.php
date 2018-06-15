<?php

namespace App\Http\Controllers;

use App\Estoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EstoqueController extends Controller
{
    public $fields = [
        'id' => 'ID',
        'estoque' => 'Estoque',
        'ativo' => ['label' => 'Ativo', 'type' => 'bool']
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->canListarEstoque()) {
            if ($request->searchField) {
                $estoques = Estoque::where('estoque', 'like', '%'.$request->searchField.'%')->paginate();
            } else {
                $estoques = Estoque::paginate();
            }

            return View('estoque.index')
                    ->withEstoques($estoques)
                    ->withFields($this->fields);
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
        if (Auth::user()->canCadastrarEstoque()) {
            return View('estoque.create');
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
        if (Auth::user()->canCadastrarEstoque()) {
            $this->validate($request, [
                'estoque' => 'required|string|min:5'
            ]);

            try {
                $estoque = new Estoque($request->all());
                if ($estoque->save()) {
                    Session::flash('success', __('messages.create_success', [
                        'model' => __('models.estoque'),
                        'name' => $estoque->estoque
                    ]));
                    return redirect()->action('EstoqueController@index');
                } else {
                    Session::flash('success', __('messages.create_error', [
                        'model' => __('models.estoque'),
                        'name' => $estoque->estoque
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
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function edit(Estoque $estoque)
    {
        if (Auth::user()->canAlterarEstoque()) {
            return View('estoque.edit')->withEstoque($estoque);
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estoque $estoque)
    {
        if (Auth::user()->canAlterarEstoque()) {
            $this->validate($request, [
                'estoque' => 'required|string|min:5'
            ]);

            try {
                $estoque->estoque = $request->estoque;
                $estoque->ativo = $request->ativo;

                if ($estoque->save()) {
                    Session::flash('success', __('messages.update_success', [
                        'model' => __('models.estoque'),
                        'name' => $estoque->estoque
                    ]));
                    return redirect()->action('EstoqueController@index');
                } else {
                    Session::flash('success', __('messages.update_error', [
                        'model' => __('models.estoque'),
                        'name' => $estoque->estoque
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
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estoque $estoque)
    {
        if (Auth::user()->canExcluirEstoque()) {
            try {
                if ($estoque->delete()) {
                    Session::flash('success', __('messages.delete_success', [
                        'model' => __('models.estoque'),
                        'name' => $estoque->estoque
                    ]));
                    return redirect()->action('EstoqueController@index');
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
                return redirect()->action('EstoqueController@index');
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        } 
    }
}
