@extends('layouts.relatorios')

@section('relatorio')
@php
    $clienteVolume = 0;
    $clienteDistancia = 0;
    $departamentoVolume = 0;
    $departamentoDistancia = 0;
    $distanciaTotal = 0;
    $volumeTotal = 0;
@endphp
{{--  {{dd($clientes)}}  --}}
@foreach($clientes as $cliente) 
@php
    $clienteVolume = 0;
    $clienteDistancia = 0;
@endphp
<div class="panel-sm">
    <div class="panel-sm">
        <div class="panel-heading report-subtitle-1">
            <h4> Cliente: {{$cliente->nome_razao}} </h4>
        </div>    
        <div class="panel-body">
            @foreach($cliente->departamentos as $departamento)
            @php
                $departamentoVolume = 0;
                $departamentoDistancia = 0;     
            @endphp
            <div class="panel-sm">
                <div class="panel-heading report-subtitle-1">
                    <h5>Departamento: {{$departamento->departamento}}</h5>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed report-table">
                        <thead>
                            <td>Veículo</td>
                            <td align="right">KM Inicial</td>
                            <td align="right">KM Final</td>
                            <td align="right">Distância Percorrida</td>
                            <td align="right">Consumo Médio/KM</td>
                            <td align="right">Consumo Total</td>
                        </thead>
                        <tbody>
                            @foreach($departamento->abastecimentos as $abastecimento)
                            @php
                                $clienteVolume += $abastecimento->consumo;
                                $clienteDistancia += $abastecimento->km_final - $abastecimento->km_inicial;
                                $departamentoVolume += $abastecimento->consumo; 
                                $departamentoDistancia += $abastecimento->km_final - $abastecimento->km_inicial;  
                                $distanciaTotal += $abastecimento->km_final - $abastecimento->km_inicial;  
                                $volumeTotal += $abastecimento->consumo;
                            @endphp
                            <tr> 
                                <td> {{$abastecimento->placa}} </td>
                                <td align="right"> {{number_format($abastecimento->km_inicial, 1, ',', '.')}} </td>
                                <td align="right"> {{number_format($abastecimento->km_final, 1, ',', '.')}} </td>
                                <td align="right"> {{number_format($abastecimento->km_final - $abastecimento->km_inicial, 1, ',', '.')}} </td>
                                <td align="right"> {{number_format($abastecimento->media, 2, ',', '.')}} </td>
                                <td align="right"> {{number_format($abastecimento->consumo, 2, ',', '.')}} </td>
                            </tr>
                            @endforeach
                            <tr class="success"> 
                                <td colspan=2>Total do Departamento</td>
                                <td align="right"></td>
                                <td align="right">{{number_format($departamentoDistancia, 1, ',', '.')}} </td>
                                <td align="right"> </td>
                                <td align="right">{{number_format($departamentoVolume, 3, ',', '.')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach
<table class="table table-condensed report-table">
    <tbody>
        <tr class="default">
            <td><h5>Total Geral</h5></td>
            <td align="right"><h5>Distância Percorrida: {{number_format($distanciaTotal, 1, ',', '.')}}</h5></td>
            <td align="right"><h5>Consumo Total: {{number_format($volumeTotal, 3, ',', '.')}}</h5></td>
        </tr>
    </tbody>
</table>
@endsection