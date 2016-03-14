@extends('Master.layout')

@section('content')
    <tr>
        <td>
            <p style="font-size:20px;text-align:center;">Enter Course Code:</p>
            <center><textarea cols="40" rows="3" id="data"></textarea></center>
        </td>
    </tr>
    <tr>
        <td>
            <center><button class="btn btn-default" onclick="QR()">Enter</button></center>
        </td>
    </tr>

@stop