@extends('Master.open-layout')

@section('content')
<!-- SCRIPTS -->

	<script>
		$("#addUser-button").click( function addUser() {
			$.ajax({
			
				url: '/auth/store',
				type: "post",
				data: {
					'username':$('input[name=username]').val(),
					'firstname':$('input[name=firstname]').val(),
					'middlename':$('input[name=middlename]').val(),
					'lastname':$('input[name=lastname]').val(),
					'email':$('input[name=email]').val(),
					'password':$('input[name=password]').val(),
					'_token': $('input[name=_token]').val(),
					'role':$('input[name=role]').val(),
					'courses':$('input[name=courses[]]').val()
				},
				success: function(data){
					$("#userlist").html(data);
				}
					
			});
		});
	</script>

<!-- VIEW USER -->
	
	<div class = "modal fade" id = "view" role = "dialog">
		<div class = "modal-dialog">
			<div class = "modal-content">
				
				<div class = "modal-header">
					<h3></h3>
				</div>
				
				<div class = "modal-footer">		
					<form method="post" action="">
						<input class = "btn btn-success" type = "button" name="confirm" value="Yes"></input>
					</form>
					<button class = "btn btn-danger" type = "button" data-dismiss="modal">No</button>
				</div>
					
			</div>
		</div>
	</div>

<!-- AUTH CHECK -->
	
	<div class = "modal fade" id = "check" role = "dialog">
		<div class = "modal-dialog">
			<div class = "modal-content">
				
				<div class = "modal-header">
					<h3>Are you sure?</h3>
				</div>
				
				<div class = "modal-footer">		
					<form method="post" action="">
						<input class = "btn btn-success" type = "button" name="confirm" value="Yes"></input>
					</form>
					<button class = "btn btn-danger" type = "button" data-dismiss="modal">No</button>
				</div>
					
			</div>
		</div>
	</div>

<!-- ADD USER POP UP -->
	
	<div class = "modal fade" id = "add-user" role = "dialog">
		<div class = "modal-dialog modal-lg">
			<div class = "modal-content">
				<form class="form-horizontal" method="post" action="/auth/store">
				
					<div class = "modal-header">
						<h3>Add User</h3>
					</div>
					
					<div class = "modal-body">

						<fieldset class="form-group">
							<label for="username" class="col-sm-2 control-label"> Username </label>
							<div class="col-sm-10">
								<input type="text" name="username" id="username" class="form-control" placeholder=""/>
							</div>
						</fieldset>
						<fieldset class="form-group">
							<label for="password" class="col-sm-2 control-label"> Password </label>
							<div class="col-sm-10">
								<input type="password" name="password" id="password" class="form-control" placeholder=""/>
							</div>
						</fieldset>
						<fieldset class="form-group">
							<label for="firstname" class="col-sm-2 control-label"> First Name </label>
							<div class="col-sm-10">
								<input type="text" name="firstname" id="firstname" class="form-control" placeholder=""/>
							</div>
						</fieldset>
						<fieldset class="form-group">
							<label for="middlename" class="col-sm-2 control-label"> Middle Name </label>
							<div class="col-sm-10">
								<input type="text" name="middlename" id="middlename" class="form-control" placeholder=""/>
							</div>
						</fieldset>
						<fieldset class="form-group">
							<label for="lastname" class="col-sm-2 control-label"> Last Name </label>
							<div class="col-sm-10">
								<input type="text" name="lastname" id="lastname" class="form-control" placeholder=""/>
							</div>
						</fieldset>
						<fieldset class="form-group">
							<label for="email" class="col-sm-2 control-label"> Email </label>
							<div class="col-sm-10">
								<input type="text" name="email" id="email" class="form-control" placeholder=""/>
							</div>
						</fieldset>
						<fieldset class="form-group">
							<label for="role" class="col-sm-2 control-label"> Role </label>
							<div class="col-sm-10">
								<select name="role" id="role" class="form-control">
       					 			@foreach($roles as $role)
                    					<option value="{{$role->id}}">({{$role->str_id}}) - {{$role->name}}</option>
                					@endforeach
        						</select>
        					</div>
						</fieldset>
						<fieldset>
						<label for="courses[]"> Attending </label>
        					<select multiple name="courses[]" id="coures[]">
                				@foreach($courses as $course)
                    				<option value="{{$course->id}}">({{$course->code}}) - {{$course->name}}</option>
                				@endforeach
            				</select>
						</fieldset>
						
					</div>
					
					<div class="modal-footer">
						
     					<input type="hidden" name="_token" value="{{ csrf_token() }}">
    					<input type="submit" class="btn default-btn" value="Submit" name="Submit" id="addUser-button">
    					
        			</div>
        
				</form>
   			</div>
   		</div>
   	</div>


<!-- SEARCH BAR -->

	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
			<div class="row">
	
				<form class="col-xs-10 col-md-11">		
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search">
						<div class="input-group-btn">
							<button type="submit" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Search <span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu">
								<li><a value="name">Name</a></li>
								<li><a value="id">ID</a></li>
								<li><a value="email">Email</a></li>
								<li><a value="department">Department</a></li>
								<li><a value="course">Course</a></li>
								<li><a value="module">Module</a></li>
							</ul>
						</div>
					</div>
				</form>
				
				<div class="col-xs-2 col-md-1">
					<a type="button" href="#add-user" data-toggle="modal" class="btn btn-default" data-toggle="tooltip" title="Add User"><span class="glyphicon glyphicon-plus"></span></a>
				</div>
			
			</div>
		</div>
	</div>

	</br>

<!-- LIST OF USERS -->

	<div class="row">
		<ul class="list-group col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2" style="padding-right:0;" id="user-list">
			@foreach($users as $user)
					<li class="list-group-item">{{$user->firstname}} {{$user->lastname}}
						<a  href="#" onclick="deleteUser({{$user->id}})" data-toggle="tooltip" title="Delete User" class="glyphicon glyphicon-trash" style="float:right; margin-left:1em;"></a>
						<a  href="#" onclick="" data-toggle="modal" data-toggle="tooltip" title="Edit User"class="glyphicon glyphicon-pencil" style="float:right; margin-left:1em;"></a>
						<a  href="#" onclick="" data-toggle="modal" data-toggle="tooltip" title="View User"class="glyphicon glyphicon-search" style="float:right; margin-left:1em;"></a>
					</li>
			@endforeach
		</ul>
	</div>
@stop