@extends('Master.layout')

@section('content')
    <div class="table-responsive">
        <center><table class="table table-hover table-responsive table-striped table1" >
                <thead>
                <tr class="active">
                    <th style="width:2%">#</th>
                    <th>Course</th>
                    <th>Lecturer</th>
                    <th>Questions</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>1</td>
                    <td>CS1000</td>
                    <td>ABC</td>
                    <td><a href="#question" data-toggle="modal" data-target=".bs-example-modal-lg">Question title</a></td>
                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form class="form-horizontal">

                                    <div class = "modal-header">
                                        <h4>Question title</h4>
                                    </div>
                                    <div class = "modal-body">



                                    </div>
                                    <div class = "modal-footer">
                                        <a class = "btn btn-info" data-dismiss = "modal">Submit</a>
                                        <a class = "btn btn-default" data-dismiss = "modal">Close</a>
                                    </div>
                                </form>
                            </div>

                            </di	v>
                        </div>
                </tr>
                </tbody>
            </table></center>
    </div>

@stop