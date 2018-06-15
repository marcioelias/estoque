@extends('layouts.app')

@section('content')
    @component('components.table', [
        'captions' => $fields, 
        'rows' => $unidades, 
        'model' => 'unidade',
        'tableTitle' => 'Unidade',
        'displayField' => 'unidade',
        'actions' => ['edit', 'destroy']
        ]);
    @endcomponent
@endsection