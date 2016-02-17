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


                <li><a href = "QA.html">Q&A</a></li>
                <li><a href = "timetable.html">Timetable</a></li>
                <li class = "active"><a href = "contact.html">Contact us</a></li>

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

<form method="post" action="sendingMessage.php">

    <table width="450px">

        <tr>

            <td valign="top">

                <label for="first_name">First Name *</label>

            </td>

            <td valign="top">

                <input  type="text" name="first_name" maxlength="50" size="30">

            </td>

        </tr>

        <tr>

            <td valign="top"">

            <label for="last_name">Last Name *</label>

            </td>

            <td valign="top">

                <input  type="text" name="last_name" maxlength="50" size="30">

            </td>

        </tr>

        <tr>

            <td valign="top">

                <label for="email">Email Address *</label>

            </td>

            <td valign="top">

                <input  type="text" name="email" maxlength="80" size="30">

            </td>

        </tr>

        <tr>

            <td valign="top">

                <label for="telephone">Telephone Number</label>

            </td>

            <td valign="top">

                <input  type="text" name="telephone" maxlength="30" size="30">

            </td>

        </tr>

        <tr>

            <td valign="top">

                <label for="comments">Comments *</label>

            </td>

            <td valign="top">

                <textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>

            </td>

        </tr>

        <tr>

            <td colspan="2" style="text-align:center">

                <input type="submit" value="Submit">

            </td>

        </tr>

    </table>

</form>



<h1 class = "text-center">Contact us</h1>
<p>If you have any problem or question, contact us!</p>
<address>
    <strong>RHUL Administration office</strong><br>
    Royal Holloway University of London<br>
    Egham Hill, Egham, Surrey, TW20 0EX<br>
    <i class = "fa fa-phone"></i> (123) 456-7890
</address>

<address>
    <strong>Email</strong><br>
    <a href="mailto:#">admin@live.rhul.ac.uk</a>
</address>




<div class = "navbar navbar-default navbar-fixed-bottom">

    <div class = "container">
        <p class = "navbar-text pull-left">Site Built By Team6</p>
        <a href = "http:moodle.rhul.ac.uk" class = "navbar-btn btn-danger btn pull-right"data-toggle="tooltip" title="Link to Moodle">RHUL MOODLE</a>
    </div>


    <script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src = "js/bootstrap.js"></script>


</body>
</html>