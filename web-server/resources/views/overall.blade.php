@extends('Master.layout')

@section('content')
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <div>
        <table class="table">
            <tr>
                <th>#</th>
                @foreach(array_keys($attendRate) as $course)
                    <th>{{$course}}</th>
                @endforeach
                <th>Over all</th>
            </tr>
            <tr>
                <td></td>
                @foreach($attendRate as $attendsRade)
                    <td>{{sprintf("%.2f%%", ($attendsRade['attended']/$attendsRade['count']))}}</td>
                @endforeach
                <td>{{sprintf("%.2f%%", ($overall['attended']/$overall['count']))}}</td>
            </tr>
        </table>
    </div>
@stop
