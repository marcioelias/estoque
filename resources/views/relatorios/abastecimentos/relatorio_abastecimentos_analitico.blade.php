@extends('layouts.relatorios')

@section('relatorio')
@php
    $volumeAbastecido = 0;
    $valorTotal = 0;
    $volumeTotal = 0;
    $mediaGeral = 0;
    $numAbastecimentos = 0;
    $km_inicial = 0;
    $km_final = 0;
    $clienteVolume=0;
    $clienteValor=0;
    $departamentoVolume=0;
    $departamentoValor=0;
@endphp
@foreach($clientes as $cliente) 
@php
    $clienteVolume = 0;
    $clienteValor = 0;
@endphp
<table class="table table-condensed report-table">
    <thead>
        <td class="info" colspan=3><h4> Cliente: {{$cliente->nome_razao}} </h4></td>
    </thead>
    <tbody>
        @foreach($cliente->departamentos as $departamento)
        @php
            $departamentoVolume = 0;
            $departamentoValor = 0;     
        @endphp
        <tr>
            <td colspan=3>
                <table class="table table-condensed report-table">
                    <thead>
                        <td class="info" colspan=7><h5>Departamento: {{$departamento->departamento}}</h5> </td>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <table class="table table-condensed report-table">
                                    <thead>
                                        <td>Veículo</td>
                                        <td>Data/Hora Abastecimento</td>
                                        <td align="right">Valor Litro</td>
                                        <td align="right">Volume Abastecido</td>
                                        <td align="right">Valor Abastecimento</td>
                                        <td align="right">Km Veículo</td>
                                        <td align="right">Média Veículo</td>
                                    </thead>
                                    <tbody>
                                        @foreach($departamento->abastecimentos as $abastecimento)
                                        @php
                                            $clienteVolume += $abastecimento->volume_abastecimento;
                                            $clienteValor += $abastecimento->valor_abastecimento;
                                            $departamentoVolume += $abastecimento->volume_abastecimento;
                                            $departamentoValor += $abastecimento->valor_abastecimento;  
                                            $valorTotal += $abastecimento->valor_abastecimento;
                                            $volumeTotal += $abastecimento->volume_abastecimento;
                                        @endphp
                                        <tr> 
                                            <td> {{$abastecimento->placa}} </td>
                                            <td> {{date_format(date_create($abastecimento->data_hora_abastecimento), 'd/m/Y H:i:s')}} </td>
                                            <td align="right"> {{number_format($abastecimento->valor_litro, 3, ',', '.')}} </td>
                                            <td align="right"> {{number_format($abastecimento->volume_abastecimento, 3, ',', '.')}} </td>
                                            <td align="right"> {{number_format($abastecimento->valor_abastecimento, 3, ',', '.')}} </td>
                                            <td align="right"> {{number_format($abastecimento->km_veiculo, 1, ',', '.')}} </td>
                                            <td align="right"> {{number_format($abastecimento->media_veiculo, 2, ',', '.')}} </td>
                                        </tr>
                                        @endforeach
                                        <tr class="success"> 
                                            <td colspan=2>Total do Departamento</td>
                                            <td align="right"></td>
                                            <td align="right"> {{number_format($departamentoVolume, 3, ',', '.')}} </td>
                                            <td align="right"> {{number_format($departamentoValor, 3, ',', '.')}} </td>
                                            <td align="right"> </td>
                                            <td align="right"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td> 
                        </tr> 
                    </tbody>
                </table>
            </td>
        </tr>
        @endforeach
        <tr class="success"> 
            <td><strong>Total do Cliente</strong></td>
            <td align="right"><strong>Volume Abastecido: {{number_format($clienteVolume, 3, ',', '.')}}</strong></td>
            <td align="right"><strong>Valor Total: {{number_format($clienteValor, 3, ',', '.')}}</strong></td>
        </tr>   
    </tbody>
</table>
@endforeach
<table class="table table-condensed report-table">
    <tbody>
        <tr class="default">
            <td><h5>Total Geral</h5></td>
            <td align="right"><h5>Volume Abastecido: {{number_format($volumeTotal, 3, ',', '.')}}</h5></td>
            <td align="right"><h5>Valor Total: {{number_format($valorTotal, 3, ',', '.')}}</h5></td>
        </tr>
    </tbody>
</table>
@endsection