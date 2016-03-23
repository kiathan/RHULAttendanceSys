@extends('Master.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <div id="chart_div"></div>
            </div>
        </div>
    </div>

    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawMultSeries);

        function drawMultSeries() {
            var data = google.visualization.arrayToDataTable([
                ['Question', ''],
                    @foreach($data as $result)
                ['{{$result->awnser}}', 8175000],
                @endforeach
            ]);

            var options = {
                title: '',
                chartArea: {width: '50%'},
                hAxis: {
                    title: 'Number of student awners current Question',
                    minValue: 0
                },
                vAxis: {
                    title: 'Question'
                }
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>

@stop