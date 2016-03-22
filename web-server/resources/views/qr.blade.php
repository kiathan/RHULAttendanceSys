@extends('Master.layout')

@section('content')
    @if(!is_null($qrcode))
        code her :D
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