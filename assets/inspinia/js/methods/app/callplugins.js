define([
  "jquery",
  "bootstrap",
  "summernote",
  "dataTable",
  "dataTablesbuttons",
  "dataTablesbuttonshtml5",
  "dataTablesPrint",
  "dataTablesResponsive",
], function($) {
  var methods = {};

  /* ----------------------------------------------------------------------------------------
  summernote && uploadImage for summernote
  ---------------------------------------------------------------------------------------- */
  methods.summernote = function(e) {
    $(".summernote").summernote({
      height: 320,
      callbacks: {
        onImageUpload: function(image) {
          uploadImage(image[0]);
        }
      }
    });
    function uploadImage(image) {
      var $url = $(".summernote").attr("data-img");
      var data = new FormData();
      data.append("File_images", image);
      $.ajax({
        url: $url,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
        success: function(url) {
          var image = $("<img>").attr("src", url);
          $(".summernote").summernote("insertNode", image[0]);
        },
        error: function(data) {
          console.log(data);
        }
      });
    }
  };

  /* ----------------------------------------------------------------------------------------
  list data-table
  ---------------------------------------------------------------------------------------- */
  //data-table default
  methods.dataTables = function(e) {
    var table = $(".dataTables-example").DataTable({
      destroy: true,
      searching: true,
      ordering: false,
      bLengthChange: false,
      pageLength: 10
    });
    $(".dt-buttons").hide();
    $(".dataTables_filter").hide();
    $("#btnsearch").on("click", function() {
      var val = $("#search-draw").val();
      table.search(val).draw();
    });
  };

  //data-table จัดเซตเครื่องแบบ (ตารางใหญ่ข้างบน)
  methods.dataTablesTotal = function(e) {
    var tableT = $(".dataTables-total").DataTable({
      searching: true,
      ordering: false,
      bLengthChange: false,
      pageLength: 20,
      footerCallback: function(row, data, start, end, display) {
        var api = this.api(),
          data;
        var intVal = function(i) {
          return typeof i === "string"
            ? i.replace(/[\$,]/g, "") * 1
            : typeof i === "number"
            ? i
            : 0;
        };

        // Total over all pages
        total = api
          .column(7)
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        // Total over this page
        pageTotal = api
          .column(7, { page: "current" })
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        // Update footer
        $(api.column(7).footer()).html(
          pageTotal
            .toFixed(2)
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        );
      }
    });
    $(".dataTables_filter").hide();
    $("#btnsearchT").on("click", function() {
      var val = $("#search-drawT").val();
      console.log(val);
      tableT.search(val).draw();
    });
  };

  //data-table จัดเซตเครื่องแบบ (ตารางเล็กข้างล่าง)
  methods.dataTablesPack = function(e) {
    var tableP = $(".dataTables-package").DataTable({
      destroy: true,
      searching: true,
      ordering: false,
      info: false,
      bLengthChange: false,
      pageLength: 5
    });
    $(".dt-buttons").hide();
    $(".dataTables_filter").hide();
    $("#btnsearch-pack").on("click", function() {
      var val = $("#search-pack").val();
      tableP.search(val).draw();
    });
  };

  methods.dataTableBill = function(e){
    var tableB = $('.dataTables-exampleB').DataTable({
    destroy: true,
    responsive: true,
  	 searching: true,
  	 ordering:  false,
  	 bLengthChange: false,
  	 pageLength: 25,
  	 dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'purchase-order',
                exportOptions: {
                  columns: [ 1, 2, 3, 4, 5, 6, 7, 9 ]
                }
            },
            {
                extend: 'print',
                title: 'ใบสั่งซื้อ',
                customize: function (win){
                  $(win.document.body).addClass('white-bg');
                  $(win.document.body).css('font-size', '10px');
                  $(win.document.body).find('table')
                  .addClass('compact')
                  .css('font-size', 'inherit');
                },
                exportOptions: {
                  columns: [ 1, 2, 3, 4, 5, 6, 7, 9 ]
                }
            }
        ]
    });
    $(".dt-buttons").hide();
    $(".dataTables_filter").hide();
    $('#btnsearchB').on( 'click', function () {
        var val = $("#search-drawB").val();
        tableB.search( val ).draw();
    });
    $('#btnexportB').on('click', function () {
      tableB.button( '.buttons-excel' ).trigger();
    });
    $('#btnprintB').on('click', function () {
      tableB.button( '.buttons-print' ).trigger();
    });
  }

  methods.dataTableSTD = function(e){
    var tableS = $('.dataTables-exampleS').DataTable({
    destroy: true,
    responsive: true,
  	 searching: true,
  	 ordering:  false,
  	 bLengthChange: false,
  	 pageLength: 25,
  	 dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'list-student-data',
                exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5]
                }
            }
        ]
    });
    $(".dt-buttons").hide();
    $(".dataTables_filter").hide();
    $('#btnsearchS').on( 'click', function () {
        var val = $("#search-drawS").val();
        tableS.search( val ).draw();
    });
    $('#btnexportS').on('click', function () {
      tableS.button( '.buttons-excel' ).trigger();
    });
  }

  return methods;
});
