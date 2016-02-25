@extends('Master.layout')


@section('content')
    <style>
        table{
            width: 100%;
        }
        table, td, th{
            border:1px solid black;
        }
    </style>
    <div>
        <table>
            <tr>
                <th colspan="2">id</th>
                <th colspan="2">course_id</th>
                <th colspan="2">venue_id</th>
                <th colspan="2">dayofweek</th>
                <th colspan="2">starttime</th>
                <th colspan="2">endtime</th>
                <th colspan="2">created_at</th>
                <th colspan="2">updated_at</th>
                <th colspan="2">course</th>
                <th colspan="2">venue</th>
                <th colspan="2">user attened</th>
            </tr>
            @foreach($lectures as $lecture)
                <tr>
                    <td colspan="2"> {{$lecture->id}} </td>
                    <td colspan="2"> {{$lecture->course_id}} </td>
                    <td colspan="2"> {{$lecture->venue_id}} </td>
                    <td colspan="2"> {{$lecture->dayofweek}} </td>
                    <td colspan="2"> {{$lecture->starttime}} </td>
                    <td colspan="2"> {{$lecture->endtime}} </td>
                    <td colspan="2"> {{$lecture->created_at}} </td>
                    <td colspan="2"> {{$lecture->updated_at}} </td>
                    <td colspan="1"> {{$lecture->course->code}} </td>
                    <td colspan="1"> {{$lecture->course->name}} </td>
                    <td colspan="2"> {{$lecture->venue->name}} </td>
                    <td colspan="2"> {{$lecture->UserAttended ? "True" : "False"}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@stop