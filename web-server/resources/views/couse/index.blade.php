@extends('Master.layout')


@section('content')
    <div>
        <table>
            <tr>
                <th>name</th>
                <th>code</th>
                <th>startdate</th>
                <th>enddate</th>
            </tr>
            @foreach($couses as $couse)
                <tr>
                    <td>{{$couse->name}}</td>
                    <td>{{$couse->code}}</td>
                    <td>{{$couse->startdate}}</td>
                    <td>{{$couse->enddate}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@stop