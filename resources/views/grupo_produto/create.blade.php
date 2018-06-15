@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Novo Grupo de Produto', 
            'routeUrl' => route('grupo_produto.store'), 
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
                            'field' => 'grupo_produto',
                            'label' => 'Grupo de Produto',
                            'required' => true,
                            'autofocus' => true,
                            'inputValue' => isset($grupoProduto->grupo_produto) ? $grupoProduto->grupo_produto : ''
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@endsection