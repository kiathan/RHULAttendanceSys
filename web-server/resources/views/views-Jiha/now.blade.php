<!DOCTYPE html>
<html>
<head>
    <title>RHUL Attendance System</title>
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link href = "css/bootstrap.min.css" rel = "stylesheet">
    <link href = "css/style.css" rel = "stylesheet">
    <link rel="shortcut icon" href="C:\Users\J.H.Kim\Documents\GitHub\TP2\TeamProject06\AttendanceWeb\images\RHicon.ico">

</head>
<body>
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

                <li class = "active"><a href = "index.html">Home</a></li>
                <li><a href = "Attendance.html">Attendance</a></li>


                <li class = "active"><a href = "QA.html">Q&A</a></li>
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






<div class = "navbar navbar-default navbar-fixed-bottom">

    <div class = "container">
        <p class = "navbar-text pull-left">Site Built By Team6</p>
        <a href = "http:moodle.rhul.ac.uk" class = "navbar-btn btn-danger btn pull-right"data-toggle="tooltip" title="Link to Moodle">RHUL MOODLE</a>
    </div>


    <script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src = "js/bootstrap.js"></script>


</body>
</html>