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



    $('.footer-base').clone().appendTo('.footer-copy');

    //calls the login functiwindow.plugins.OneSignalon when login button is clicked.
    $('.login-btn').click(login);
    $('.logout-btn').click(logout);
    $('.sign-in-btn').click(signin);
    $('.answer-btn').click(answerQuestion);
    $('.quiz-start-btn').click(start_Quiz);
    $('.quiz-stop-btn').click(stop_Quiz);
    $('.home-btn').click(loginReplyRedir);
    $('.sign-stud-btn').click(signInStud_withServer);
    $('.scan-stud-btn').click(scanInStud);
    $('.current-class-atd-btn').click(classAtd_withServer);
    $('.result-btn').click(getStudentResult);

    $(document).on("pageshow", "#TimetableScreen", loadTimetable);
    $(document).on("pageshow", "#StudentLanding", setOrientation);
    $(document).on("pageshow", "#LecturerLanding", setOrientation);
    $(document).on("pageshow", "#Attendance", loadAttendance);
    $(document).on("pageshow", "#LecturerSignInStud", loadCurrentClass);
    $(document).on("pageshow", "#CurrentClassAttendance",
      loadCurrentClass);
    $(document).on("pageshow", "#WhatsNext", loadNextEvents);

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
