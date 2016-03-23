@extends('Master.layout')

@section('content')
    @if(!isset($questions))
        <div>
            No lecture right now
        </div>
    @else
        <div class="container-fluid">
            <?php $counter = 0;?>
            @foreach($questions as $question)
                <div class="row">
                    <div class="col-xs-12">
                        <div id="chart_div_{{$counter}}"></div>
                    </div>
                </div>
                <?php ++$counter;?>
            @endforeach
        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
            google.charts.load('current', {packages: ['corechart', 'bar']});
            <?php $counter = 0;?>
            @foreach($questions as $question)
                google.charts.setOnLoadCallback(drawMultSeries_{{$counter}});

            function drawMultSeries_{{$counter}}() {
                var data_{{$counter}} = google.visualization.arrayToDataTable([
                    ['Question', ''],
                        @foreach($qaOrder as $awnsers)
                        <?php $questionResults = $question->result->where('awnser', $awnsers)->first()?>
                        @if($questionResults == null)
                    ['{{$awnsers}}', 0],
                        @else
                    ['{{$questionResults->awnser}}', {{$questionResults->count}}],
                    @endif
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
                        title: 'Question_{{$counter}}'
                    }
                };

                var chart = new google.visualization.BarChart(document.getElementById('chart_div_{{$counter}}'));
                chart.draw(data_{{$counter}}, options);

                <?php ++$counter;?>
            }
            @endforeach

            @endif

        </script>

@stop