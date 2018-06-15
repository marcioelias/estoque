<?php

namespace App\Http\Controllers;

use App\Uf;
use App\Fornecedor;
use App\TipoPessoa;
use App\Rules\cpfCnpj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FornecedorController extends Controller
{
    public $fields = [
        'id' => 'ID',
        'nome_razao' => 'Fornecedor',
        'fone' => 'Telefone',
        'ativo' => ['label' => 'Ativo', 'type' => 'bool'] 
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->canListarFornecedor()) {
            if ($request->searchField) {
                $fornecedores = Fornecedor::where('nome_razao', 'like', '%'.$request->searchField.'%')
                                          ->orWhere('apelido_fantasia', 'like', '%'.$request->searchField.'%')
                                          ->paginate();
            } else {
                $fornecedores = Fornecedor::paginate();
            }

            return View('fornecedor.index')
                    ->withFornecedores($fornecedores)
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
        if (Auth::user()->canCadastrarFornecedor()) {
            return View('fornecedor.create', [
                'ufs' => Uf::all(),
                'tipoPessoas' => TipoPessoa::all()
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
        if (Auth::user()->canCadastrarFornecedor()) {
            $this->validate($request, [
                'nome_razao' => 'required|string|min:5',
                'apelido_fantasia' => 'required|string|min:5',
                'cpf_cnpj' => ['required', new cpfCnpj],
                'rg_ie' => 'required',
                'fone' =>  'required|celular_com_ddd',
                'email' => 'nullable|email',
                'endereco' => 'required|string|min:3|max:200',
                'numero' => 'required',
                'bairro' => 'required|string|min:3|max:200',
                'cidade' => 'required|string|min:3|max:200',
                'cep' => 'required',
                'uf_id' => 'required'
            ]);

            try {
                $fornecedor = new Fornecedor($request->all());
                if ($fornecedor->save()) {
                    Session::flash('success', __('messages.create_success', [
                        'model' => __('models.fornecedor'),
                        'name' => $fornecedor->nome_razao
                    ]));
                    return redirect()->action('FornecedorController@index');
                } else {
                    Session::flash('success', __('messages.create_error', [
                        'model' => __('models.fornecedor'),
                        'name' => $fornecedor->nome_razao
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
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedor $fornecedor)
    {
        if (Auth::user()->canAlterarFornecedor()) {
            return View('fornecedor.edit', [
                'fornecedor' => $fornecedor,
                'ufs' => Uf::all(),
                'tipoPessoas' => TipoPessoa::all()
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
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        if (Auth::user()->canAlterarFornecedor()) {
            $this->validate($request, [
                'nome_razao' => 'required|string|min:5',
                'apelido_fantasia' => 'required|string|min:5',
                'cpf_cnpj' => ['required', new cpfCnpj],
                'rg_ie' => 'required',
                'fone' =>  'required|celular_com_ddd',
                'email' => 'nullable|email',
                'endereco' => 'required|string|min:3|max:200',
                'numero' => 'required',
                'bairro' => 'required|string|min:3|max:200',
                'cidade' => 'required|string|min:3|max:200',
                'cep' => 'required',
                'uf_id' => 'required'
            ]);

            try {
                foreach($request->all() as $field => $value) {
                    if (($field != '_token') && ($field != '_method')) {
                        $fornecedor->$field = $value;
                    }
                }
                if ($fornecedor->save()) {
                    Session::flash('success', __('messages.update_success', [
                        'model' => __('models.fornecedor'),
                        'name' => $fornecedor->nome_razao
                    ]));
                    return redirect()->action('FornecedorController@index');
                } else {
                    Session::flash('success', __('messages.update_error', [
                        'model' => __('models.fornecedor'),
                        'name' => $fornecedor->nome_razao
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
     * @param  \App\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        if (Auth::user()->canExcluirFornecedor()) {
            try {
                if ($fornecedor->delete()) {
                    Session::flash('success', __('messages.delete_success', [
                        'model' => __('models.fornecedor'),
                        'name' => $fornecedor->nome_razao
                    ]));
                    return redirect()->action('FornecedorController@index');
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
                return redirect()->action('FornecedorController@index');
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        } 
    }
}
