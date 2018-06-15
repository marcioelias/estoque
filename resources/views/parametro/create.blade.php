@extends('layouts.app')

@section('content')
@if (Session::has('success'))
	<div class="alert alert-success alert-dismissible" id="success-alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('success') }}
    </div>
@endif
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Parametrização', 
            'routeUrl' => route('parametro.store'), 
            'method' => 'POST',
            'fileUpload' => true,
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
                            'field' => 'cliente_id',
                            'label' => 'Cliente',
                            'required' => true,
                            'items' => $clientes,
                            'autofocus' => true,
                            'displayField' => 'nome_razao',
                            'liveSearch' => true,
                            'keyField' => 'id',
                            'defaultNone' => true
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'file',
                            'field' => 'logotipo',
                            'label' => 'Logotipo',
                            'required' => true,
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@endsection