@extends('layouts.app')

@section('content')
    @component('components.table', [
        'captions' => $fields, 
        'rows' => $inventarios, 
        'model' => 'inventario',
        'tableTitle' => 'Inventário',
        'displayField' => 'id',
        'actions' => [['action' => 'show', 'target' => '_blank'], 'edit', 'destroy']
        ]);
    @endcomponent
@endsection