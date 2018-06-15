@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Alterar Produto', 
            'routeUrl' => route('produto.update', $produto->id), 
            'method' => 'PUT',
            'formButtons' => [
                ['type' => 'submit', 'label' => 'Salvar', 'icon' => 'ok'],
                ['type' => 'button', 'label' => 'Cancelar', 'icon' => 'remove']
                ]
            ])
            @section('formFields')
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'produto_descricao',
                            'label' => 'Descrição',
                            'required' => true,
                            'autofocus' => true,
                            'inputSize' => 6,
                            'inputValue' => $produto->produto_descricao
                        ],
                        [
                            'type' => 'text',
                            'field' => 'produto_desc_red',
                            'label' => 'Descrição Reduzida',
                            'inputSize' => 2,
                            'inputValue' => $produto->produto_desc_red
                        ],
                        [
                            'type' => 'select',
                            'field' => 'grupo_produto_id',
                            'label' => 'Grupo',
                            'required' => true,
                            'items' => $grupoProdutos,
                            'inputSize' => 4,
                            'displayField' => 'grupo_produto',
                            'keyField' => 'id',
                            'liveSearch' => true,
                            'indexSelected' => $produto->grupo_produto_id
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'select',
                            'field' => 'unidade_id',
                            'label' => 'Unidade',
                            'required' => true,
                            'items' => $unidades,
                            'inputSize' => 4,
                            'displayField' => 'unidade',
                            'keyField' => 'id',
                            'liveSearch' => true,
                            'indexSelected' => $produto->unidade_id
                        ],
                        [
                            'type' => 'text',
                            'field' => 'valor_custo',
                            'label' => 'Preço de Custo',
                            'inputSize' => 4,
                            'inputValue' => $produto->valor_custo
                        ],
                        [
                            'type' => 'text',
                            'field' => 'valor_venda',
                            'label' => 'Preço de Venda',
                            'inputSize' => 4,
                            'inputValue' => $produto->valor_venda
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'select',
                            'field' => 'controla_vencimento',
                            'label' => 'Controla Vencimento',
                            'inputSize' => 4,
                            'items' => Array('Não', 'Sim'),
                            'indexSelected' => $produto->controla_vencimento
                        ],  
                        [
                            'type' => 'text',
                            'field' => 'vencimento_dias',
                            'label' => 'Vencimento em Dias',
                            'inputSize' => 4,
                            'inputValue' => $produto->vencimento_dias
                        ],
                        [
                            'type' => 'text',
                            'field' => 'vencimento_km',
                            'label' => 'Vencimento em Km',
                            'inputSize' => 4,
                            'inputValue' => $produto->vencimento_km
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'numero_serie',
                            'label' => 'Número de Série',
                            'inputSize' => 6,
                            'inputValue' => $produto->numero_serie
                        ],
                        [
                            'type' => 'text',
                            'field' => 'codigo_barras',
                            'label' => 'Código de Barras',
                            'inputSize' => 6,
                            'inputValue' => $produto->codigo_barras
                        ]
                    ]
                ])
                @endcomponent
                <div class="row">
                    <div class="col-md-6">
                        @component('components.input-checklist-group', [
                            'items' => $estoques,
                            'label' => 'estoque',
                            'field' => 'estoques[]',
                            'title' => 'Estoques',
                            'value' => 'id',
                            'indexSelected' => $produto->estoques()->pluck('estoque_id')
                        ])
                        @endcomponent                        
                    </div>
                    <div class="col-md-6">
                        @component('components.input-checklist-group', [
                            'items' => $fornecedores,
                            'label' => 'nome_razao',
                            'field' => 'fornecedores[]',
                            'title' => 'Fornecedores',
                            'value' => 'id',
                            'indexSelected' => $produto->fornecedores()->pluck('fornecedor_id')
                        ])
                        @endcomponent
                    </div>
                </div>
            @endsection
        @endcomponent
    </div>
    <script>
        jQuery(function($){
            $("#valor").mask('0.00', {reverse: true});
        });
    </script>
@endsection