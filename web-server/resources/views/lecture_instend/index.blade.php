<html>
<head></head>
<body>
<style>
    table {
        width: 100%;
    }

    table, td, tr, th {
        border: 1px solid black;
        text-align: center;
    }

</style>
<div>
    @if(sizeof($lecture_instends) == 0)7
    <p>There are currenly no active instances</p>
    @else
        <table>

            <tr>
                @foreach(array_keys($lecture_instends[0]->toArray()) as $names)
                    <th>{{$names}}</th>
                @endforeach
                <th>Qr code for auth</th>
                <th>Qr code result</th>
            </tr>
            @foreach($lecture_instends as $lecture)
                <tr>
                    <td><a href="{{url("/lecture_instends/show/" . $lecture->id)}}">{{$lecture->id}} </a></td>
                    <td> {{$lecture->lecture->course->name}} - {{$lecture->lecture->dayofweek}}
                        <br> {{$lecture->lecture->starttime}} - {{$lecture->lecture->endtime}} </td>
                    <td> {{$lecture->isActive}}</td>
                    <td>{{$lecture->created_at}}</td>
                    <td>{{$lecture->updated_at}}</td>
                    <td>{!! $lecture->sendQRcode() !!}</td>
                    <td>{!! $lecture->createHash() !!}</td>
                    <td></td>
                </tr>
            @endforeach
        </table>
    @endif
</div>
</body>
</html>