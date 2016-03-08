@extends('Master.open-layout')

@section('content')
	<style>
		body{background-image: url("images/blurredBackground.jpg");}
	</style>
	<center><h1 class="font3">Contact us</h1>
	<p>If you have any problem or question, contact us!</p>
	<address>
		<strong>RHUL Administration office</strong><br>
		Royal Holloway University of London<br>
		Egham Hill, Egham, Surrey, TW20 0EX<br>
		<i class = "fa fa-phone"></i> (123) 456-7890
	</address>

	<address>
		<strong>Email</strong><br>
		<a href="mailto:#">admin@live.rhul.ac.uk</a>
	</address>
<form class="form-horizontal" role="form" method="post" action="sendingMessage.php">
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="">
		</div>
	</div>

	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-5">
			<input type="email" class="form-control" id="email" name="email" placeholder="Your email address" value="">
		</div>
	</div>

	<div class="form-group">
		<label for="message" class="col-sm-2 control-label">Message</label>
		<div class="col-sm-5">
			<textarea class="form-control" rows="4" name="message"></textarea>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<! Will be used to display an alert to the user>
		</div>
	</div>

</form></center>


@stop