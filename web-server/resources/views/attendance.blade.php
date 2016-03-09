@extends('Master.layout')

@section('content')
	<style>
		body { background-image: url("images/rhul1.jpg");}
	</style>
<div class = "container">

	<div class = "jumbotron jumbotron1">
		<center>
			<h1 class="font1"><span class="rainbow">ATTENDENCE SYSTEM</span></h1>
			<h2 class="font1">If you have any problems, click below to <a href="contact.blade.php" style="color:white"><u>contact us</u></a></h2>
		</center>
	</div>

</div>

<div class = "container">

	<div class = "row">

		<div class = "col-md-4" style="text-align:center">

			<h1 class="font2"><b>QR Code</b></h1>
			<font size=4><p class="font2">Scan a QR Code using your mobile</p></font>
			<a href = "QR.html" class = "btn btn-default font1" style="color:black">Click Here</a>

		</div>

		<div class = "col-md-4" style="text-align:center">

			<h1 class="font2"><b>Overall Attendance</b></h1>
			<font size=4><p class="font2">Overall attendance to each module</p></font>
			<a href = "overall.html" class = "btn btn-default font1"style="color:black">Click Here</a>

		</div>

		<div class = "col-md-4" style="text-align:center">

			<h1 class="font2"><b>Graph</b></h1>
			<font size=4><p class="font2">Graph for</p></font>
			<a href = "#" class = "btn btn-default font1"style="color:black">Click Here</a>

		</div>

	</div>

</div>
@stop