@extends('layouts.app')

@section('content')
    @component('components.table', [
        'captions' => $fields, 
        'rows' => $grupoProdutos, 
        'model' => 'grupo_produto',
        'tableTitle' => 'Grupo de Produto',
        'displayField' => 'grupo_produto',
        'actions' => ['edit', 'destroy']
        ]);
    @endcomponent
@endsection