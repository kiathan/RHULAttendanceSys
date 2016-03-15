<!DOCTYPE html>
<html>
<head>

    <meta charset = "UTF-8">
    <title>RHUL Attendance System</title>
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<link href = "css/bootstrap.min.css" rel = "stylesheet">
	<link href = "css/style.css" rel = "stylesheet">
	<link rel = "shortcut icon" href = "images/RHicon.ico">
	<link href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel = "stylesheet" type="text/css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src = "js/bootstrap.js"></script>

</head>

<body>

	<!-- LOGIN POP UP -->
	
	<div class = "modal fade" id = "login" role = "dialog">
		<div class = "modal-dialog">
			<div class = "modal-content">
				<form class="form-horizontal" action="/login" method="post">
				
					<div class = "modal-header">
						<h3>Login</h3>
					</div>
					
					<div class = "modal-body">
					
						<div class="form-group">
							<label for="username" class="col-sm-2 control-label">User ID</label>
							<div class="col-sm-10">
							
								<input type="text" id="username" name="username" class="form-control" required/>
							
							</div>
						</div>
						
						<div class="form-group">
							<label for="password" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
							
								<input type="password" id="password" name="password" class="form-control" required/>
							
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
								
									<label><input type="checkbox" name="remember"> Remember Me </label>
									
								</div>
							</div>
						</div>
						
					</div>
					
					<div class = "modal-footer">
						
						<input type = "hidden" name ="_token" value = "{{ csrf_token() }}">
						<input class = "btn btn-success" type = "submit" value="Submit" name="Submit">
							
					</div>
					
				</form>
			</div>
		</div>
	</div>

	<!-- TOP NAV BAR -->

	<div class = "navbar navbar-inverse navbar-static-top">
		<div class = "container">
		
			<a href="/welcome" class = "navbar-brand" data-toggle="tooltip" title="Go to the homepage">Attendance System</a>
			<div class = "collapse navbar-collapse navHeaderCollapse">
				<ul class = "nav navbar-nav navbar-right">
					
					@if(Auth::check())
						<li><a href = "/users">Users</a></li>
						<li><a href = "/attendance">Attendance</a></li>
						<li><a href = "/qa">Q&A</a></li>
						<li><a href = "/timetable">Timetable</a></li>
						<li><a href = "/auth/logout">Logout</a></li>
					@elseif(!isset($signInResult))
						<li><a href = "#login" data-toggle = "modal">Login</a></li>
					@else
						<li><a href = "#login" data-toggle = "modal">Login</a></li>
					@endif
					<li><a href = "/contact">Contact Us</a></li>
					
				</ul>
			</div>
			
		</div>
	</div>
	
	<!-- CONTENT -->
	
	@yield('content')

	<!-- BOTTOM NAV BAR -->

	<div class = "navbar navbar-default navbar-fixed-bottom navbar-inverse">		
		<div class = "container">
		
			<p class = "navbar-text pull-left">Site Built By Team6</p>
			<a href = "http://moodle.rhul.ac.uk" class = "navbar-btn btn-danger btn pull-right" data-toggle="tooltip" title="Link to Moodle">RHUL MOODLE</a>

		</div>
	</div>
	
</body>
</html>