@extends('Master.open-layout')

@section('content')
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
							<label for="name" class="col-sm-2 control-label"> Name </label>
							<div class="col-sm-10">
								<input type="text" name="name" id="name" class="form-control" placeholder="">
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
       					 			<option value="1">Administrator</option>
     								<option value="2">App Manager</option>
   				         			<option value="3">Lecturer</option>
        							<option value="4">Postgraduate Research</option>
        							<option value="5">Postgraduate Taught</option>
          				  			<option value="6">Undergraduate</option>
        						</select>
        					</div>
						</fieldset>
							
					</div>
					
					<div class="modal-footer">
						
     					<input type="hidden" name="_token" value="{{ csrf_token() }}">
    					<input type="submit" class="btn default-btn" value="Submit" name="Submit">
    					
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
							<li><a href="#">Name</a></li>
							<li><a href="#">ID</a></li>
							<li><a href="#">Email</a></li>
							<li><a href="#">Department</a></li>
							<li><a href="#">Course</a></li>
							<li><a href="#">Module</a></li>
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
	<ul class="list-group col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2" style="padding-right:0;">
		<li class="list-group-item">James Jordan
			<a  href="#check" data-toggle="modal" data-toggle="tooltip" title="Delete User" class="glyphicon glyphicon-trash" style="float:right; margin-left:1em;"></a>
			<a  href="#" data-toggle="modal" data-toggle="tooltip" title="Edit User"class="glyphicon glyphicon-pencil" style="float:right; margin-left:1em;"></a>
			<a  href="#" data-toggle="modal" data-toggle="tooltip" title="View User Details"class="glyphicon glyphicon-search" style="float:right; margin-left:1em;"></a>
		</li>
	</ul>
</div>
@stop