// For an introduction to the Blank template, see the following documentation:
// http://go.microsoft.com/fwlink/?LinkID=397704
// To debug code on page load in Ripple or on Android devices/emulators: launch your app, set breakpoints, 
// and then run "window.location.reload()" in the JavaScript Console.
(function () {
    "use strict";

    document.addEventListener('deviceready', onDeviceReady.bind(this), false);


    function onDeviceReady() {
        // Handle the Cordova pause and resume events
        document.addEventListener( 'pause', onPause.bind( this ), false );
        document.addEventListener( 'resume', onResume.bind( this ), false );
        
        $('#bt').click(function () {
            navigator.camera.getPicture(cameraSuccess, cameraError, { quality: 50,
                destinationType: Camera.DestinationType.DATA_URL
            });

        });
        
        
    };

    function onPause() {
        // TODO: This application has been suspended. Save application state here.
    };

    function onResume() {
        // TODO: This application has been reactivated. Restore application state here.
            navigator.notification.alert(
                'Sample native alert message',
                alertDismissed,
                device.model,
                'alert');
        
    };

    function alertDismissed() {

    }

    function cameraSuccess(imageData) {
        var file = "data:image/jpeg;base64," + imageData;
        $('div').append('<img src=file height="42" width="42"></img>');
    }

    function cameraError() { }

    



} )();