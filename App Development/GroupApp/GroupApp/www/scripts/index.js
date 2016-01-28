// For an introduction to the Blank template, see the following documentation:
// http://go.microsoft.com/fwlink/?LinkID=397704
// To debug code on page load in Ripple or on Android devices/emulators: launch your app, set breakpoints,
// and then run "window.location.reload()" in the JavaScript Console.
(function () {
    "use strict";

    document.addEventListener('deviceready', onDeviceReady.bind(this), false);

    function onDeviceReady() {
        alert("ready");
        // Handle the Cordova pause and resume events
        document.addEventListener('pause', onPause.bind(this), false);
        document.addEventListener('resume', onResume.bind(this), false);

        //calls the login function when login button is clicked.

        $('.login-btn').click(login);
        $('.logout-btn').click(logout);

        //call server to increase answer count
        /**
         *$('.answer-btn').click(function () {
        *   var radios = document.getElementsByName("rdoBtn");
        *    for (var i=0;i<radios.length;i++){
        *        if (radios[i].checked){
        *            alert(radios[i].value);
        *            break;
        *        }
        *    }
        *});
         **/

        $('.answer-btn').click(function () {
            var value = this.value;
            $.getJSON("test.json", function (StudDetail) {

                var username = StudDetail["username"];
                alert("You have submit your answer \nYour answer is " + value);
/*
                var request = $.ajax({

                    url: "bartalveyhe.me",
                    method: "POST",
                    data: {username: username, answer: value}

                });

                request.done(function (msg) {
                    alert(msg);

                });*/
                $('.answer-btn').prop("disabled", true);
                window.location.href = "#StudentLanding";

            });

        });
        // TODO: Awaiting server to come online
        /*
        $('.question-btn').click(function () {
            var QandA = '{"question":' + $('.questTxt').value + ', "optA":' + $('.optA').value + ', "optB":' + $('.optB').value +
                ', "optC":' + $('.optC').value + ', "optD":' + $('.optD').value + '}';
            alert("You have submit question " + $('.questTxt').value + "\n" + "Answers are " + $('.optA').value
                +" "+ $('.optB').value +" "+ $('.optC').value +" "+ $('.optD').value);
            var request = $.ajax({

                url: "bartalveyhe.me",
                method: "POST",
                data: QandA

            });

            request.done(function (msg) {
                alert(msg);

            });

        });*/
        //native popup
        if (navigator.notification) { // Override default HTML alert with native dialog
            window.alert = function (message) {
                navigator.notification.alert(
                    message, // message
                    null, // callback
                    "Royal Ray", // title
                    'OK' // buttonName
                );
            };
        }
    };


    /**
     * Handles logging in of the account and saving the session on the device.
     **/


    function login() {
        //retrieves username and password from the fields.
        var u = $("#username").val();
        var p = $("#password").val();
        alert("hello," + u + " " + p);
        //TODO: input validation
        //TODO: calls webserver to attempt to login
        //TODO: checks login status and decides if user should login.
        //If login is successful, directs to landing page.
        var isStudent = true;
        if (u.localeCompare("lecturer") == 0) {
            isStudent = false;
        }
        if (isStudent) {
            window.location.href = "#StudentLanding";
        } else {
            window.location.href = "#LecturerLanding";
        }

    };

    /**
     * Handles logging out of the account and clearing storage
     **/
    function logout() {
        alert("bye");
        //TODO: Clears session related data
        window.location.href = "#logIn";
    }

    function onPause() {
        // TODO: This application has been suspended. Save application state here.
    };

    function onResume() {
        // TODO: This application has been reactivated. Restore application state here.
    };


});
