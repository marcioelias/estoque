@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        @component('components.form', [
            'title' => 'Posição de Estoque', 
            'routeUrl' => route('relatorio_posicao_estoque'), 
            'formTarget' => '_blank',
            'method' => 'POST',
            'formButtons' => [
                ['type' => 'submit', 'label' => 'Gerar Relatório', 'icon' => 'stats'],
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
                            'autofocus' => true,
                            'displayField' => 'estoque',
                            'liveSearch' => true,
                            'keyField' => 'id',
                            'defaultNone' => true,
                            'inputSize' => 4
                        ],
                        [
                            'type' => 'select',
                            'field' => 'grupo_produto_id',
                            'label' => 'Grupo de Produto',
                            'items' => $grupo_produtos,
                            'displayField' => 'grupo_produto',
                            'liveSearch' => true,
                            'keyField' => 'id',
                            'defaultNone' => true,
                            'inputSize' => 4
                        ],
                        [
                            'type' => 'select',
                            'field' => 'produto_id',
                            'label' => 'Produto',
                            'items' => $produtos,
                            'autofocus' => true,
                            'displayField' => 'produto_descricao',
                            'liveSearch' => true,
                            'keyField' => 'id',
                            'defaultNone' => true,
                            'inputSize' => 4
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
    <script>
        $(document).ready(function() {
            var buscarDepartamentos = function() {
                var departamento = {};

                departamento.id = $('#cliente_id').val();
                departamento._token = $('input[name="_token"]').val();

                console.log(departamento);
                $.ajax({
                    url: '{{ route("departamentos.json") }}',
                    type: 'POST',
                    data: departamento,
                    dataType: 'JSON',
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        $("#departamento_id")
                            .removeAttr('disabled')
                            .find('option')
                            .remove();

                        $('#departamento_id').append($('<option>', { 
                                value: -1,
                                text : 'NADA SELECIONADO'
                        }));
                        $.each(data, function (i, item) {
                            $('#departamento_id').append($('<option>', { 
                                value: item.id,
                                text : item.departamento 
                            }));
                        });
                        
                        @if(old('departamento_id'))
                        $('#departamento_id').selectpicker('val', {{old('departamento_id')}});
                        @endif

                        $('.selectpicker').selectpicker('refresh');
                    }
                });
            }


            {{--  var buscarPorCliente = function() {
                buscarDepartamentos();
            }
  --}}
            $('#cliente_id').on('changed.bs.select', buscarDepartamentos);
        });
    </script>
@endsection