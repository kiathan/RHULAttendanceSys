<!DOCTYPE html>
<html>
<head>

    <meta charset = "UTF-8">
    <title>RHUL Attendance System</title>
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<link href = "css/bootstrap.min.css" rel = "stylesheet">
	<link href = "css/style.css" rel = "stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
	<link rel = "shortcut icon" href = "images/RHicon.ico">
	<link href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel = "stylesheet" type="text/css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src = "js/bootstrap.js"></script>
	<script>
		function setupOnLoad() {
           $.ajaxSetup({ headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' } });
        }
    </script>
	
</head>

<body onload="setupOnLoad();">
<style>
	body { background-image: url("../images/rhul1.jpg");}
</style>
	<!-- TOP NAV BAR -->

	<div class = "navbar navbar-inverse navbar-static-top">
		<div class = "container">
		
			<a href="/welcome" class = "navbar-brand" data-toggle="tooltip" title="Go to the homepage">Attendance System</a>	
			<div class = "collapse navbar-collapse navHeaderCollapse">
				<ul class = "nav navbar-nav navbar-right">
					
						<li><a href = "/users">Users</a></li>
						<li><a href = "/attendance">Attendance</a></li>
						<li><a href = "/qa">Q&A</a></li>
						<li><a href = "/timetable">Timetable</a></li>
						<li><a href = "/auth/logout">Logout</a></li>
						<li><a href = "/contact">Contact Us</a></li>
				</ul>
			</div>
			
		</div>
	</div>

	<!-- CONTENT -->
	<div class = "jumbotron jumbotron1">
	@yield('content')
	</div>
	<!-- BOTTOM NAV BAR -->

	<div class = "navbar navbar-default navbar-fixed-bottom navbar-inverse">		
		<div class = "container">
		
			<p class = "navbar-text pull-left">Designed & Made By Team6</p>
			<a href = "http://moodle.rhul.ac.uk" class = "navbar-btn btn-danger btn pull-right" data-toggle="tooltip" title="Link to Moodle">RHUL MOODLE</a>
		
		</div>
	</div>
	
</body>
</html>