@extends('layouts.app')

@section('content')
    @component('components.table', [
        'captions' => $fields, 
        'rows' => $tanques, 
        'model' => 'tanque',
        'tableTitle' => 'Tanques',
        'displayField' => 'descricao_tanque',
        'actions' => ['edit', 'destroy']
        ]);
    @endcomponent
@endsection