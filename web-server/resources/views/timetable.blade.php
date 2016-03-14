@extends('Master.layout')

@section('content')
    <link rel="stylesheet" href="css/timetablejs.css">
    <script src="js/timetable.min.js"></script>

    <script>
        $(document).ready(function () {
            var timetable = new Timetable();
            timetable.setScope(9, 17);
            timetable.addLocations(["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"]);
            @foreach($lectues as $lectue)

            <?php
                if($lectue->starttime == "00:00:00"){
                    continue;
                }
                $currentTime = new Carbon\Carbon;
                $starttime = explode(":", $lectue->starttime);
                $endtime = explode(":", $lectue->endtime);
            ?>

                timetable.addEvent('{{$lectue->course->code}}', '{{$lectue->dayofweek}}', new Date({{$currentTime->year}}, {{$currentTime->month}}, {{$currentTime->day}}, {{$starttime[0]}}, {{$starttime[1]}}), new Date({{$currentTime->year}}, {{$currentTime->month}}, {{$currentTime->day}}, {{$endtime[0]}}, {{$endtime[1]}}));

                    @endforeach

            var renderer = new Timetable.Renderer(timetable);
            renderer.draw('.timetable'); // any css selector
        })
    </script>
    <style>
        body {
            background-image: url("images/blurred2.jpg");
        }
    </style>
    <h1 class="font3">
        <center>Timetable</center>
    </h1>
    <div class="timetable"></div>
    <center>
        <div>
            <table class="table table-bordered table-hover table1">
                <thead>
                <tr class="danger">
                    <th>#</th>
                    <th>Monday</th>
                    <th>Tuesday
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lectues as $lectue)
                    <tr>
                        @foreach($lectue as $l)
                        @endforeach
                    </tr>
                @endforeach
                <tr>
                    <th scope="row">9:00</th>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                </tr>
                <tr>
                    <th scope="row">10:00</th>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                </tr>
                <tr>
                    <th scope="row">11:00</th>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                </tr>
                <tr>
                    <th scope="row">12:00</th>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                </tr>
                <tr>
                    <th scope="row">13:00</th>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                </tr>
                <tr>
                    <th scope="row">14:00</th>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                </tr>
                <tr>
                    <th scope="row">15:00</th>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                </tr>
                <tr>
                    <th scope="row">16:00</th>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                </tr>
                <tr>
                    <th scope="row">17:00</th>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                    <td>Table cell</td>
                </tr>
                </tbody>
            </table>
        </div>
    </center>
@stop