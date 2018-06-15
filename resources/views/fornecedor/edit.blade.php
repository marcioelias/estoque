@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Alterar Fornecedor', 
            'routeUrl' => route('fornecedor.update', $fornecedor->id), 
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
                            'type' => 'select',
                            'field' => 'tipo_pessoa_id',
                            'label' => 'Tipo Pessoa',
                            'required' => true,
                            'autofocus' => true,
                            'items' => $tipoPessoas,
                            'inputSize' => 2,
                            'displayField' => 'tipo_pessoa',
                            'keyField' => 'id',
                            'disabled' => true,
                            'indexSelected' => $fornecedor->tipo_pessoa_id

                        ],
                        [
                            'type' => 'text',
                            'field' => 'nome_razao',
                            'label' => 'Nome/Razão Sozial',
                            'required' => true,
                            'inputSize' => 9,
                            'inputValue' => $fornecedor->nome_razao
                        ],
                        [
                            'type' => 'select',
                            'field' => 'ativo',
                            'label' => 'Ativo',
                            'inputSize' => 1,
                            'indexSelected' => $fornecedor->ativo,
                            'items' => Array('Não', 'Sim'),
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'apelido_fantasia',
                            'label' => 'Nome Fantasia',
                            'inputValue' => $fornecedor->apelido_fantasia
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'cpf_cnpj',
                            'label' => 'CPF/CNPJ',
                            'required' => true,
                            'inputSize' => 4,
                            'inputValue' => $fornecedor->cpf_cnpj
                        ],
                        [
                            'type' => 'text',
                            'field' => 'rg_ie',
                            'label' => 'RG/IE',
                            'required' => true,
                            'inputSize' => 4,
                            'inputValue' => $fornecedor->rg_ie
                        ],
                        [
                            'type' => 'text',
                            'field' => 'im',
                            'label' => 'Insc. Mun.',
                            'required' => true,
                            'inputSize' => 4,
                            'inputValue' => $fornecedor->im
                        ]
                    ]
                ])
                @endcomponent
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>CONTATOS</strong>
                    </div>
                    <div class="panel-body">
                        @component('components.form-group', [
                            'inputs' => [
                                [
                                    'type' => 'text',
                                    'field' => 'fone',
                                    'label' => 'Fone',
                                    'required' => true,
                                    'inputSize' => 6,
                                    'inputValue' => $fornecedor->fone,
                                    'css' => 'mask_phone'
                                ],
                                [
                                    'type' => 'text',
                                    'field' => 'email',
                                    'label' => 'E-mail',
                                    'inputSize' => 6,
                                    'inputValue' => $fornecedor->email
                                ]
                            ]
                        ])
                        @endcomponent
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>ENDEREÇO</strong>
                    </div>
                    <div class="panel-body">
                        @component('components.form-group', [
                            'inputs' => [
                                [
                                    'type' => 'text',
                                    'field' => 'endereco',
                                    'label' => 'Endereço',
                                    'required' => true,
                                    'inputSize' => 11,
                                    'inputValue' => $fornecedor->endereco
                                ],
                                [
                                    'type' => 'text',
                                    'field' => 'numero',
                                    'label' => 'Número',
                                    'inputSize' => 1,
                                    'inputValue' => $fornecedor->numero
                                ],
                            ]
                        ])
                        @endcomponent
                        @component('components.form-group', [
                            'inputs' => [
                                [
                                    'type' => 'text',
                                    'field' => 'bairro',
                                    'label' => 'Bairro',
                                    'inputSize' => 4,
                                    'inputValue' => $fornecedor->bairro
                                ],
                                [
                                    'type' => 'text',
                                    'field' => 'cidade',
                                    'label' => 'Cidade',
                                    'inputSize' => 4,
                                    'inputValue' => $fornecedor->cidade
                                ],
                                [
                                    'type' => 'text',
                                    'field' => 'cep',
                                    'label' => 'Cep',
                                    'inputSize' => 2,
                                    'inputValue' => $fornecedor->cep
                                ],
                                [
                                    'type' => 'select',
                                    'field' => 'uf_id',
                                    'label' => 'UF',
                                    'required' => true,
                                    'items' => $ufs,
                                    'inputSize' => 2,
                                    'displayField' => 'uf',
                                    'liveSearch' => true,
                                    'keyField' => 'id',
                                    'indexSelected' => $fornecedor->uf_id
                                ]
                            ]
                        ])
                        @endcomponent
                    </div>
                </div>
            @endsection
        @endcomponent
    </div>
    <script>
        $(document).ready(function() {
            var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00)00000-0000' : '(00)0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                },
                placeholder: '(__) ______-_____'
            };

            $('.mask_phone').mask(SPMaskBehavior, spOptions);

            $('#cep').mask('00.000-000', {placeholder: '__.___-___'});
            
            if ($("#tipo_pessoa_id").val() == 1) {
                $("#cpf_cnpj").mask('000.000.000-00', {placeholder: '___.___.___-__'});
            } else {
               $("#cpf_cnpj").mask('00.000.000/0000-00', {placeholder: '__.___.___/____-__'}); 
            }

            $('#tipo_pessoa_id').on('changed.bs.select', function (e) {
                $("#cpf_cnpj").val('');
                if ($("#tipo_pessoa_id").val() == 1) {
                    $("#cpf_cnpj").mask('000.000.000-00', {placeholder: '___.___.___-__'});
                } else {
                    $("#cpf_cnpj").mask('00.000.000/0000-00', {placeholder: '__.___.___/____-__'}); 
                }
            });
        });
    </script>
@endsection