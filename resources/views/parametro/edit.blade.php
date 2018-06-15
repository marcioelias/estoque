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
            'routeUrl' => route('parametro.update', $parametro->id), 
            'method' => 'PUT',
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
                            'defaultNone' => true,
                            'inputSize' => 12,
                            'indexSelected' => $parametro->cliente_id
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
                            'inputValue' => $parametro->logotipo
                        ]
                    ]
                ])
                @endcomponent
                @if($parametro->logotipo)
                <div class="panel">
                    <div>
                        <img src="{{ asset($parametro->logotipo) }}" width="200px">
                    </div>
                </div>
                @endif
            @endsection 
        @endcomponent
    </div>
@endsection