requirejs.config({
  // baseUrl: 'http://msh-rmutr.pe.hu/assets/inspinia/js/lib',
  baseUrl: "http://localhost:7000/assets/inspinia/js/lib",

  paths: {
    jquery: "jquery-2.1.1",
    bootstrap: "bootstrap.min",
    metisMenu: "plugins/metisMenu/jquery.metisMenu",
    slimscroll: "plugins/slimscroll/jquery.slimscroll.min",
	//summernote -------------------------------------------------------------------->
    codemirror: "plugins/codemirror/codemirror",
    summernote: "plugins/summernote/summernote",
	codemirrorjs: "plugins/codemirror/mode/javascript/javascript",
	//end summernote -------------------------------------------------------------------->
    jqueryForm: "plugins/jqueryForm/jquery.form",
    validate: "plugins/validate/jquery.validate.min",
	toastr: "plugins/toastr/toastr.min",
	//dataTable -------------------------------------------------------------------->
    dataTable: "plugins/dataTables/datatables",
    dataTablesbuttons: "plugins/dataTables/dataTables.buttons.min",
    dataTablesbuttonshtml5: "plugins/dataTables/buttons.html5.min",
    dataTablesPrint: "plugins/dataTables/buttons.print.min",
	dataTablesResponsive:"plugins/dataTables/Responsive-2.2.2/js/dataTables.responsive.min",
	//end dataTable -------------------------------------------------------------------->
    sweetalert: "plugins/sweetalert/sweetalert.min",
    clipboard: "plugins/clipboard/clipboard.min",
    inspinia: "../methods/inspinia.min",
    function: "../methods/app/function",
    callvalidate: "../methods/callvalidate.min",
    callplugins: "../methods/callplugins.min"
  },
  shim: {
    bootstrap: {
      deps: ["jquery"]
    },
    codemirrorjs: {
      deps: ["codemirror"]
    },
    metisMenu: {
      deps: ["jquery"]
    },
    slimscroll: {
      deps: ["jquery"]
    },
    summernote: {
      deps: ["jquery", "bootstrap", "codemirror"]
    },
    jqueryForm: {
      deps: ["jquery"]
    },
    clipboard: {
      deps: ["jquery"]
    },
    dataTablesResponsive: {
      deps: ["jquery"]
    },
    dataTablesPrint: {
      deps: ["jquery"]
    },
    dataTablesbuttonshtml5: {
      deps: ["jquery"]
    },
    dataTablesbuttons: {
      deps: ["jquery"]
    },
    dataTable: {
      deps: ["jquery"],
      exports: "DataTable"
    },
    inspinia: {
      deps: ["jquery", "metisMenu", "slimscroll"]
    }
  },
  map: {
    "*": {
      "datatables.net": "dataTable",
      "datatables.net-buttons": "dataTablesbuttons"
    }
  }
});

// Start the main app logic.
requirejs(
  [
    "jquery",
    "bootstrap",
    "codemirrorjs",
    "metisMenu",
    "slimscroll",
    "codemirror",
    "summernote",
    "jqueryForm",
    "validate",
    "clipboard",
    "inspinia"
  ],
  function($) {
    // @ts-ignore
    require(["function", "callplugins", "callvalidate", "clipboard"], function(
      fun,
      plug,
      vali,
      Clipboard
    ) {
      new Clipboard(".clipboard");
      plug.summernote();
      vali.validate();

      if ($("#listFile").length) {
        var listFile = $("#listFile");
        fun.jsonFilemanager(listFile);
      }
      //btn-function-------------------------------------------->
      //reload
      $(".btn-reload").click(function() {
        location.reload();
      });
      //delete
      $(".btn-delete").click(function() {
        fun.deleteData(this);
      });
      //checkdelete
      $(".btn-checkdelete").click(function() {
        fun.checkdelete(this);
      });
      //activatedata
      $(".btn-activate").click(function() {
        fun.activatedata(this);
      });
      //choose
      $(".btn-choose").click(function() {
        fun.choosedata(this);
      });
      //---------------------------------------->
      //multi-select-------------------------------------------->
      fun.checkboxall(this);
      fun.mutideletesubmit(this);
      fun.mutiactivatesubmit(this);
      fun.printview(this);
      //---------------------------------------->
      // data-table -------------------------------------------->
      plug.dataTables();
      plug.dataTablesTotal();
      plug.dataTablesPack();
      plug.dataTableBill();
      plug.dataTableSTD();
      //---------------------------------------->
      // filemanager -------------------------------------------->
      $(".file-type").click(function() {
        $(".file-type").removeClass("active");
        $(this).addClass("active");
        var type = $(this).attr("data-type");
        listFile.attr("data-type", type);
        fun.jsonFilemanager(listFile);
      });

      $(".file-folder").click(function() {
        $(".file-folder i").removeClass("fa-folder-open");
        $("i", this).addClass("fa-folder-open");
        var folder = $(this).attr("data-folder");
        listFile.attr("data-folder", folder);
        fun.jsonFilemanager(listFile);
      });

      $(".file-tag").click(function() {
        $(this).toggleClass("active");
        var tag = $(this).attr("data-tag");
        var tags = listFile.attr("data-tags");
        if (tags != "") {
          var t = tags.split(",");
          var key = $.inArray(tag, t);
          if (key >= 0) {
            t = $.grep(t, function(value) {
              return value != tag;
            });
          } else {
            t.push(tag);
          }
          t.toString();
        } else {
          t = tag;
        }

        listFile.attr("data-tags", t);
        fun.jsonFilemanager(listFile);
      });

      $(".btn-url").click(function() {
        var Url = $(this).attr("data-url");
        window.open(Url, "_blank");
      });

      $(".btn-eye").click(function() {
        $(".Text_eye").each(function() {
          var v = $(this).val();
          if (v == 1) {
            $(this).val(2);
          } else {
            $(this).val(1);
          }
        });
        $("i", this).toggleClass("fa-eye-slash fa-eye");
      });

      $(".btn-check").click(function() {
        $(".Text_check").each(function() {
          var v = $(this).val();
          if (v == 1) {
            $(this).val(2);
          } else {
            $(this).val(1);
          }
        });
        $("i", this).toggleClass("fa-check-square fa-check-square-o");
      });
      //---------------------------------------->
    });
  }
);
