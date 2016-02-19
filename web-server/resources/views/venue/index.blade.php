@extends('Master.layout')


@section('content')
    <div>
        <table>
            <tr>
                <th>name</th>
                <th>address</th>
                <th>geoX</th>
                <th>geoY</th>
            </tr>
            @foreach($venues as $venue)
                <tr>
                    <td>{{$venue->name}}</td>
                    <td>{{$venue->address}}</td>
                    <td>{{$venue->geoX}}</td>
                    <td>{{$venue->geoY}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@stop