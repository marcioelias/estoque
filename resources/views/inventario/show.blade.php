@extends('layouts.relatorios')

@section('relatorio')
<table class="table table-condensed table-bordered report-table">
    <thead>
        <tr class="info">
            <td>
                Id
            </td>
            <td>
                Produto
            </td>
            <td>
                Qtd Em Estoque
            </td>
            <td>
                Qtd Contada
            </td>
            <td>
                Ajuste
            </td>
            <td>
                Ajustado
            </td>
        </tr>
    </thead>
    <tbody>
        @foreach($inventario->inventario_items as $inventario_item) 
        <tr>
            <td>
                {{$inventario_item->produto->id}}
            </td>
            <td>
                {{$inventario_item->produto->produto_descricao}}
            </td>
            <td>
                {{$inventario_item->qtd_estoque}}
            </td>
            <td>
                {{($inventario_item->qtd_contada > 0) ? $inventario_item->qtd_contada : ''}}
            </td>
            <td>
                {{$inventario_item->qtd_ajuste}}
            </td>
            <td>
                {{($inventario_item->ajustado) ? 'Sim' : 'Não'}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection