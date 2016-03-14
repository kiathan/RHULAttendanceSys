@extends('Master.open-layout')

@section('content')

<!-- VIEW USER -->
	
	<div class = "modal fade" id = "view" role = "dialog">
		<div class = "modal-dialog modal-lg">
			<div class = "modal-content">
				
				<div class = "modal-header">
					<h3 id="name"></h3>
				</div>
				<div class = "modal-body">
					
					<div class="row">
						<label for="username" class="col-sm-2"> Username </label>
						<div class="col-sm-10" id="view_username"> </div>
					</div>
					<div class="row">
						<label for="firstname" class="col-sm-2"> First Name </label>
						<div class="col-sm-10" id="view_firstname"> </div>
					</div>
					<div class="row">
						<label for="middlename" class="col-sm-2"> Middle Name </label>
						<div class="col-sm-10" id="view_middlename"> </div>
					</div>
					<div class="row">
						<label for="lastname" class="col-sm-2"> Last Name </label>
						<div class="col-sm-10" id="view_lastname"> </div>
					</div>
					<div class="row">
						<label for="email" class="col-sm-2"> Email </label>
						<div class="col-sm-10" id="view_email"> </div>
					</div>
					<div class="row">
						<label for="role" class="col-sm-2"> Role </label>
						<div class="col-sm-10" id="view_role"> </div>
					</div>
					<div class="row">
					<label for="courses[]" class="col-sm-2"> Attending </label>
    					<ul class="col-sm-10" id="view_courses">
                			
            			</ul>
					</div>
					
				</div>
			</div>
		</div>
	</div>

<!-- AUTH CHECK -->
	
	<div class = "modal fade" id = "check" role = "dialog">
		<div class = "modal-dialog">
			<div class = "modal-content">
				
				<div class = "modal-header">
					<h3 id="are-you-sure">Are you sure?</h3>
				</div>
				
				<div class = "modal-footer">		
					<form method="post" action="/auth/destroy">
						<input type="hidden" name="id" id="hidden-id" value="">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input class = "btn btn-success" type = "submit" name="confirm" value="Yes"></input>
						<button class = "btn btn-danger" type = "button" data-dismiss="modal">No</button>
					</form>
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
								<input type="text" name="username" id="username" class="form-control" required/>
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="password" class="col-sm-2 control-label"> Password </label>
							<div class="col-sm-10">
								<input type="password" name="password" id="password" class="form-control" required/>
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="firstname" class="col-sm-2 control-label"> First Name </label>
							<div class="col-sm-10">
								<input type="text" name="firstname" id="firstname" class="form-control" required/>
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="middlename" class="col-sm-2 control-label"> Middle Name </label>
							<div class="col-sm-10">
								<input type="text" name="middlename" id="middlename" class="form-control" />
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="lastname" class="col-sm-2 control-label"> Last Name </label>
							<div class="col-sm-10">
								<input type="text" name="lastname" id="lastname" class="form-control" required/>
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="email" class="col-sm-2 control-label"> Email </label>
							<div class="col-sm-10">
								<input type="email" name="email" id="email" class="form-control" required/>
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="role" class="col-sm-2 control-label"> Role </label>
							<div class="col-sm-10">
								<select name="role" id="role" class="form-control" required>
       					 			@foreach($roles as $role)
                    					<option value="{{$role->id}}">({{$role->str_id}}) - {{$role->name}}</option>
                					@endforeach
        						</select>
        					</div>
						</fieldset>
						
						<fieldset>
						<label for="courses[]" class="col-sm-2 control-label"> Attending </label>
        					<select multiple name="courses[]" id="courses[]" class="col-sm-10">
                				@foreach($courses as $course)
                    				<option value="{{$course->id}}">({{$course->code}}) - {{$course->name}}</option>
                				@endforeach
            				</select>
						</fieldset>
						
					</div>
					
					<div class="modal-footer">
						
     					<input type="hidden" name="_token" value="{{ csrf_token() }}">
    					<input type="submit" class="btn btn-success" value="Submit" name="Submit" id="addUser-button">
    					<button class = "btn btn-danger" type = "button" data-dismiss="modal">Cancel</button>
    					
        			</div>
        
				</form>
   			</div>
   		</div>
   	</div>

<!-- EDIT USER POP UP -->
	
	<div class = "modal fade" id = "edit-user" role = "dialog">
		<div class = "modal-dialog modal-lg">
			<div class = "modal-content">
				<form class="form-horizontal" method="post" action="/auth/store">
				
					<div class = "modal-header">
						<h3 id="edit_name"></h3>
					</div>
					
					<div class = "modal-body">

						<fieldset class="form-group">
							<label for="username" class="col-sm-2 control-label"> Username </label>
							<div class="col-sm-9">
								<input type="text" name="username" id="edit_username" class="form-control" required disabled/>
							</div>
							<div class="col-sm-1">
								<label style="margin:auto;"><input type="checkbox" onclick="toggleDisabled('#edit_username')"> Edit </label>
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="password" class="col-sm-2 control-label"> Password </label>
							<div class="col-sm-9">
								<input type="password" name="password" id="edit_password" class="form-control" required disabled/>
							</div>
							<div class="col-sm-1">
								<label style="margin:auto;"><input type="checkbox" onclick="toggleDisabled('#edit_password')"> Edit </label>
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="firstname" class="col-sm-2 control-label"> First Name </label>
							<div class="col-sm-9">
								<input type="text" name="firstname" id="edit_firstname" class="form-control" required disabled/>
							</div>
							<div class="col-sm-1">
								<label style="margin:auto;"><input type="checkbox" onclick="toggleDisabled('#edit_firstname')"> Edit </label>
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="middlename" class="col-sm-2 control-label"> Middle Name </label>
							<div class="col-sm-9">
								<input type="text" name="middlename" id="edit_middlename" class="form-control" disabled/>
							</div>
							<div class="col-sm-1">
								<label style="margin:auto;"><input type="checkbox" onclick="toggleDisabled('#edit_middlename')"> Edit </label>
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="lastname" class="col-sm-2 control-label"> Last Name </label>
							<div class="col-sm-9">
								<input type="text" name="lastname" id="edit_lastname" class="form-control" required disabled/>
							</div>
							<div class="col-sm-1">
								<label style="margin:auto;"><input type="checkbox" onclick="toggleDisabled('#edit_lastname')"> Edit </label>
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="email" class="col-sm-2 control-label"> Email </label>
							<div class="col-sm-9">
								<input type="email" name="email" id="edit_email" class="form-control" required disabled/>
							</div>
							<div class="col-sm-1">
								<label style="margin:auto;"><input type="checkbox" onclick="toggleDisabled('#edit_email')"> Edit </label>
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="role" class="col-sm-2 control-label"> Role </label>
							<div class="col-sm-9">
								<select name="role" id="edit_role" class="form-control" required disabled>
       					 			@foreach($roles as $role)
                    					<option value="{{$role->id}}">({{$role->str_id}}) - {{$role->name}}</option>
                					@endforeach
        						</select>
        					</div>
        					<div class="col-sm-1">
								<label style="margin:auto;"><input type="checkbox" onclick="toggleDisabled('#edit_role')"> Edit </label>
							</div>
						</fieldset>
						
						<fieldset class="form-group">
							<label for="courses[]" class="col-sm-2 control-label"> Attending </label>
							<div class="col-sm-4">
        						<select multiple name="non-courses[]" class="edit_courses form-control" id="no-course" disabled>
                					@foreach($courses as $course)
                    					<option value="{{$course->id}}">({{$course->code}}) - {{$course->name}}</option>
                					@endforeach
            					</select>
            				</div>
            				
            				<div class="col-sm-1">
            					<div class="row">
            						<button class = "btn btn-success form-control" type = "button" id="rarr">&rarr;</button>
            					</div>
            					<div class="row">
            						<button class = "btn btn-danger form-control" type = "button" id="larr">&larr;</button>
            					</div>
            				</div>
            				
            				<div class="col-sm-4">
            					<select multiple name="courses[]" class="edit_courses form-control" id="yes-course" disabled>
                				
            					</select>
            				</div>
							<div class="col-sm-1">
								<label style="margin:auto;"><input type="checkbox" onclick="toggleDisabled('.edit_courses')""> Edit </label>
							</div>
						</fieldset>
						
					</div>
					
					<div class="modal-footer">
						
     					<input type="hidden" name="_token" value="{{ csrf_token() }}">
    					<input type="submit" class="btn btn-success" value="Submit" name="Submit" id="editUser-button">
    					<button class = "btn btn-danger" type = "button" data-dismiss="modal">Cancel</button>
    					
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
						<a  href="#check" onclick="checkUpdate('{{$user->firstname}}', '{{$user->lastname}}', {{$user->id}})" data-toggle="modal" data-toggle="tooltip" title="Delete User" class="glyphicon glyphicon-trash" style="float:right; margin-left:1em;"></a>
						<a  href="#edit-user" onclick="editUpdate({{$user->id}})" data-toggle="modal" data-toggle="tooltip" title="Edit User"class="glyphicon glyphicon-pencil" style="float:right; margin-left:1em;"></a>
						<a  href="#view" onclick="viewUpdate({{$user->id}})" data-toggle="modal" data-toggle="tooltip" title="View User"class="glyphicon glyphicon-search" style="float:right; margin-left:1em;"></a>
					</li>
			@endforeach
		</ul>
	</div>
	
<!-- SCRIPTS -->

	<script>
	
		 $(document).ready(function() {
		
			 $('#rarr').click(function(){
			
				$('#no-course option:selected').each( function() {
                	$('#yes-course').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            		$(this).remove();
            	});
			
			});
			
			$('#larr').click(function(){
			
				$('#yes-course option:selected').each( function() {
               		$('#no-course').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
           			$(this).remove();
           		});
			
			});
		
		});
	
		function toggleDisabled(id) {
		
			if($(id).prop('disabled') == true) {
			
				$(id).prop('disabled', false);
			
			} else {
			
				$(id).prop('disabled', true);
			
			}
		
		}
	
		function checkUpdate(firstname, lastname, id) {
		
				$('#are-you-sure').text("Are you sure you want to remove " + firstname + " " + lastname + "?");
				$('#hidden-id').attr("value", id);
			
		}
		
		function editUpdate(id) {
			
			var list = "";
			var i = 0;
			
			$.post('/auth/show', {'id':id}, function(data){
				$('#edit_name').text(data.firstname + " " + data.lastname);
        		$('#edit_username').val(data.username);
        		$('#edit_firstname').val(data.firstname);
        		$('#edit_middlename').val(data.middlename);
        		$('#edit_lastname').val(data.lastname);
        		$('#edit_email').val(data.email);
        		for(i in data.course) {
        			
        			list += "<option value='" + data.course[i].id + "'>" + data.course[i].code + ": " + data.course[i].name + "</option>";
        			
        		}
        		$('#yes-course').html(list);
        		
        	});
			
		}
		
		function viewUpdate(id) {
			
			var list = "";
			var i = 0;
			
			$.post('/auth/show', {'id':id}, function(data){
				$('#name').text(data.firstname + " " + data.lastname);
        		$('#view_username').text(data.username);
        		$('#view_firstname').text(data.firstname);
        		$('#view_middlename').text(data.middlename);
        		$('#view_lastname').text(data.lastname);
        		$('#view_email').text(data.email);
        		$('#view_role').text(data.role);
        		for(i in data.course) {
        			
        			list += "<li>" + data.course[i].code + ": " + data.course[i].name + "</li>";
        		}
        		$('#view_courses').html(list);
        	});
			
		}
	</script>
@stop