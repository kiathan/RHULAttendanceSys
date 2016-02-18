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

function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2 - lat1); // deg2rad below
  var dLon = deg2rad(lon2 - lon1);
  var a =
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
    Math.sin(dLon / 2) * Math.sin(dLon / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c; // Distance in km
  return d;
}

function deg2rad(deg) {
  return deg * (Math.PI / 180)
}

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
