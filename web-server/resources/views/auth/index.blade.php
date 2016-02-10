@extends('Master.layout')


@section('content')
    <div>
        <table>
            <tr>
                <th>name</th>
                <th>username</th>
                <th>firstname</th>
                <th>middlename</th>
                <th>lastname</th>
                <th>email</th>
                <th>password</th>
            <tr>
            @foreach($users as $user)

                <tr>
                    <td> {{$user->name}} </td>
                    <td> {{$user->username}} </td>
                    <td> {{$user->firstname}} </td>
                    <td> {{$user->middlename}} </td>
                    <td> {{$user->lastname}} </td>
                    <td> {{$user->email}} </td>
                    <td> {{$user->password}} </td>
                </tr>
            @endforeach
        </table>

    </div>
@stop