@extends('Master.layout')


@section('content')
    <div>
        <form method="post" action="/lecture/store">
            <label for="name"> name </label> <input type="text" name="name" id="name"/> <br>
            <label for="username"> username </label> <input type="text" name="username" id="username"/> <br>
            <label for="firstname"> firstname </label> <input type="text" name="firstname" id="firstname"/> <br>
            <label for="middlename"> middlename </label> <input type="text" name="middlename" id="middlename"/> <br>
            <label for="lastname"> lastname </label> <input type="text" name="lastname" id="lastname"/> <br>
            <label for="email"> email </label> <input type="text" name="email" id="email"/> <br>
            <label for="password"> password </label> <input type="password" name="password" id="password"/> <br>

            @if(isset($courses))
                @foreach($courses as $course)
                    <label>
                        <input type="checkbox" name="courses[]" value="{{$course->id}}"/>
                        ({{$course->code}}) - {{$course->name}}
                    </label><br>
                @endforeach
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}" 1>
            <input type="submit" value="submit" name="Submit">
        </form>
    </div>
@stop