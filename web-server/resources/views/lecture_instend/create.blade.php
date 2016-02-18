@extends('Master.layout')


@section('content')
    <div>
        <form method="post" action="/lecture_instends/store">
            <label for="lecture_id ">create lecture id</label>
            <select name="lecture_id" id="lecture_id">
                @foreach($lectures as $lecture)
                    <option value="{{$lecture->id}}">{{$lecture->course->name}} - {{$lecture->dayofweek}}
                        - {{$lecture->starttime}} - {{$lecture->endtime}}</option>
                @endforeach
            </select>
            <input type="hidden" name="isActive" id="isActive" value="true">
            <input type="text" name="_token" value="{{ csrf_token() }}">
            <input type="submit" value="submit" name="Submit">
        </form>
    </div>

    <div style="margin-top:10em">
        <h4>Create instance for use right now (for testing)</h4>
        <form method="post" action="/lecture_instends/createTest">
            <label for="user">User name</label> :
            <select name="user_id">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->username}}</option>
                @endforeach
            </select>
            <input type="submit" value="create lecture instance for user">
        </form>
    </div>
@stop