@extends('Master.layout')


@section('content')
    <div>
        <form method="post" action="/venue/store">

            <label for="name">name</label><input type="text" placeholder="name" name="name" id="name"/> <br>
            <label for="address">address</label><input type="text" placeholder="address" name="address" id="address"/>
            <br>
            <label for="geoX ">geoX</label><input type="text" placeholder="geoX" name="geoX" id="geoX"/> <br>
            <label for="geoY ">geoY</label><input type="text" placeholder="geoY" name="geoY" id="geoY"/> <br>

            <input type="hidden" name="_token" value="{{ csrf_token() }}" 1>
            <input type="submit" value="submit" name="Submit">
        </form>
    </div>
@stop