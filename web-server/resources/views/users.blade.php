@extends('Master.open-layout')

@section('content')
<!-- SEARCH BAR -->

<div class="row" style="margin-bottom:2em;">
	<div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
		<div class="row">
		
			<div class="input-group col-xs-10 col-md-11" style="">
				<input type="text" class="form-control" placeholder="Search">
				<div class="input-group-btn">
					<button type="submit" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Search <span class="caret"></span></button>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#">Name</a></li>
						<li><a href="#">ID</a></li>
						<li><a href="#">Email</a></li>
						<li><a href="#">Department</a></li>
						<li><a href="#">Course</a></li>
						<li><a href="#">Module</a></li>
					</ul>
				</div>
			</div>
		
			<div class="input-group col-xs-2 col-md-1" style="float:right;">
				<button type="button" class="btn btn-default" style="float:right;" data-toggle="tooltip" title="Add User"><span class="glyphicon glyphicon-plus"></span></button>
			</div>
		
		</div>
	</div>
</div>

<!-- LIST OF USERS -->

<div class="row">
	<div class="list-group col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2" style="padding-right:0;">
		<a href="#" class="list-group-item">James Jordan
			<span class="glyphicon glyphicon-trash" style="float:right; padding-left:1em;" data-toggle="tooltip" title="Delete User"> </span>
			<span class="glyphicon glyphicon-pencil" style="float:right; padding-left:1em;" data-toggle="tooltip" title="Edit User"> </span>
			<span class="glyphicon glyphicon-search" style="float:right; padding-left:1em;" data-toggle="tooltip" title="View User Details"> </span>
		</a>
	</div>
</div>
@stop