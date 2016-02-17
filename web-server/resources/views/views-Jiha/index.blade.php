<!DOCTYPE html>
<html>
<head>
    <title>RHUL Attendance System</title>
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link href = "css/bootstrap.min.css" rel = "stylesheet">
    <link href = "css/style.css" rel = "stylesheet">
    <link rel="shortcut icon" href="C:\Users\J.H.Kim\Documents\GitHub\TP2\TeamProject06\AttendanceWeb\images\RHicon.ico">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>
<body>
    <div class="container">
        @yield('content')
    </div>



<div class = "navbar navbar-inverse navbar-static-top">
    <div class = "container">
        <a href="index.html" class = "navbar-brand" data-toggle="tooltip" title="Go to the homepage">Attendance System</a>

        <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
        </button>

        <div class = "collapse navbar-collapse navHeaderCollapse">

            <ul class = "nav navbar-nav navbar-right">

                <li class = "active"><a href = "#">Home</a></li>
                <li><a href = "Attendance.html">Attendance</a></li>


                <li><a href = "QA.html">Q&A</a></li>
                <li><a href = "timetable.html">Timetable</a></li>
                <li><a href = "contact.html">Contact us</a></li>

                <li class = "dropdown">

                    <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">Login<b class = "caret"></b></a>

                    <ul class = "dropdown-menu">
                        <li><a href = "#loginStudent" data-toggle = "modal">Student</a></li>
                        <li><a href = "#loginLecturer" data-toggle = "modal">Lecturer</a></li>

                    </ul>
                </li>

            </ul>

        </div>
    </div>
</div>


<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img class="img-responsive" src="C:\Users\J.H.Kim\Documents\GitHub\TP2\TeamProject06\AttendanceWeb\images\rhul1.jpg" >
            <div class="carousel-caption">
                <h2>Title</h2>
                <p>Description</p>
            </div>
        </div>

        <div class="item">
            <img class="img-responsive" src="C:\Users\J.H.Kim\Documents\GitHub\TP2\TeamProject06\AttendanceWeb\images\rhul3.jpg">
            <div class="carousel-caption">
                <h2>Title</h2>
                <p>Description</p>
            </div>
        </div>

        <div class="item">
            <img class="img-responsive" src="C:\Users\J.H.Kim\Documents\GitHub\TP2\TeamProject06\AttendanceWeb\images\rhul2.jpg">
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





<div class = "navbar navbar-default navbar-fixed-bottom">

    <div class = "container">
        <p class = "navbar-text pull-left">Site Built By Team6</p>
        <a href = "http:moodle.rhul.ac.uk" class = "navbar-btn btn-danger btn pull-right"data-toggle="tooltip" title="Link to Moodle">RHUL MOODLE</a>
    </div>
</div>

<div class = "modal fade" id = "loginStudent" role = "dialog">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <form class="form-horizontal">

                <div class = "modal-header">
                    <h3>Login for students</h3>
                </div>
                <div class = "modal-body">

                    <div class="form-group">
                        <label for="inputUserName3" class="col-sm-2 control-label">User ID</label>
                        <div class="col-sm-10">
                            <input type="UserName" class="form-control" id="inputUserName3" placeholder="eg)zava123">
                            <?php
                            $str = 'UserName';
                            if(strlen($str)<8){
                                echo "<p>Invalid user name</p>"
									}
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "modal-footer">
                    <button class = "btn btn-info" type = "login">Login</button>
                    <a class = "btn btn-default" data-dismiss = "modal">Close</a>
                </div>
            </form>
        </div>

    </div>
</div>

<div class = "modal fade" id = "loginLecturer" role = "dialog">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <form class="form-horizontal">

                <div class = "modal-header">
                    <h3>Login for lecturers</h3>
                </div>
                <div class = "modal-body">

                    <div class="form-group">
                        <label for="inputUserName3" class="col-sm-2 control-label">User ID</label>
                        <div class="col-sm-10">
                            <input type="UserName" class="form-control" id="inputUserName3" placeholder="eg)zava123">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "modal-footer">
                    <button class = "btn btn-success" type = "login">Login</button>
                    <a class = "btn btn-default" data-dismiss = "modal">Close</a>
                </div>
            </form>
        </div>

    </div>
</div>

<div class = "modal fade" id = "loginStaff" role = "dialog">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <form class="form-horizontal">

                <div class = "modal-header">
                    <h3>Login for staffs</h3>
                </div>
                <div class = "modal-body">

                    <div class="form-group">
                        <label for="inputUserName3" class="col-sm-2 control-label">User ID</label>
                        <div class="col-sm-10">
                            <input type="UserName" class="form-control" id="inputUserName3" placeholder="eg)zava123">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "modal-footer">
                    <button class = "btn btn-warning" type = "login">Login</button>
                    <a class = "btn btn-default" data-dismiss = "modal">Close</a>
                </div>
            </form>
        </div>

    </div>
</div>

<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src = "js/bootstrap.js"></script>


</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: J.H.Kim
 * Date: 2/18/2016
 * Time: 1:12 AM
 */