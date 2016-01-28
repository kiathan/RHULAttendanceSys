 // For an introduction to the Blank template, see the following documentation:
// http://go.microsoft.com/fwlink/?LinkID=397704
// To debug code on page load in Ripple or on Android devices/emulators: launch your app, set breakpoints,
// and then run "window.location.reload()" in the JavaScript Console.
(function() {
  "use strict";

  document.addEventListener('deviceready', onDeviceReady.bind(this), false);

  function onDeviceReady() {
    // Handle the Cordova pause and resume events
    document.addEventListener('pause', onPause.bind(this), false);
    document.addEventListener('resume', onResume.bind(this), false);

    $('.footer-base').clone().appendTo('.footer-copy');

    //calls the login function when login button is clicked.
    $('.login-btn').click(login);
    $('.logout-btn').click(logout);
    $('.sign-in-btn').click(signin);

    //$('.scanner')
    //native popup
    enableNativePopUp();



  };
  /**
   * Handles logging in of the account and saving the session on the device.
   **/
  function login() {
    //retrieves username and password from the fields.
    var u = $("#username").val();
    var p = $("#password").val();
    var url = "http://bartalveyhe.me";
    var dataString = "username=" + u + "&password=" + p + "&login=";
    //alert("hello," + u + " " + p);

    //empty string validation
    if ($.trim(u).length > 0 & $.trim(p).length > 0) {
      $.ajax({
        type: "POST",
        url: url,
        data: dataString,
        crossDomain: true,
        cache: false,
        beforeSend: function() {
          ActivityIndicator.show("Logging in...");
        },
        success: function(data) {
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
  }

  /**
   * Handles logging out of the account and clearing storage
   **/
  function logout() {
    localStorage.login = "false";
    window.location.href = "#logIn";
  }

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

  }

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
  }


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
  }


})();
