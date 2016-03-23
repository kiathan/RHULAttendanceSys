@extends('Master.layout')

@section('content')
    <div class="container-fluid">
        @if($UserNotSignIn != null  && $UserSignIn != null)
            <div class="row">
                <div class="col-xs-12">
                    <div class="text-center h2">
                        Attends list for {{$course->code}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-center h3">
                                Alrady sign in
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="list-group">
                                @foreach($UserNotSignIn as $user)
                                    <div href="#" class="list-group-item">
                                        <p class="list-group-item-text">{{$user->lastname}}, {{$user->firstname}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-center h3"> Not sign in</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="list-group">
                                @foreach($UserNotSignIn as $user)
                                    <div href="#" class="list-group-item">
                                        <p class="list-group-item-text">{{$user->lastname}}, {{$user->firstname}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
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
    </div>
@stop