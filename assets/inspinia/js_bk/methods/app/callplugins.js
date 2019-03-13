define(["jquery","bootstrap","summernote","dataTables"], function($) {
  var methods = {}

  methods.summernote = function(e){
    $('.summernote').summernote({
      height: 320
    });
  }

  methods.dataTables = function(e){

    var table = $('.dataTables-example').DataTable({
      searching: true,
      ordering:  false,
      bLengthChange: false,
      pageLength: 25
    });
    $(".dataTables_filter").hide();
    $('#btnsearch').on( 'click', function () {
        var val = $("#search-draw").val();
        console.log(val);
        table.search( val ).draw();
    });

  }

  return methods;
});
