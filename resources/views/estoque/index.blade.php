@extends('layouts.app')

@section('content')
    @component('components.table', [
        'captions' => $fields, 
        'rows' => $estoques, 
        'model' => 'estoque',
        'tableTitle' => 'Estoque',
        'displayField' => 'estoque',
        'actions' => ['edit', 'destroy']
        ]);
    @endcomponent
@endsection