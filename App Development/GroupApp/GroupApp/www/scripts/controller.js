/**
 * Handles logging in of the account and saving the session on the device.
 **/
var server = "https://bartalveyhe.me/";

function login() {
    //retrieves username and password from the fields.

    ActivityIndicator.show("Logging you in...");
    var u = $("#username").val();
    var p = $("#password").val();
    var pHashed = Sha256.hash(p);
    var url = server + "api/auth/login";
    var dataString = "username=" + u + "&password=" + pHashed;
    localStorage.username = u;
    //alert("hello," + u + " " + p);

    //empty string validation
    if ($.trim(u).length > 0 & $.trim(p).length > 0) {
        $.ajax({
            method: "POST",
            url: url,
            data: dataString,
            tryCount: 0,
            retryLimit: 5,
            cache: false,
            success: function (data) {
                var loginresult = data;
                ActivityIndicator.hide();
                if (loginresult.state == "success" && loginresult.username ==
                    localStorage.username) {
                    localStorage.login = "true";
                    localStorage.token = loginresult.token;
                } else if (loginresult.state == "failure") {
                    localStorage.login = "false";
                    localStorage.loginerror = "incorrect";
                } else {
                    localStorage.login = "false";
                    localStorage.loginerror = "timeout";
                }
                loginReplyRedir();
            },
            error: function (data) {

                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    //try again
                    $.ajax(this);
                    return;
                }
                ActivityIndicator.hide();
                localStorage.login = "false";
                localStorage.loginerror = "timeout";
                loginReplyRedir();
            },
            timeout: 3000 //3 seconds

        });
    }
};

function loginReplyRedir() {
    setCurrentPosition();
    if (localStorage.loginerror == "incorrect" && localStorage.login ==
        "false") {
        alert("Username/Password is invalid.");
        window.location.href = "#logIn";
    } else if (localStorage.loginerror == "timeout" && localStorage.login ==
        "false") {
        alert("Server unavailable. Please try again later.");
        window.location.href = "#logIn";
    } else if (localStorage.login == "true") {
        var isStudent = true;

        if (localStorage.username == "lecturer") {
            isStudent = false;
        }
        if (isStudent) {
            window.location.href = "#StudentLanding";
        } else {
            window.location.href = "#LecturerLanding";
        }
    }
};

/**
 * Handles logging out of the account and clearing storage
 **/
function logout() {
    localStorage.login = "false";
    window.location.href = "#logIn";
};

//Loads and Displays the current class
function loadAttendance() {
    setCurrentPosition();
    $('.sign-in-btn').prop('disabled', true);

    ActivityIndicator.show("Retrieving Class to sign in...");
    var u = localStorage.username;
    var t = localStorage.token;
    var url = server + "/api/lecture_instends/index";
    var dataString = "username=" + u + "&token=" + t;

    $.ajax({
        method: "POST",
        url: url,
        data: dataString,
        tryCount: 0,
        retryLimit: 5,
        cache: false,
        success: function (data) {
            ActivityIndicator.hide();

            if (data.substring(11, 18) == "failure") {
                var result = jQuery.parseJSON(data);
                alert(result.message);
                loginReplyRedir();
            } else {

                var datastr = data.substring(3, data.length - 2);
                var result = jQuery.parseJSON(datastr);

                //sets the screen with the display picture
                localStorage.currentClassName = result.lecture.course.name;
                localStorage.currentClassCode = result.lecture.course.code;
                localStorage.currentClassLat = result.lecture.venue.geoX;
                localStorage.currentClassLong = result.lecture.venue.geoY;
                localStorage.currentClassVenue = result.lecture.venue.name;

                var dist = getDistanceFromLatLonInKm(localStorage.lat,
                    localStorage.long, localStorage.currentClassLat,
                    localStorage.currentClassLong);

                if (dist > 10) { //geolocation distance limit to be set (in KM)
                    alert("You are too far away from the venue");
                    loginReplyRedir();
                } else {
                    $("div.currentclass").text(localStorage.currentClassName);
                    $("div.distance").text(dist);
                    $("div.currentClassVenue").text(localStorage.currentClassVenue);
                    //enables the button
                    $('.sign-in-btn').prop('disabled', false);
                }
            }


        },
        error: function (data) {
            this.tryCount++;
            if (this.tryCount <= this.retryLimit) {
                //try again
                $.ajax(this);
                return;
            }
            ActivityIndicator.hide();
        },
        timeout: 3000 //3 seconds

    });
};

/**
 * Handles logging out of the account and clearing storage
 **/
function signin() {
    setCurrentPosition();
    navigator.notification.confirm(
        "I understand that, according to the school's regulation, I am not allowed to sign in for other students. Failure to adhere to the school's regulation may result in discliplinary action.", // message
        scanner, // callback
        "Warning", // title
        ['I Agree', 'Cancel']
    );
};

/**
 * Handles the signing in to the server
 **/
function signin_withServer() {
    setCurrentPosition();
    ActivityIndicator.show("Retrieving Class to sign in...");
    var u = localStorage.username;
    var t = localStorage.token;
    var c = localStorage.signinBarcode;
    var lat = localStorage.lat;
    var long = localStorage.long;
    var classCode = localStorage.currentClassCode;
    var url = server + "api/lecture_instends/auth";
    var dataString = "username=" + u + "&token=" + t + "&lectureAuthCode=" + c +
        "&lat=" + lat + "&long=" + long + "&classcode=" + classCode;

    $.ajax({
        method: "POST",
        url: url,
        data: dataString,
        tryCount: 0,
        retryLimit: 5,
        cache: false,
        success: function (data) {
            var result = JSON.parse(data);
            ActivityIndicator.hide();

            //sets the screen with the display picture
            localStorage.currentClassStatus = result.state;
            alert(result.message);
            $("div.currentAttendance").text(result.message);

            if ($("div.currentAttendance").text() == "Sending to Server...") {
                alert("Server unavailable. Please try again later");
                loginReplyRedir();
            }

        },
        error: function (data) {
            this.tryCount++;
            if (this.tryCount <= this.retryLimit) {
                //try again
                $.ajax(this);
                return;
            }
            ActivityIndicator.hide();

            alert("Server unavailable. Please try again later");
            loginReplyRedir();

        },
        timeout: 3000 //3 seconds

    });
};


function scanner(input) {
    if (input == 1) {
        setCurrentPosition();
        cordova.plugins.barcodeScanner.scan(
            function (result) {
                localStorage.signinBarcode = result.text;
                $("div.currentAttendance").text("Sending to Server...");
                $("div.locationX").text(localStorage.lat);
                $("div.locationY").text(localStorage.long);
                signin_withServer();

                window.location.href = "#AttendanceAfter";
            },
            function (error) {
                alert("Attendance sign-in unsuccessful! Please try again.");
                loginReplyRedir();
            });

    } else {
        loginReplyRedir();
    }
    //TODO: Clears session related data


};


function answerQuestion() {
    var value = this.value;
    var username = localStorage.username;

    alert("You have submit your answer \nYour answer is " +
        value);

    var request = $.ajax({

        url: "bartalveyhe.me/quiz/studentQuiz",
        method: "POST",
        data: {user_id: username, answer: value, courseID: localStorage.currentClassCode}

    });

    request.done(function (msg) {
        alert(msg);
    });
    request.fail(function (msg) {
        alert(msg);
    });


    //$('.answer-btn').prop("disabled", true);
    window.location.href = "#StudentLanding";

};

function start_stop_Quiz() {

    var initQuiz = this.value;


    //var requestQuiz = '{"initQuiz":' + initQuiz + ', "token":' + token + '}';

    alert("You have " + initQuiz + " question. ");

    var request = $.ajax({

        url: "bartalveyhe.me/quiz.lecturerQuiz",
        method: "POST",
        data: {user_id: username, state: initQuiz, courseID: localStorage.currentClassCode}
    });

    request.done(function (msg) {
        alert(msg);
    });
    request.fail(function (msg) {
        alert(msg);
    });


};

function loadTimetable() {
    window.plugins.orientationLock.lock("landscape");
    var u = localStorage.username;
    var t = localStorage.token;
    var url = server + "api/lecture/index";
    var dataString = "username=" + u + "&token=" + t;

    var timetable = new Timetable();

    timetable.setScope(0, 23) //sets scope of table
    timetable.addLocations(['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY',
        'FRIDAY', 'SATURDAY', 'SUNDAY'
    ]); //row headings

    ActivityIndicator.show("Retrieving timetable information...");
    $.ajax({
        method: "POST",
        url: url,
        data: dataString,
        tryCount: 0,
        retryLimit: 5,
        cache: false,
        success: function (data) {


            $.each(data, function (index) {

                var starttimeFormat = (data[index].starttime).split(":");
                var endtimeFormat = (data[index].endtime).split(":");
                //alert(starttimeFormat[0] + endtimeFormat[0]);


                timetable.addEvent((data[index].course_id + " - " + data[index].venue.name), (data[index].dayofweek).toUpperCase(), new Date(null, null, null, starttimeFormat[0], starttimeFormat[1]), new Date(null, null, null, endtimeFormat[0], endtimeFormat[1]));

            });

            ActivityIndicator.hide();
            var renderer = new Timetable.Renderer(timetable);
            renderer.draw('.timetable');

        },
        error: function (data) {
            ActivityIndicator.hide();
            alert("Error - Cannot connect to server")

        },

    });


    var renderer = new Timetable.Renderer(timetable);
    renderer.draw('.timetable');

    $('.timetable').fadeIn();


};

function setOrientation() {
    window.plugins.orientationLock.lock("portrait");
};

function unlockOrientation() {
    window.plugins.orientationLock.unlock();
};