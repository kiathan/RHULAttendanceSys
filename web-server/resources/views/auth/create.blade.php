@extends('Master.layout')


@section('content')
    <div>
        <form method="post" action="/auth/store">
            <label for="name"> name </label> <input type="text" name="name" id="name"/> <br>
            <label for="username"> username </label> <input type="text" name="username" id="username"/> <br>
            <label for="firstname"> firstname </label> <input type="text" name="firstname" id="firstname"/> <br>
            <label for="middlename"> middlename </label> <input type="text" name="middlename" id="middlename"/> <br>
            <label for="lastname"> lastname </label> <input type="text" name="lastname" id="lastname"/> <br>
            <label for="email"> email </label> <input type="text" name="email" id="email"/> <br>
            <label for="password"> password </label> <input type="password" name="password" id="password"/> <br>


            <label for="role"> Role </label> <select name="role" id="role">
                @foreach($roles as $role)
                    <option value="{{$role->id}}">({{$role->str_id}}) - {{$role->name}}</option>
                @endforeach
            </select><br>

            <label for="coures[]">attending</label>
            <select multiple name="coures[]" id="coures[]">
                @foreach($courses as $course)
                    <option value="{{$course->id}}">({{$course->code}}) - {{$course->name}}</option>
                @endforeach
            </select>

            <input type="hidden" name="_token" value="{{ csrf_token() }}" 1>
            <input type="submit" value="submit" name="Submit">
        </form>
    </div>
@stop