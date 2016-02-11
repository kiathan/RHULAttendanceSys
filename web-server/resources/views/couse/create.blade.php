@extends('Master.layout')


@section('content')
    <div>
        <form action="/couse/store" method="post">
            <label for="name">name</label><input type="text" name="name" id="name"/> <br>
            <label for="code">code</label><input type="text" name="code" id="code"/> <br>
            <label for="startdate">startdate</label><input type="text" name="startdate" id="startdate"/> <br>
            <label for="enddate">enddate</label><input type="text" name="enddate" id="enddate"/> <br>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" 1>
            <input type="submit" value="submit" name="Submit">
        </form>
    </div>
@stop