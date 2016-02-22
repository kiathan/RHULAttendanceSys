@extends('Master.layout')

@section('content')
<div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <center><img src="images\Q&A3.jpg"
            class="img-QA"></center>
            <h3 align="center"><a href="/now">New Questions to Answer</a></h3>
            <p>New questions are up here.
				<br>You should finish them during the lecture.
				<br>Feedbacks are given in a few days.
			</p>
          </div>
          <div class="col-md-4">
            <center><img src="images\question-mark.jpg"
            class="img-QA"></center>
            <h3 align="center"><a href="previous.html">Previous Questions & Answers</a></h3>
            <p>You can review all questions from lecturers.
				<br>Right answers are also posted.
			</p>
          </div>
          <div class="col-md-4">
            <center><img src="images\mat-Feedback.jpg"
            class="img-QA" ></center>
            <h3 align="center"><a href="feedback.html">Feedbacks</a></h3>
            <p>You can check your results of the questions.
				<br>Feedbacks are given here.
			</p>
          </div>
        </div>
      </div>
    </div>
@stop