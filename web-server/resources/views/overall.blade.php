@extends('Master.layout')

@section('content')
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <div>
        @if(sizeof($lecture_instends) == 0)7
        <p>There are currenly no active instances</p>
        @else
            <table id="overall" class="display" cellspacing="0" width="100%">
                <tr>
                    @foreach(array_keys($lecture_instends[0]->toArray()) as $names)
                        <th>{{$names}}</th>
                    @endforeach
                    <th>Qr code for auth</th>
                    <th>Qr code result</th>
                </tr>
                @foreach($lecture_instends as $lecture)
                    <tr>
                        <td><a href="{{url("/lecture_instends/show/" . $lecture->id)}}">{{$lecture->id}} </a></td>
                        <td> {{$lecture->lecture->course->name}} - {{$lecture->lecture->dayofweek}}
                            <br> {{$lecture->lecture->starttime}} - {{$lecture->lecture->endtime}} </td>
                        <td> {{$lecture->isActive}}</td>
                        <td>{{$lecture->created_at}}</td>
                        <td>{{$lecture->updated_at}}</td>
                        <td>{!! $lecture->sendQRcode() !!}</td>
                        <td>{!! $lecture->createHash() !!}</td>
                        <td></td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@stop
