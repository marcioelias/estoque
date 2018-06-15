@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Nova Unidade', 
            'routeUrl' => route('unidade.store'), 
            'method' => 'POST',
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
                            'inputSize' => 8
                        ],
                        [
                            'type' => 'select',
                            'field' => 'permite_fracionamento',
                            'label' => 'Permite Fracionamento',
                            'inputSize' => 2,
                            'items' => Array('Não', 'Sim'),
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@endsection