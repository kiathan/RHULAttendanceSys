@extends('Master.layout')


@section('content')
    <div>
        <form method="post" action="/lecture/store">


            <label for="course_id">course_id</label>
            <select name="course_id" id="course_id">
                @foreach($couses as $couse)
                    <option value="{{$couse->id}}">({{$couse->code}}) - {{$couse->name}}</option>
                @endforeach
            </select> <br>
            <label for="venue_id">venue_id</label>
            <select name="venue_id" id="venue_id">
                @foreach($venues as $venue)
                    <option value="{{$venue->id}}">{{$venue->name}}</option>
                @endforeach
            </select> <br>
            <label for="dayofweek">dayofweek</label>
            <select name="dayofweek" id="dayofweek">
                <option value="monday">monday</option>
                <option value="tuesday">tuesday</option>
                <option value="wednesday">wednesday</option>
                <option value="thursday">thursday</option>
                <option value="friday">friday</option>
                <option value="saturday">saturday</option>
                <option value="sunday">sunday</option>
            </select> <br>
            <label for="starttime">starttime</label><input type="text" placeholder="starttime" id="starttime"
                                                           name="starttime"/> <br>
            <label for="endtime">endtime</label><input type="text" placeholder="endtime" id="endtime" name="endtime"/>
            <br>

            <input type="hidden" name="_token" value="{{ csrf_token() }}" 1>
            <input type="submit" value="submit" name="Submit">
        </form>
    </div>
@stop