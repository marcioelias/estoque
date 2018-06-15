@extends('layouts.app')

@section('content')
    @component('components.table', [
        'captions' => $fields, 
        'rows' => $fornecedores, 
        'model' => 'fornecedor',
        'tableTitle' => 'Fornecedores',
        'displayField' => 'nome_razao',
        'actions' => ['edit', 'destroy']
        ]);
    @endcomponent
@endsection