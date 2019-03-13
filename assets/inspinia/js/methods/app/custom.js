$(document).ready(function() {
  $(".status1").hide();
  $(".status2").hide();
  $(".linestatus").hide();

  $("#status1").click(function() {
    $(".status1").slideDown();
    $(".status2").hide();
    $(".linestatus").slideDown();
  });

  $("#status2").click(function() {
    $(".status2").slideDown();
    $(".status1").hide();
    $(".linestatus").slideDown();
  });

});
