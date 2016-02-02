/**
 * Handles logging in of the account and saving the session on the device.
 **/
function login() {
  //retrieves username and password from the fields.
  var u = $("#username").val();
  var p = $("#password").val();
  ActivityIndicator.show("Securing your password...");
  var pHashed = Sha256.hash(p);
  ActivityIndicator.hide();
  var url = "https://bartalveyhe.me/api/auth/login";
  var dataString = "username=" + u + "&password=" + pHashed + "&login=";
  //alert("hello," + u + " " + p);

  //empty string validation


  if ($.trim(u).length > 0 & $.trim(p).length > 0) {
    $.ajax({
      method: "POST",
      url: "https://bartalveyhe.me/api/auth/login",
      data: {username: "FakeUserName", password:"FakeUserName"},
      crossDomain: true,
      cache: false,
      beforeSend: function() {
        ActivityIndicator.show("Logging you in...");
      },
      success: function(data) {
        alert(data);
        ActivityIndicator.hide();

        if (data == "success") {
          localStorage.login = "true";
          localStorage.username = u;
        } else if (data == "failed") {
          localStorage.login = "false";
          localStorage.loginerror = "incorrect";
        } else {
          localStorage.login = "true";
          localStorage.loginerror = "timeout";
        }
        loginReplyRedir();
      },
      error: function(data) {
        alert("fail");
        ActivityIndicator.hide();
        localStorage.login = "true";
        localStorage.loginerror = "timeout";
        loginReplyRedir();
      },
      timeout: 5000 //5 seconds
    });
  }
  //TODO: checks login status and decides if user should login.
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
  navigator.notification.alert(
    "I understand that, according to the school's regulation, I am not allowed to sign in for other students. Failure to adhere to the school's regulation may result in discliplinary action.", // message
    scanner(), // callback
    "Warning", // title
    'I agree' // buttonName
  );
};

function scanner() {
  cordova.plugins.barcodeScanner.scan(
    function(result) {
      alert("We got a barcode\n" +
        "Result: " + result.text + "\n" +
        "Format: " + result.format + "\n" +
        "Cancelled: " + result.cancelled);
    },
    function(error) {
      alert("Sign in unsuccessful! Please try again.");
    }
  );
  //TODO: Clears session related data
  window.location.href = "#logIn";
};


function onPause() {
  // TODO: This application has been suspended. Save application state here.
};

function onResume() {
  // TODO: This application has been reactivated. Restore application state here.
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

function sendQuestion() {
  var optA = $('#optA').val();
  var optB = $('#optB').val();
  var optC = $('#optC').val();
  var optD = $('#optD').val();
  var newQuestion = $('#questTxt').val();

  /*
  var questionAnswer = '{"question":' + $('.questTxt').value + ', "optA":' + $('.optA').value + ', "optB":' + $('.optB').value +
      ', "optC":' + $('.optC').value + ', "optD":' + $('.optD').value + '}';*/
  alert("You have submit question " + newQuestion + "\n" +
    "Answers are " + optA + " " + optB + " " + optC + " " +
    optD);
  window.location.href = "#LecturerLanding";
  /*
  var request = $.ajax({

      url: "bartalveyhe.me",
      method: "POST",
      data: questionAnswer

  });

  request.done(function (msg) {
      alert(msg);

  });
   */
};
