@extends('Master.layout')


@section('content')
    <div>
        @if(!isset($signInResult))
            Sing into Attend system
        @elseif($signInResult)
            You are sign in
        @else
            Uable to sign in, check username or password
        @endif
    </div>
    <form action="/login" method="post">
        <label for="username">Username</label><input type="text" id="username" name="username"><br>
        <label for="password">Password</label><input type="password" id="password" name="password"><br>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" value="submit" name="Submit">
    </form>
@stop