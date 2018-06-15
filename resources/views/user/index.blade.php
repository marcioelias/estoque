@extends('layouts.app')

@section('content')
    @component('components.table', [
        'captions' => $fields, 
        'rows' => $users, 
        'model' => 'user',
        'tableTitle' => 'Usuários',
        'displayField' => 'unidade',
        'actions' => ['edit', 'destroy']
        ]);
    @endcomponent
@endsection