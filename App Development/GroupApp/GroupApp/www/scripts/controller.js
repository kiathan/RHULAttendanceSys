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
      success: function(data) {
        var loginresult = JSON.parse(data);

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
  }
};

function loginReplyRedir() {
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

function setCurrentPosition() {
  navigator.geolocation.getCurrentPosition(
    function(position) {
      localStorage.lat = position.coords.latitude;
      localStorage.long = position.coords.longitude;
    },
    function() {
      alert('Please enable location services and try again!');
    });
}

function scanner(input) {
  if (input == 1) {
    setCurrentPosition();
    cordova.plugins.barcodeScanner.scan(
      function(result) {
        localStorage.signinBarcode = result.text;
        $("div.currentAttendance").text(localStorage.signinBarcode);
        $("div.locationX").text(localStorage.lat);
        $("div.locationY").text(localStorage.long);

        window.location.href = "#AttendanceAfter";
      },
      function(error) {
        alert("Attendance sign-in unsuccessful! Please try again.");
        loginReplyRedir();
      });

  } else {
    loginReplyRedir();
  }
  //TODO: Clears session related data


};


//enables and set native pop up
function enableNativePopUp() {

  if (navigator.notification) { // Override default HTML alert with native dialog
    window.alert = function(message) {
      navigator.notification.alert(
        message, // message
        null, // callback
        "Royal Ray", // title
        'OK' // buttonName
      );
    };
    window.confirm = function(message) {
      navigator.notification.confirm(
        message, // message
        null, // callback
        "Royal Ray", // title
        'OK' // buttonName
      );
    };
  }

};

function answerQuestion() {
  var value = this.value;
  $.getJSON("test.json", function(StudDetail) {
    var username = StudDetail["username"];
    alert("You have submit your answer \nYour answer is " +
      value);
    /*
     var request = $.ajax({

     url: "bartalveyhe.me",
     method: "POST",
     data: {username: username, answer: value}

     });

     request.done(function (msg) {
     alert(msg);
     }
     */
    $('.answer-btn').prop("disabled", true);
    window.location.href = "#StudentLanding";
  });
};

function start_stop_Quiz() {

  var initQuiz = this.value;

  /*
   var requestQuiz = '{"initQuiz":' + initQuiz + ', "token":' + token + '}';*/
  alert("You have " + initQuiz + " question. ");
  /*
   var request = $.ajax({

   url: "bartalveyhe.me",
   method: "POST",
   data: requestQuiz

   });

   request.done(function (msg) {
   alert(msg);

   });
   */
};

function loadTimetable() {

  var course;
  var day;
  var startHour;
  var endHour;

  var timetable = new Timetable();

  timetable.setScope(9, 18) //sets scope of table
  timetable.addLocations(['Monday', 'Tuesday', 'Wednesday', 'Thursday',
    'Friday'
  ]); //row headings

  $.getJSON("TODO", function(result) {
    $.each(result, function(i, field) {
      $("div").append(field + " ");
    });
  });



  var renderer = new Timetable.Renderer(timetable);
  renderer.draw('.timetable');

  //Checks orientation of screen
  if (window.orientation == 90) {
    $('.timetable').fadeIn();
  } else {
    $('#rotateWarning').fadeIn('slow');
  }

  $(window).on("orientationchange", function() {
    if (window.orientation == 0 || window.orientation == 180) // Portrait
    {
      $('.timetable').hide();
      $('#rotateWarning').fadeIn('slow');
    } else // Landscape
    {
      $('.timetable').fadeIn();
      $('#rotateWarning').hide();
    }
  });
};
