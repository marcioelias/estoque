@php
    $data_inicial = isset($_GET['data_inicial']) ? $_GET['data_inicial'] : null;
    $data_final = isset($_GET['data_final']) ? $_GET['data_final'] : null;
@endphp
@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Relatório de Média de Consumo por Modelo', 
            'routeUrl' => route('relatorio_media_modelo'), 
            'formTarget' => '_blank',
            'method' => 'POST',
            'formButtons' => [
                ['type' => 'submit', 'label' => 'Gerar Relatório', 'icon' => 'stats'],
                ['type' => 'button', 'label' => 'Cancelar', 'icon' => 'remove']
                ]
            ])
            @section('formFields')
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'datetime',
                            'field' => 'data_inicial',
                            'label' => 'Data Inicial',
                            'inputSize' => 4,
                            'dateTimeFormat' => 'DD/MM/YYYY',
                            'picker_begin' => 'data_inicial',
                            'picker_end' => 'data_final',
                        ],
                        [
                            'type' => 'datetime',
                            'field' => 'data_final',
                            'label' => 'Data Final',
                            'inputSize' => 4,
                            'dateTimeFormat' => 'DD/MM/YYYY',
                            'picker_begin' => 'data_inicial',
                            'picker_end' => 'data_final',
                        ],
                        [
                            'type' => 'btn-group',
                            'field' => 'tipo_relatorio',
                            'label' => 'Tipo de Relatório',
                            'radioButtons' => [
                                [
                                    'label' => 'Sintético',
                                    'value' => 1
                                ],
                                [
                                    'label' => 'Analítico',
                                    'value' => 0
                                ],
                            ],
                            'inputSize' => 4,
                            'defaultValue' => 1
                        ]
                    ]
                ])  
                @endcomponent 
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'select',
                            'field' => 'marca_veiculo_id',
                            'label' => 'Marca',
                            'required' => true,
                            'items' => $marcaVeiculos,
                            'autofocus' => true,
                            'displayField' => 'marca_veiculo',
                            'liveSearch' => true,
                            'keyField' => 'id',
                            'defaultNone' => true,
                            'inputSize' => 6
                        ],
                        [
                            'type' => 'select',
                            'field' => 'modelo_veiculo_id',
                            'label' => 'Modelo',
                            'required' => true,
                            'items' => null,
                            'autofocus' => true,
                            'displayField' => 'modelo_veiculo',
                            'liveSearch' => true,
                            'keyField' => 'id',
                            'defaultNone' => true,
                            'disabled' => true,
                            'inputSize' => 6
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
    <script>
        $(document).ready(function() {
            var buscarModeloVeiculos = function() {
                var marca = {};

                marca.id = $('#marca_veiculo_id').val();
                marca._token = $('input[name="_token"]').val();

                console.log(marca);
                $.ajax({
                    url: '{{ route("modelo_veiculos.json") }}',
                    type: 'POST',
                    data: marca,
                    dataType: 'JSON',
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        $("#modelo_veiculo_id")
                            .removeAttr('disabled')
                            .find('option')
                            .remove();


                        $.each(data, function (i, item) {
                            $('#modelo_veiculo_id').append($('<option>', { 
                                value: item.id,
                                text : item.modelo_veiculo 
                            }));
                        });

                        @if(old('modelo_veiculo_id'))
                        $('#modelo_veiculo_id').selectpicker('val', {{old('modelo_veiculo_id')}});
                        @endif

                        $('.selectpicker').selectpicker('refresh');
                    }
                });
            }
            $('#marca_veiculo_id').on('changed.bs.select', buscarModeloVeiculos);
            
            if ($('#marca_veiculo_id').val()) {
                buscarModeloVeiculos();
            }
        });
    </script>
@endsection