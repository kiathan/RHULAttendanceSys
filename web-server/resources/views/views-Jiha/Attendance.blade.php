<!DOCTYPE html>
<html>
<head>
    <title>RHUL Attendance System</title>
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "//css/bootstrap.min.css">
    <link href = "//css/style.css" rel = "stylesheet">
    <link rel="shortcut icon" href="//C:\Users\J.H.Kim\Documents\GitHub\TP2\TeamProject06\AttendanceWeb\images\RHicon.ico">

</head>
<body>
<div class = "navbar navbar-inverse navbar-static-top">
    <div class = "container">
        <a href="index.blade.php" class = "navbar-brand" data-toggle="tooltip" title="Go to the homepage">Attendance System</a>

        <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
        </button>

        <div class = "collapse navbar-collapse navHeaderCollapse">

            <ul class = "nav navbar-nav navbar-right">

                <li class = "active"><a href = "index.blade.php">Home</a></li>
                <li class = "active"><a href = "Attendance.blade.php">Attendance</a></li>


                <li><a href = "QA.blade.php">Q&A</a></li>
                <li><a href = "timetable.blade.php">Timetable</a></li>
                <li><a href = "contact.blade.php">Contact us</a></li>


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

<div class = "container">

    <div class = "jumbotron">
        <center>
            <h1>Attendance page</h1>
            <p>This page is for Attendance system</p>
            <p>It has to be shown after login</p>
            <a class = "btn btn-info">Click</a>
        </center>
    </div>

</div>

<div class = "container">

    <div class = "row">

        <div class = "col-md-4">

            <h3><a href = "#">abcd</a></h3>
            <p>paragraph abcdefg</p>
            <a href = "#" class = "btn btn-default">Read More</a>

        </div>

        <div class = "col-md-4">

            <h3><a href = "#">abcd</a></h3>
            <p>paragraph abcdefg</p>
            <a href = "#" class = "btn btn-default">Read More</a>

        </div>

        <div class = "col-md-4">

            <h3><a href = "#">abcd</a></h3>
            <p>paragraph abcdefg</p>
            <a href = "#" class = "btn btn-default">Read More</a>

        </div>

    </div>

</div>


<div class = "navbar navbar-default navbar-fixed-bottom">

    <div class = "container">
        <p class = "navbar-text pull-left">Site Built By Team6</p>
        <a href = "//http:moodle.rhul.ac.uk" class = "navbar-btn btn-danger btn pull-right"data-toggle="tooltip" title="Link to Moodle">RHUL MOODLE</a>
    </div>


    <script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src = "js/bootstrap.js"></script>


</body>
</html>