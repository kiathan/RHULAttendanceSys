@extends('Master.layout')

@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel" align="center">

	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>
	
	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
	
		<div class="item active">
			<img class="img-responsive" src="images\rhul1.jpg" >
			<div class="carousel-caption">
				<h2>Title</h2>
				<p>Description</p>
			</div>
		</div>
	
		<div class="item">
			<img class="img-responsive" src="images\students.jpg">
			<div class="carousel-caption">
				<h2>Title</h2>
				<p>Description</p>
			</div>
		</div>
	
		<div class="item">
			<img class="img-responsive" src="images\rhul2.jpg">
			<div class="carousel-caption">
				<h2>Title</h2>
				<p>Description</p>
			</div>
		</div>

	</div>

	<!-- Left and right controls -->
	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>

</div>
@stop