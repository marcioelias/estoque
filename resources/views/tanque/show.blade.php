@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
       <canvas id="posicaoTanque"></canvas>
    </div>
    <script>
        var data = {
            labels: ['Ocupado', 'Livre'],
            datasets: [
                {
                    data: [80, 20]
                }
            ]
        }
        var context = document.querySelector('#posicaoTanque').getContext('2d');

        new Chart(context).doughnut(data);
    </script>
@endsection