@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Alterar Inventário', 
            'routeUrl' => route('inventario.update', $inventario->id), 
            'method' => 'PUT',
            'formButtons' => [
                //['type' => 'button', 'label' => 'Salvar', 'icon' => 'floppy-save'],
                ['type' => 'submit', 'label' => 'Salvar', 'icon' => 'ok'],
                ['type' => 'button', 'label' => 'Cancelar', 'icon' => 'remove']
                ]
            ])
            @section('formFields')
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'id',
                            'label' => 'ID',
                            'disabled' => true,
                            'inputValue' => $inventario->id,
                            'inputSize' => 1
                        ],
                        [
                            'type' => 'text',
                            'field' => 'estoque',
                            'label' => 'Estoque',
                            'disabled' => true,
                            'inputValue' => $inventario->estoque->estoque,
                            'inputSize' => 4
                        ],
                        [
                            'type' => 'datetime',
                            'field' => 'data_abertura',
                            'label' => 'Data Abertura',
                            'disabled' => true,
                            'inputValue' => $inventario->data_abertura,
                            'inputSize' => 3
                        ],
                        [
                            'type' => 'datetime',
                            'field' => 'data_fechamento',
                            'label' => 'Data Fechamento',
                            'disabled' => true,
                            'inputValue' => $inventario->data_fechamento,
                            'inputSize' => 3
                        ],
                        [
                            'type' => 'select',
                            'field' => 'fechado',
                            'label' => 'Fechado',
                            'inputSize' => 1,
                            'indexSelected' => $inventario->fechado,
                            'items' => Array('Não', 'Sim'),
                        ]
                    ]
                ])
                @endcomponent
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-1 col-sm-1 col-md-1">ID</div>
                            <div class="col col-xs-7 col-sm-7 col-md-9">Produto</div>
                            <div class="col col-xs-4 col-sm-4 col-md-2">Qtd Contada</div>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 0px 15px !important">
                        @foreach($inventario->inventario_items as $key => $item)
                        <div class="row {{ ($key % 2 == 0) ? 'bg-info' : 'bg-warning' }}">
                            <div class="col col-xs-1 col-sm-1 col-md-1" style="padding-top: 3px">{{ $item->produto->id }}</div>
                            <div class="col col-xs-7 col-sm-7 col-md-9" style="padding-top: 3px">{{ $item->produto->produto_descricao }}</div>
                            <div class="col col-xs-4 col-sm-4 col-md-2">
                                <input type="text" class="form-control input-sm" name="items[{{$item->id}}][qtd_contada]" value="{{ (old('items[$item->id][qtd_contada]')) ? old('items[$item->id][qtd_contada]') : $item->qtd_contada }}" >
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endsection
        @endcomponent
    </div>
@endsection