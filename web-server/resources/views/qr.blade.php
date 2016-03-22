@extends('Master.layout')

@section('content')
    @if(!is_null($qrcode))
        <div class="row">
            <div class="col-xs-12">
                <div class="text-center h1">
                    The QR code for {{$qrcode->lecture->course->code}}
                </div>
            </div>
        </div>
        <div class="row">
            <div style="width:500px; margin-left:auto; margin-right:auto; float:none;">
                {!! $qrcode->sendQRcode(500) !!}
            </div>
        </div>
    @else
        <div class="row">
            <div class="con-xs-12">
                <div class="text-center h2">
                    No lecture is active currey
                </div>
            </div>
        </div>
    @endif
@stop