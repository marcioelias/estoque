@extends('layouts.app')

@section('content')
    @component('components.table', [
        'captions' => $fields, 
        'rows' => $produtos, 
        'model' => 'produto',
        'tableTitle' => 'Produtos',
        'displayField' => 'produto_descricao',
        'actions' => ['edit', 'destroy']
        ]);
    @endcomponent
@endsection