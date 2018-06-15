@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Novo Inventário', 
            'routeUrl' => route('inventario.store'), 
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
                            'type' => 'select',
                            'field' => 'estoque_id',
                            'label' => 'Estoque',
                            'required' => true,
                            'items' => $estoques,
                            'displayField' => 'estoque',
                            'keyField' => 'id',
                            'liveSearch' => true,
                            'inputSize' => 5
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@endsection