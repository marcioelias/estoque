@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Alterar Unidade', 
            'routeUrl' => route('unidade.update', $unidade->id), 
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
                            'field' => 'unidade',
                            'label' => 'Unidade',
                            'required' => true,
                            'autofocus' => true,
                            'inputValue' => $unidade->unidade,
                            'inputSize' => 8
                        ],
                        [
                            'type' => 'select',
                            'field' => 'permite_fracionamento',
                            'label' => 'Permite Fracionamento',
                            'inputSize' => 2,
                            'indexSelected' => $unidade->permite_fracionamento,
                            'items' => ['Não', 'Sim'],
                        ],
                        [
                            'type' => 'select',
                            'field' => 'ativo',
                            'label' => 'Ativo',
                            'inputSize' => 1,
                            'indexSelected' => $unidade->ativo,
                            'items' => ['Não', 'Sim'],
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@endsection