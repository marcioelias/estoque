@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Nova Entrada no Estoque', 
            'routeUrl' => route('entrada_estoque.store'), 
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
                            'type' => 'number',
                            'field' => 'nr_docto',
                            'label' => 'Nr. Documento',
                            'required' => true,
                            'autofocus' => true,
                            'inputSize' => 3
                        ],
                        [
                            'type' => 'text',
                            'field' => 'serie',
                            'label' => 'Série',
                            'required' => true,
                            'inputSize' => 3,
                        ],
                        [
                            'type' => 'datetime',
                            'field' => 'data_doc',
                            'label' => 'Data Documento',
                            'required' => true,
                            'inputSize' => 3
                        ],
                        [
                            'type' => 'datetime',
                            'field' => 'data_entrada',
                            'label' => 'Data Entrada',
                            'required' => true,
                            'inputSize' => 3
                        ],
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'select',
                            'field' => 'fornecedor_id',
                            'label' => 'Fornecedor',
                            'required' => true,
                            'items' => $fornecedores,
                            'displayField' => 'nome_razao',
                            'keyField' => 'id',
                            'liveSearch' => true,
                            'inputSize' => 7
                        ],
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
                        ],
                    ]
                ])
                @endcomponent
                <div id="entrada_estoque_produtos" class="{{ $errors->has('items') ? ' has-error' : '' }}">
                    <entrada_estoque :produtos-data="{{ json_encode($produtos) }}" :old-data="{{ json_encode(old('items')) }}"></entrada_estoque>
                    @if ($errors->has('items'))
                        <span class="help-block">
                            <strong>{{ $errors->first('items') }}</strong>
                        </span>
                    @endif
                </div>

               {{--   {{ dd($errors) }}  --}}
            @endsection
        @endcomponent
    </div>
@push('bottom-scripts')
    <script src="{{ asset('js/entradaestoque.js') }}"></script>
@endpush
@endsection