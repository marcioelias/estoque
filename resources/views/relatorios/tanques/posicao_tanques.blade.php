@extends('layouts.relatorios')

@section('relatorio')
{!! Charts::scripts() !!}

    <div class="row">
    @foreach($graficos as $grafico)
        <div class="col-sm-12 col-md-6 col-lg-4">
            {!! $grafico->html() !!}
        </div>
    @endforeach
    </div>

@foreach($graficos as $grafico)
    {!! $grafico->script() !!}
@endforeach

@endsection