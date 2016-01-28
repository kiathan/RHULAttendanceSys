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

    //footer
    $('.footer-base').clone().appendTo('.footer-copy');

    //calls the login function when login button is clicked.
    $('.login-btn').click(login);
    $('.logout-btn').click(logout);
    //native popup
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


})();
