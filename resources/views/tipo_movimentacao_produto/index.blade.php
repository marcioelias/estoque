@extends('layouts.app')

@section('content')
    @component('components.table', [
        'captions' => $fields, 
        'rows' => $tipoMovimentacaoProdutos, 
        'model' => 'tipo_movimentacao_produto',
        'tableTitle' => 'Tipo de Movimentação de Produtos',
        'displayField' => 'tipo_movimentacao_produto',
        'actions' => ['edit', 'destroy']
        ]);
    @endcomponent
@endsection