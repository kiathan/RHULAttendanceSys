@extends('Master.layout')


@section('content')
    <div>
        <form method="post" action="/lecture_instends/update/{{$lecture_instend->id}}">
            <span>id</span> {{$lecture_instend->id}}<br>
            <span>isActive</span>
            <button type="submit" name="isActive"
                    value="{{$lecture_instend->isActive ? "false" : "true"}}">{{$lecture_instend->isActive ? "set of offilne" : "set of online"}}</button>
            <br>
            <div style="height:250px">
                <span style="vertical-align: middle">Qr code</span>{!! $lecture_instend->sendQRcode() !!}
            </div>

        </form>
    </div>
@stop