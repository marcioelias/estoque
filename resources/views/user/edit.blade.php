@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Alterar Usuário', 
            'routeUrl' => route('user.update', $user->id), 
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
                            'field' => 'name',
                            'label' => 'Nome',
                            'required' => true,
                            'autofocus' => true,
                            'inputValue' => $user->name,
                            'inputSize' => 11
                        ],
                        [
                            'type' => 'select',
                            'field' => 'ativo',
                            'label' => 'Ativo',
                            'inputSize' => 1,
                            'indexSelected' => $user->ativo,
                            'items' => Array('Não', 'Sim'),
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'username',
                            'disabled' => true,
                            'label' => 'Usuário',
                            'required' => true,
                            'inputValue' => $user->username,
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'email',
                            'label' => 'E-mail',
                            'required' => true,
                            'inputValue' => $user->email
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'password',
                            'field' => 'password',
                            'label' => 'Senha',
                            'required' => true,
                            'inputSize' => 6
                        ],
                        [
                            'type' => 'password',
                            'field' => 'password_confirmation',
                            'label' => 'Confirmação de Senha',
                            'required' => true,
                            'inputSize' => 6
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@endsection