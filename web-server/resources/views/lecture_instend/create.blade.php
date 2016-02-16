@extends('Master.layout')


@section('content')
    <div>
        <form method="post" action="/lecture_instends/store">
            <label for="lecture_id ">create lecture id</label>
            <select name="lecture_id" id="lecture_id">
                @foreach($lectures as $lecture)
                    <option value="{{$lecture->id}}">{{$lecture->course->name}} - {{$lecture->dayofweek}} - {{$lecture->starttime}} - {{$lecture->endtime}}</option>
                @endforeach
            </select>
            <input type="hidden" name="isActive" id="isActive" value="true" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
            <input type="submit" value="submit" name="Submit">
        </form>
    </div>
@stop