@extends('Master.layout')

@section('content')
    <link rel="stylesheet" href="css/timetablejs.css">
    <script src="js/timetable.min.js"></script>
    <style>
        .center{
            margin-left: auto; !important;
            margin-right: auto;!important;
        }
    </style>
    <script>
        @if(!is_null($lectues))

        $(document).ready(function () {
            var timetable = new Timetable();
            timetable.setScope(9, 17);
            timetable.addLocations(["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"]);
                    @foreach($lectues as $lectue)

                    <?php
                    //FIXME REMOVE THIS as it will only be use to remove the 24 hours classes
                    if ($lectue->starttime == "00:00:00") {
                        continue;
                    }
                    $currentTime = new Carbon\Carbon;
                    $starttime = explode(":", $lectue->starttime);
                    $endtime = explode(":", $lectue->endtime);
                    ?>
            var element = "<span> {{$lectue->course->code}} </span>";
            timetable.addEvent('{{$lectue->course->code}}', '{{$lectue->dayofweek}}', new Date({{$currentTime->year}}, {{$currentTime->month}}, {{$currentTime->day}}, {{$starttime[0]}}, {{$starttime[1]}}), new Date({{$currentTime->year}}, {{$currentTime->month}}, {{$currentTime->day}}, {{$endtime[0]}}, {{$endtime[1]}}));

                    @endforeach

            var renderer = new Timetable.Renderer(timetable);
            renderer.draw('.timetable'); // any css selector
        });
        @endif
    </script>
    <h1 class="font5">
        <center>Timetable</center>
    </h1>
    <div class="center"><div class="timetable"></div></div>
@stop