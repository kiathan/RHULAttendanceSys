@extends('Master.layout')

@section('content')

<div class = "container">

		<center>
			<h1 class="titlehead">ATTENDANCE SYSTEM</h1>
			<div class = "container">

				<div class = "row">

					<div class = "col-md-4" style="text-align:center">

						<h2 class="font5" style="color:#F5D0A9"><b>QR Code</b></h2>
						<font size=4><p class="font5" style="color:#F5D0A9">Scan a QR Code using your mobile</p></font>
						<a href = "/qr" class = "btn btn-default" style="color:black">Click Here</a>

					</div>

					<div class = "col-md-4" style="text-align:center">

 						<h2 class="font5" style="color:#F5D0A9"><b>Overall Attendance</b></h2>
						<font size=4><p class="font5" style="color:#F5D0A9">Overall attendance to each module</p></font>
						<a href = "/overall" class = "btn btn-default" style="color:black">Click Here own attends</a>
						<a href = "/overall/lecture" class = "btn btn-default" style="color:black">Click Here attends of lecture</a>

					</div>

					<div class = "col-md-4" style="text-align:center">

						<h2 class="font5" style="color:#F5D0A9"><b>Graph</b></h2>
						<font size=4><p class="font5" style="color:#F5D0A9">Graph for</p></font>
						<a href = "#" class = "btn btn-default" style="color:black">Click Here</a>

					</div>

				</div>

			</div>
			<h2 class="smallertext">If you have any problems, click to <a href="contact.blade.php" style="color:white"><u>contact us</u></a></h2>
		</center>
	</div>



@stop