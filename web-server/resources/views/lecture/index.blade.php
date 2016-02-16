@extends('Master.layout')


@section('content')
    <div>
        <table>
            <tr>
                @foreach(array_keys($lectures[0]->toArray()) as $names)
                    <th>{{$names}}</th>
                @endforeach
            </tr>
            @foreach($lectures as $lecture)
                <tr>
                    @foreach($lecture->toArray() as $coloum)
                        <td>{{$coloum}}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
@stop