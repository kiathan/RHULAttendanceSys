<!DOCTYPE html>
<html>
<head>

    <meta charset = "UTF-8">
    <title>RHUL Attendance System</title>
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<link href = "css/bootstrap.min.css" rel = "stylesheet">
	<link href = "css/style.css" rel = "stylesheet">
	<link rel = "shortcut icon" href = "images\RHicon.ico">
	<link href = "http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel = "stylesheet" type="text/css">
	<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src = "js/bootstrap.js"></script>

</head>

<body>

	<!-- LOGIN POP UP -->
	
	<div class = "modal fade" id = "login" role = "dialog" data-backdrop="static" data-keyboard="false">
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
							
								<input type="text" id="username" name="username" class="form-control" placeholder="abcd123">
							
							</div>
						</div>
						
						<div class="form-group">
							<label for="password" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
							
								<input type="password" id="password" name="password" class="form-control" placeholder="passw0rd">
							
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
								
									<label><input type="checkbox"> Remember Me </label>
									
								</div>
							</div>
						</div>
						
					</div>
					
					<div class = "modal-footer">
						
						<input type="hidden" name="route" value="{{ Route::getCurrentRoute()->getPath() }}">
						<input type = "hidden" name ="_token" value = "{{ csrf_token() }}">
						<input class = "btn btn-success" type = "submit" value="Submit" name="Submit">
							
					</div>
					
				</form>
			</div>
		</div>
	</div>

	<!-- CHECK IF LOGGED IN -->

	@if(Auth::check())
        <script>
        	$('#login').modal('hide');
        </script>
    @elseif(!isset($signInResult))
        <script>
        	$('#login').modal('show');
        </script>
    @else
        <script>
        	$('.modal').modal('show');
        </script>
    @endif

	<!-- TOP NAV BAR -->

	<div class = "navbar navbar-inverse navbar-static-top">
		<div class = "container">
		
			<a href="/welcome" class = "navbar-brand" data-toggle="tooltip" title="Go to the homepage">Attendance System</a>
			<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
			
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
				
			</button>	
			<div class = "collapse navbar-collapse navHeaderCollapse">
				<ul class = "nav navbar-nav navbar-right">
					
					<li class="active"><a href = "/welcome">Home</a></li>
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
	
	@yield('content')

	<!-- BOTTOM NAV BAR -->

	<div class = "navbar navbar-default navbar-fixed-bottom navbar-inverse">		
		<div class = "container">
		
			<p class = "navbar-text pull-left">Site Built By Team6</p>
			<a href = "moodle.rhul.ac.uk" class = "navbar-btn btn-danger btn pull-right" data-toggle="tooltip" title="Link to Moodle">RHUL MOODLE</a>
		
		</div>
	</div>
	
</body>
</html>