@extends('layouts.relatorios')

@section('relatorio')
<table class="table table-condensed report-table">
    <thead>
        <tr class="info">
            <td>
                Id
            </td>
            <td>
                Produto
            </td>
            <td>
                Qtd em Estoque
            </td>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto) 
        <tr>
            <td>
                {{$produto->id}}
            </td>
            <td>
                {{$produto->produto_descricao}}
            </td>
            <td>
                {{$produto->posicao}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection