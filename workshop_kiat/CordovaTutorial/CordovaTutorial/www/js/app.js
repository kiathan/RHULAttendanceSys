// We use an "Immediate Function" to initialize the application to avoid leaving anything behind in the global scope
(function() {

  /* ---------------------------------- Local Variables ---------------------------------- */
  HomeView.prototype.template = Handlebars.compile($("#home-tpl").html());
  EmployeeListView.prototype.template = Handlebars.compile($(
    "#employee-list-tpl").html());
  var service = new EmployeeService();
  service.initialize().done(function() {
    $('body').html(new HomeView(service).render().$el);
    console.log("Service initialized");
  });

  /* --------------------------------- Event Registration -------------------------------- */
  //$('.search-key').on('keyup', findByName);
  $('.help-btn').on('click', function() {
    alert("Employee Directory v3.4");
  });

  document.addEventListener('deviceready', function() {
    StatusBar.overlaysWebView(false);
    StatusBar.backgroundColorByHexString('#ffffff');
    StatusBar.styleDefault();
    FastClick.attach(document.body);
    if (navigator.notification) {
      //overrrides default HTML alert with native dialog
      window.alert = function(message) {
        navigator.notification.alert(
          message, //message
          null, //callback
          "Workshop", //title
          'OK' //button name
        );
      };
    }
  }, false);

  /* ---------------------------------- Local Functions ---------------------------------- */



}());
