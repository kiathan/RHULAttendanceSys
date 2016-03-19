/**
 * Handles logging in of the account and saving the session on the device.
 **/
var server = "https://bartalveyhe.me/";

function login() {
  //retrieves username and password from the fields.
  setNotification();
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
      success: function(data) {
        var loginresult = makeJSON(data);

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
      error: function(data) {

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
  } else {
    ActivityIndicator.hide();
    alert("Please enter username & password!");
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
    localStorage.isStudent = "true";

    if (localStorage.username < 100000000) {
      localStorage.isStudent = "false";
    }
    if (localStorage.isStudent == "true") {

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
    success: function(data) {
      ActivityIndicator.hide();

      var result1 = jQuery.parseJSON(data);
      var result;

      if (result1.state == "success") {
        result = result1[0][0];
      }
      if (result1.state == "failure") {
        $('.sign-in-btn').prop('disabled', false);
        alert(result1.message);
        loginReplyRedir();
      } else if (result.lecture.UserAttended == true) {
        alert("Awesome! You have signed in already.");
        loginReplyRedir();
      } else {
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
    error: function(data) {
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
 * Sign-in (attendance) button actionlistener
 **/
function signin() {
  //Sends acknowledgement message with the usage of the attendance module.
  navigator.notification.confirm(
    "I understand that, according to the school's regulation, I am not allowed to sign in for other students. Failure to adhere to the school's regulation may result in discliplinary action.", // message
    scanner, // method to call once user clicks the buttons.
    "Warning", // title
    ['I Agree', 'Cancel']
  );
};

/**
 * Handles the signing in to the server
 **/
function signin_withServer() {
  //Sets the current position of the user to localstorage variables
  setCurrentPosition();
  //Set activity indicator before loading an ajax call to send the message
  ActivityIndicator.show("Retrieving Class to sign in...");
  //Set the parameters to be sent to the server
  var u = localStorage.username;
  var t = localStorage.token;
  var c = localStorage.signinBarcode;
  var lat = localStorage.lat;
  var long = localStorage.long;
  var classCode = localStorage.currentClassCode;
  var url = server + "api/lecture_instends/auth";
  var dataString = "username=" + u + "&token=" + t + "&lectureAuthCode=" + c +
    "&lat=" + lat + "&long=" + long + "&classcode=" + classCode;

  //Ajax call to send sign in packet to the server
  $.ajax({
    method: "POST",
    url: url,
    data: dataString,
    tryCount: 0,
    retryLimit: 5,
    cache: false,
    success: function(data) {
      var result = makeJSON(data);
      //Hides the activity indicator after success response packet.
      ActivityIndicator.hide();

      //sets the screen with the display picture
      localStorage.currentClassStatus = result.state;
      //Displays status message to user.
      alert(result.message);
      //Sets status message to sign-in status.
      $("div.currentAttendance").text(result.message);
    },
    error: function(data) {
      //retry the internet call X number of times in case packet was not sent successfully
      this.tryCount++;
      if (this.tryCount <= this.retryLimit) {
        //try again
        $.ajax(this);
        return;
      }
      ActivityIndicator.hide();
      //In the case of error, alerts user and redirect to home page.
      alert("Server unavailable. Please try again later");
      loginReplyRedir();
    },
    timeout: 3000 //Set timeout of 3 seconds

  });
};

/**
 * Executes the barcode  scanner plugin to retrieve QR code
 **/
function scanner(input) {
  if (input == 1) {
    //Sets the current position of the user to localstorage variables
    setCurrentPosition();
    cordova.plugins.barcodeScanner.scan(
      function(result) {
        //Retrieves barcode scanner text from barcode scanner
        localStorage.signinBarcode = result.text;
        //Set Sign-in status message
        $("div.currentAttendance").text("Sending to Server...");
        signin_withServer();
        //Register quiz notification when user signs in successfully
        setNotification();
        //redirect page to show sign in status.
        window.location.href = "#AttendanceAfter";
      },
      function(error) {
        //Shows error message if barcodeScanner fails to work
        alert("Attendance sign-in unsuccessful! Please try again.");
        //Redirect to home page
        loginReplyRedir();
      });
  } else {
    loginReplyRedir();
  }
};


function answerQuestion() {
  ActivityIndicator.show("Sending answer to lecture...");
  var v = this.value;
  var u = localStorage.username;
  var t = localStorage.token;
  var cc = localStorage.currentClassCode;
  var url = server + "api/quiz/studentQuiz";
  var dataString = "username=" + u + "&awnser=" + v + "&courseID=" + cc +
    "&token=" + t;
  $.ajax({
    method: "POST",
    url: url,
    data: dataString,
    tryCount: 0,
    retryLimit: 5,
    cache: false,
    success: function(data) {
      var result = makeJSON(data);
      ActivityIndicator.hide();
      alert(result.message);

    },
    error: function(data) {
      this.tryCount++;
      if (this.tryCount <= this.retryLimit) {
        //try again
        $.ajax(this);
        return;
      }
      ActivityIndicator.hide();

      //alert(data);
      alert("Server unavailable, Please try again later.");
    },
    timeout: 3000 //3 seconds

  });
  window.location.href = "#StudentLanding";
};


function loadTimetable() {
  window.plugins.orientationLock.lock("landscape");
  var u = localStorage.username;
  var t = localStorage.token;
  var url = server + "api/lecture/index";
  var dataString = "username=" + u + "&token=" + t;
  var timetable = new Timetable();

  timetable.setScope(9, 22) //sets scope of table
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
    success: function(data) {
      $.each(data, function(index) {
        var starttimeFormat = (data[index].starttime).split(":");
        var endtimeFormat = (data[index].endtime).split(":");
        if (starttimeFormat[0] >= 9 && starttimeFormat[0] <= 21 &&
          endtimeFormat[0] <= 22 && endtimeFormat[0] >= 10) {
          timetable.addEvent((data[index].course.name + " - " + data[
              index].venue.name), (data[index].dayofweek).toUpperCase(),
            new Date(null, null, null, starttimeFormat[0],
              starttimeFormat[1]), new Date(null, null, null,
              endtimeFormat[0], endtimeFormat[1]), null, data[index]
            .UserAttended);

        }
      });
      ActivityIndicator.hide();

      var renderer = new Timetable.Renderer(timetable);
      renderer.draw('.timetable');
      // $('.time-entry').css("color", "red");


    },
    error: function(data) {
      ActivityIndicator.hide();
      alert("Error - Cannot connect to server")
    },
  });
  var renderer = new Timetable.Renderer(timetable);
  renderer.draw('.timetable');
  $('.timetable').fadeIn();
};


function start_Quiz() {
  start_stop_Quiz("start");
}

function stop_Quiz() {
  start_stop_Quiz("stop");
}

function start_stop_Quiz(input) {
  ActivityIndicator.show(input + "ing question...");
  var u = localStorage.username;
  var t = localStorage.token;
  var cc = localStorage.currentClassCode;
  var initQuiz = true;
  var url = server + "api/quiz/lectureQuiz";
  if (input != "start") {
    initQuiz = false;
  }
  var dataString = "username=" + u + "&courseID=" + cc + "&token=" + t +
    "&state=" + initQuiz;

  $.ajax({
    method: "POST",
    url: url,
    data: dataString,
    tryCount: 0,
    retryLimit: 5,
    cache: false,
    success: function(data) {
      var result = makeJSON(data);
      ActivityIndicator.hide();
      if (!initQuiz) {
        getStudentResult(result.data);
      }
      if (result.state == "success") {
        triggerNotification();
      }
      alert(result.message);

    },
    error: function(data) {
      this.tryCount++;
      if (this.tryCount <= this.retryLimit) {
        //try again
        $.ajax(this);
        return;
      }
      ActivityIndicator.hide();
      alert("Server unavailable, Please try again later.");


    },
    timeout: 3000 //3 seconds

  });
};

function triggerNotification() {
  var url = server + "js/RESTapi.php";
  $.ajax({
    method: "GET",
    url: url,
    tryCount: 0,
    retryLimit: 5,
    cache: false,
    success: function(data) {
      //alert("Notification sent to student.");
    },
    error: function(data) {
      this.tryCount++;
      if (this.tryCount <= this.retryLimit) {
        //try again
        $.ajax(this);
        return;
      }
      alert("Fail to send notification.");
    },
    timeout: 3000 //3 seconds

  });
}

function getStudentResult(data) {
  var ansA = 0;
  var ansB = 0;
  var ansC = 0;
  var ansD = 0;
  $.each(data, function(index) {
    if (data[index].awnser == "A") {
      ansA = data[index].count;
    } else if (data[index].awnser == "B") {
      ansB = data[index].count;
    } else if (data[index].awnser == "C") {
      ansC = data[index].count;
    } else if (data[index].awnser == "D") {
      ansD = data[index].count;
    }

  });
  var total = ansA + ansB + ansC + ansD;
  var potA = 100 * (ansA / total);
  var potB = 100 * (ansB / total);
  var potC = 100 * (ansC / total);
  var potD = 100 * (ansD / total);

  $('.quizResult').show();
  $('.quizResult').slideDown();

  $('div.quizAnsA').text(potA + "%" + "   |   " + ansA);
  $('div.quizAnsB').text(potB + "%" + "   |   " + ansB);
  $('div.quizAnsC').text(potC + "%" + "   |   " + ansC);
  $('div.quizAnsD').text(potD + "%" + "   |   " + ansD);


};

function setNotification() {

  var notificationOpenedCallback = function(jsonData) {
    if (localStorage.isStudent == "true") {
      window.location.href = "#StudentQuestion";
    }
  };
  window.plugins.OneSignal.init("f3910626-2f31-44fc-beeb-6bd9fb5103d5", {
      googleProjectNumber: "610240135914"
    },
    notificationOpenedCallback);

  window.plugins.OneSignal.enableNotificationsWhenActive(true);
  window.plugins.OneSignal.setSubscription(true);
};

function loadCurrentClass() {
  //get current class details
  ActivityIndicator.show("Retrieving Class...");
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
    success: function(data) {
      ActivityIndicator.hide();

      var result1 = makeJSON(data);

      if (result1.state == "failure") {
        alert(result1.message);
      } else {
        var result = result1[0][0];
        //sets the screen with the display picture
        localStorage.currentClassName = result.lecture.course.name;
        localStorage.currentClassCode = result.lecture.course.code;

        $("#lect_currentclass").val(localStorage.currentClassCode);
        $("#timePicker1").val(result.lecture.starttime);
      }
    },
    error: function(data) {
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

}

function scanInStud() {
  cordova.plugins.barcodeScanner.scan(
    function(result) {
      var studid = "100" + result.text.substring(2, 9);
      $('#studname').val(studid);

      window.location.href = "#LecturerSignInStud";
    },
    function(error) {
      alert("Scan card unsuccessful! Please key in successfully.");
    });
}

function signInStud_withServer() {
  ActivityIndicator.show("Signing in Student...");
  var u = localStorage.username;
  var t = localStorage.token;
  var time = $('#timePicker1').val();
  var stud = $('#studname').val();
  var cc = $('#lect_currentclass').val();
  var date = $('#datePicker1').val();
  var url = server + "/api/lecture_instends/authUser";
  var dataString = "username=" + u + "&token=" + t + "&time=" + time +
    "&student=" + stud + "&classcode=" + cc + "&date=" + date;
  setNotification();
  $.ajax({
    method: "POST",
    url: url,
    data: dataString,
    tryCount: 0,
    retryLimit: 5,
    cache: false,
    success: function(data) {
      ActivityIndicator.hide();

      var result = makeJSON(data);
      if (result.state == "failure") {
        alert(result.message);
      } else {
        alert(result.message);
        $('#studname').val("");
      }
    },
    error: function(data) {
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
}

function loadNextEvents() {
  $('#dataToday, #dataTomorrow').empty();
  var date = new Date();
  var day = date.getDay();


  var u = localStorage.username;
  var t = localStorage.token;
  var url = server + "api/lecture/index";
  var dataString = "username=" + u + "&token=" + t;
  var weekday = new Array(7);

  weekday[0] = "SUNDAY";
  weekday[1] = "MONDAY";
  weekday[2] = "TUESDAY";
  weekday[3] = "WEDNESDAY";
  weekday[4] = "THURSDAY";
  weekday[5] = "FRIDAY";
  weekday[6] = "SATURDAY";

  ActivityIndicator.show("Retrieving timetable information...");

  $.ajax({
    method: "POST",
    url: url,
    data: dataString,
    tryCount: 0,
    retryLimit: 5,
    cache: false,
    success: function(data) {

      $.each(data, function(index) {
        var starttimeFormat = (data[index].starttime).split(":");
        var endtimeFormat = (data[index].endtime).split(":");

        if (weekday[day - 1] == (data[index].dayofweek.toUpperCase())) {
          $("#dataToday").append("<div id='nextItem'><h4>" + data[
              index].course.name + "<br>" + starttimeFormat[0] +
            ":" + starttimeFormat[1] + " to " + endtimeFormat[0] +
            ":" + endtimeFormat[1] + "</h4></div>");
        }
        if (weekday[day + 1] == (data[index].dayofweek.toUpperCase())) {
          $("#dataTomorrow").append("<div id='nextItem'><h4>" + data[
              index].course.name + "<br>" + starttimeFormat[0] +
            ":" + starttimeFormat[1] + " to " + endtimeFormat[0] +
            ":" + endtimeFormat[1] + "</h4></div>");
        }

      });

      ActivityIndicator.hide();
      $('#dataToday, #dataTomorrow').slideDown('slow');


    },
    error: function(data) {
      ActivityIndicator.hide();
      alert("Error - Cannot connect to server")
    },
  })
};

function classAtd_withServer() {
  ActivityIndicator.show("Retrieving Attendance ...");
  var u = localStorage.username;
  var t = localStorage.token;
  var time = $('#timePicker_ca').val();

  var cc = $('#lect_currentclass_ca').val();
  var date = $('#datePicker_ca').val();
  var url = server + "/api/lecture_instends/attendes";
  var dataString = "username=" + u + "&token=" + t + "&time=" + time +
    "&classcode=" + cc + "&date=" + date;


  $.ajax({
    method: "POST",
    url: url,
    data: dataString,
    tryCount: 0,
    retryLimit: 5,
    cache: false,
    success: function(data) {
      ActivityIndicator.hide();

      var result = makeJSON(data);
      if (result.state == "failure") {
        alert(result.message);
        loginReplyRedir();
      } else {
        window.location.href = "#ClassAttendanceList";

        $('#classlist').empty();

        var presentnum = result.attendCount;
        var absentnum = result.absenceCount;
        $('#classlist').append(
          '<li data-role="list-divider">Present :' +
          presentnum + '</li>');

        //Adds Present Student
        $.each(result.attendStudents, function(index) {
          $('#classlist').append('<li><a>' + result.attendStudents[
              index].firstname +
            " " + result.attendStudents[index].lastname +
            '</a></li>'
          );
        });

        $('#classlist').append(
          '<li data-role="list-divider">Absent :' +
          absentnum + '</li>');

        //Adds Absent Student
        $.each(result.absenceStudents, function(index) {
          $('#classlist').append('<li><a>' + result.absenceStudents[
              index].firstname +
            " " + result.absenceStudents[index].lastname +
            '</a></li>');
        });
        $('#classlist').listview('refresh');
      }

    },
    error: function(data) {
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
