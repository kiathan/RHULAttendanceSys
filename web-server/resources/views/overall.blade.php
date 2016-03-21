@extends('Master.layout')

@section('content')
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <div>
        <table class="table">
            <tr>
                <th>#</th>
                @foreach($courseList as $course)
                    <th>{{$course}}</th>
                @endforeach
                <th>Over all</th>
            </tr>
            @foreach($usersAttendsRate as $users)
                <tr class="text-center">
                    <td>{{$users['username']}}</td>
                    @foreach($courseList as $coruseCode)
                        @if(isset($users['attends'][$coruseCode]))
                            <td>{{sprintf("%.2f%%", ($users['attends'][$coruseCode]['attended']/$users['attends'][$coruseCode]['count']))}}</td>
                        @else
                            <td>--</td>
                        @endif
                    @endforeach
                    <td>{{sprintf("%.2f%%", ($users['overall']['attended']/$users['overall']['count']))}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@stop
