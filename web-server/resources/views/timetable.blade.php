@extends('Master.layout')

@section('content')
	<h1><center>Timetable</center></h1>
	  <p align="right"><a href="#detailed" data-toggle="modal" data-target=".bs-example-modal-lg">Detailed timetable</a>
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
			  <form class="form-horizontal">

						<div class = "modal-header">
							<h4>Detailed timetable</h4>
						</div>
						<div class = "modal-body">
							<table class="table table-bordered" >
							  <thead>
								<tr class="success">
								  <th>#</th>
								  <th>Monday</th>
								  <th>Tuesday
								  <th>Wednesday</th>
								  <th>Thursday</th>
								  <th>Friday</th>
								</tr>
							  </thead>
							  <tbody>
								<tr>
								  <th scope="row">9:00</th>
								  <td>CS1800<br>MLT</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								</tr>
								<tr>
								  <th scope="row">10:00</th>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								</tr>
								<tr>
								  <th scope="row">11:00</th>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								</tr>
								<tr>
								  <th scope="row">12:00</th>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								</tr>
								<tr>
								  <th scope="row">13:00</th>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								</tr>
								<tr>
								  <th scope="row">14:00</th>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								</tr>
								<tr>
								  <th scope="row">15:00</th>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								</tr>
								<tr>
								  <th scope="row">16:00</th>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								</tr>
								<tr>
								  <th scope="row">17:00</th>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								  <td>Table cell</td>
								</tr>
							  </tbody>
							</table>
							  
							  
						</div>
						<div class = "modal-footer">
							<a class = "btn btn-info" data-dismiss = "modal">Back to normal timetable</a>
						</div>
					</form>
			</div>
			
		  </div>
		</div></p>
		<div>
			<table class="table table-bordered table-hover table-striped" >
			  <thead>
				<tr class="danger">
				  <th>#</th>
				  <th>Monday</th>
				  <th>Tuesday
				  <th>Wednesday</th>
				  <th>Thursday</th>
				  <th>Friday</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <th scope="row">9:00</th>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				</tr>
				<tr>
				  <th scope="row">10:00</th>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				</tr>
				<tr>
				  <th scope="row">11:00</th>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				</tr>
				<tr>
				  <th scope="row">12:00</th>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				</tr>
				<tr>
				  <th scope="row">13:00</th>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				</tr>
				<tr>
				  <th scope="row">14:00</th>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				</tr>
				<tr>
				  <th scope="row">15:00</th>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				</tr>
				<tr>
				  <th scope="row">16:00</th>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				</tr>
				<tr>
				  <th scope="row">17:00</th>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				  <td>Table cell</td>
				</tr>
			  </tbody>
			</table>
		</div>
@stop