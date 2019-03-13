$(document).ready(function() {
  $('#example').DataTable({
    responsive: true,
    searching: false,
    ordering: false,
    destroy: true,
    bLengthChange: false
  });
  //hide tool 
  $(".dataTables_paginate").hide();
  $(".dataTables_info").hide();
  $(".dataTables_filter").hide();
});