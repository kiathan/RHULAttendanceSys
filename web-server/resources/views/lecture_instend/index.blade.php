@extends('Master.layout')


@section('content')
    <div>
        <table>
            <tr>
                @foreach(array_keys($lecture_instends[0]->toArray()) as $names)
                    <th>{{$names}}</th>
                @endforeach
            </tr>
            @foreach($lecture_instends as $lecture)
                <tr>
                    @foreach($lecture->toArray() as $coloum)
                        <td>{{$coloum}}</td>
                    @endforeach
                    <td>{!! $lecture->sendQRcode() !!}</td>
                </tr>
            @endforeach
        </table>
    </div>
@stop