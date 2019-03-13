$(document).ready(function() {
  var tableEX = $(".dataTables-EX").DataTable({
    searching: true,
    ordering: false,
    pageLength: 25,
    lengthChange: false,
    dom: 'B<"clear">lfrtip',
    buttons: [
      {
        extend: "excel",
        title: "list-register",
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 7]
        }
      },
      {
        extend: "print",
        title: "",
        message: '<font size="5px">ข้อมูลใบสมัคร</font><hr>',
        customize: function(win) {
          $(win.document.body).addClass("white-bg");
          $(win.document.body).css("font-size", "10px");
          $(win.document.body)
            .find("table")
            .addClass("compact")
            .css("font-size", "inherit");
        },
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 7]
        }
      }
    ]
  });
  $(".dataTables_filter").hide();
  $("#btnsearchEX").on("click", function() {
    var val = $("#search-drawEX").val();
    console.log(val);
    tableEX.search(val).draw();
  });
});
