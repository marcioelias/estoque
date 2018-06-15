<?php

namespace App\Http\Controllers;

use App\Uf;
use App\Cliente;
use App\Parametro;
use App\TipoPessoa;
use App\Rules\cpfCnpj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClienteController extends Controller
{
    public $fields = array(
        'id' => 'ID',
        'nome_razao' => 'Nome/Razão Social',
        'cpf_cnpj' => 'CPF/CNPJ',
        'fone1' => 'Fone [1]',
        'fone2' => 'Fone [2]',
        'ativo' => ['label' => 'Ativo', 'type' => 'bool']
    );


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->canListarCliente()) {
            if ($request->searchField) {
                $clientes = Cliente::where('nome_razao', 'like', '%'.$request->searchField.'%')
                                    ->orWhere('fantasia', 'like', '%'.$request->searchField.'%')
                                    ->orWhere('cpf_cnpj', 'like', '%'.$request->searchField.'%')
                                    ->orWhere('rg_ie', 'like', '%'.$request->searchField.'%')
                                    ->orWhere('endereco', 'like', '%'.$request->searchField.'%')
                                    ->orWhere('fone1', 'like', '%'.$request->searchField.'%')
                                    ->orWhere('fone2', 'like', '%'.$request->searchField.'%')
                                    ->paginate();
            } else {
                $clientes = Cliente::paginate();
            }

            return View('cliente.index', [
                'clientes' => $clientes,
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
        if (Auth::user()->canCadastrarCliente()) {
            return View('cliente.create', [
                'tipoPessoas' => TipoPessoa::all(),
                'ufs' => Uf::all()
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
        if (Auth::user()->canCadastrarCliente()) {
            $this->validate($request, [
                'nome_razao' => 'required|string|unique:clientes',
                'fantasia' => 'nullable|string',
                'cpf_cnpj' => ['required', new cpfCnpj], 
                'rg_ie' => 'required',           
                'fone1' =>  'required|celular_com_ddd',
                'fone2' => 'nullable|celular_com_ddd',
                'email1' => 'nullable|email',
                'email2' => 'nullable|email',
                'endereco' => 'required|string|min:3|max:200',
                'numero' => 'required',
                'bairro' => 'required|string|min:3|max:200',
                'cidade' => 'required|string|min:3|max:200',
                'cep' => 'required',
                'uf_id' => 'required'
            ]);

            try {
                $cliente = new Cliente($request->all());
                
                if ($cliente->save()) {
                    Session::flash('success', __('messages.create_success', [
                        'model' => __('models.cliente'),
                        'name' => $cliente->nome_razao
                    ]));
                    return redirect()->action('ClienteController@index');
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
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        if (Auth::user()->canAlterarCliente()) {
            return View('cliente.edit', [
                'ufs' => Uf::all(),
                'tipoPessoas' => TipoPessoa::all(),
                'cliente' => $cliente
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
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        if (Auth::user()->canAlterarCliente()) {
            $this->validate($request, [
                'nome_razao' => 'required|string|unique:clientes,id,'.$cliente->id,
                'fantasia' => 'nullable|string',
                'cpf_cnpj' => ['required', new cpfCnpj], 
                'rg_ie' => 'required',           
                'fone1' =>  'required|celular_com_ddd',
                'fone2' => 'nullable|celular_com_ddd',
                'email1' => 'nullable|email',
                'email2' => 'nullable|email',
                'endereco' => 'required|string|min:3|max:200',
                'numero' => 'required',
                'bairro' => 'required|string|min:3|max:200',
                'cidade' => 'required|string|min:3|max:200',
                'cep' => 'required',
                'uf_id' => 'required'
            ]);

            try {
                $cliente->nome_razao = $request->nome_razao;
                $cliente->fantasia = $request->fantasia;
                $cliente->cpf_cnpj = $request->cpf_cnpj;
                $cliente->rg_ie = $request->rg_ie;
                $cliente->fone1 = $request->fone1;
                $cliente->fone2 = $request->fone2;
                $cliente->email1 = $request->email1;
                $cliente->email2 = $request->email2;
                $cliente->endereco = $request->endereco;
                $cliente->numero = $request->numero;
                $cliente->bairro = $request->bairro;
                $cliente->cidade = $request->cidade;
                $cliente->cep = $request->cep;
                $cliente->uf_id = $request->uf_id;
                $cliente->ativo = $request->ativo;

                
                if ($cliente->save()) {
                    Session::flash('success', __('messages.update_success', [
                        'model' => __('models.cliente'),
                        '$cliente->nome_razao'
                    ]));
                    return redirect()->action('ClienteController@index');
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
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        if (Auth::user()->canExcluirCliente()) {
            try {
                if ($cliente->delete()) {
                    Session::flash('success', __('messages.delete_success', [
                        'model' => __('models.cliente'),
                        'name' => $cliente->nome_razao
                    ]));
                    return redirect()->action('ClienteController@index');
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
                return redirect()->action('ClienteController@index');
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        } 
    }
    
    public function listagemClientes() {
        return View('relatorios.clientes.listagem_clientes')->withClientes(Cliente::all())->withTitulo('Listagem de Clientes')->withParametro(Parametro::first());
    }
}
