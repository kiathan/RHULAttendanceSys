@extends('Master.layout')

@section('content')
    <div class="section">
        <div class="container vertical-center">
            <div class="row">
                <div class="col-md-4">
                    <a href="now.blade.php"><img src="images/QA.JPG" class="img-size">
                        <h2 class="font4">Question & Answer</h2></a>
                </div>
                <div class="col-md-4">
                    <a href="previous.html"><img src="images/previous.JPG" class="img-size">
                        <h2 class="font4">Previous questions</h2></a>
                </div>
                <div class="col-md-4">
                    <a href="feedback.html"><img src="images/feedback.jpg" class="img-size">
                        <h2 class="font4">Feedback</h2></a>
                </div>
            </div>
        </div>
    </div>
@stop