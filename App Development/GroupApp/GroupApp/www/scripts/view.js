 // For an introduction to the Blank template, see the following documentation:
// http://go.microsoft.com/fwlink/?LinkID=397704
// To debug code on page load in Ripple or on Android devices/emulators: launch your app, set breakpoints,
// and then run "window.location.reload()" in the JavaScript Console.
(function() {

  "use strict";

  document.addEventListener('deviceready', onDeviceReady.bind(this), false);

  function onDeviceReady() {
    window.plugins.orientationLock.lock("portrait");
    // Handle the Cordova pause and resume events
    document.addEventListener('pause', onPause.bind(this), false);
    document.addEventListener('resume', onResume.bind(this), false);
    // Enable to debug issues.
    // window.plugins.OneSignal.setLogLevel({logLevel: 4, visualLevel: 4});

    //Push notification registration.
    var notificationOpenedCallback = function(jsonData) {
      alert("Received!");
    };
    window.plugins.OneSignal.init("f3910626-2f31-44fc-beeb-6bd9fb5103d5", {
        googleProjectNumber: "610240135914"
      },
      notificationOpenedCallback);
    // Show an alert box if a notification comes in when the user is in your app.
    window.plugins.OneSignal.enableNotificationsWhenActive(true);
    window.plugins.OneSignal.setSubscription(true);

    $('.footer-base').clone().appendTo('.footer-copy');

    //calls the login functiwindow.plugins.OneSignalon when login button is clicked.
    $('.login-btn').click(login);
    $('.logout-btn').click(logout);
    $('.sign-in-btn').click(signin);
    $('.answer-btn').click(answerQuestion);
    $('.quiz-btn').click(start_stop_Quiz);
    $('.home-btn').click(loginReplyRedir);
    $('.sign-stud-btn').click(signInStud_withServer);
    $('.scan-stud-btn').click(scanInStud);
    $('.current-class-atd-btn').click(classAtd_withServer);

    $(document).on("pageshow", "#TimetableScreen", loadTimetable);
    $(document).on("pageshow", "#StudentLanding", setOrientation);
    $(document).on("pageshow", "#LecturerLanding", setOrientation);
    $(document).on("pageshow", "#Attendance", loadAttendance);
    $(document).on("pageshow", "#LecturerSignInStud", loadCurrentClass);
    $(document).on("pageshow", "#CurrentClassAttendance",
      loadCurrentClass);

    window.plugins.html5Video.initialize({
      "rhul_video": "rhul.mp4",
    })
    window.plugins.html5Video.play("rhul_video")

    //native popup
    enableNativePopUp();


  };

  function onPause() {
    // TODO: This application has been suspended. Save application state here.
  };

  function onResume() {
    // TODO: This application has been reactivated. Restore application state here.
  };
})();
