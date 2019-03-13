define(["jquery", "jqueryForm", "toastr", "sweetalert"], function(
  $,
  jqueryForm,
  toastr,
  swal
) {
  var methods = {};

  methods.Testfunction = function(element, animation) {
    console.log("Testfunction");
  };
  /* ----------------------------------------------------------------------------------------
  function submit form
  ---------------------------------------------------------------------------------------- */
  //submit form [1]
  methods.dataSubmit = function(form) {
    $(form).ajaxSubmit({
      dataType: "json",
      success: function(result) {
        if (result.error === true) {
          swal(result.title, result.msg, "error");
        } else {
          console.log("dataSubmit");
          var link = result.url;
          swal(
            {
              title: result.title,
              text: result.msg,
              type: "success",
              showCancelButton: false
            },
            function() {
              window.location.href = link;
            }
          );
        }
      }
    });
  };

  //submit form [2]
  methods.dataSubmitdir = function(form) {
    $(form).ajaxSubmit({
      dataType: "json",
      success: function(result) {
        if (result.error === true) {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 4000
          };
          toastr.error(result.msg, result.title);
        } else {
          location.href = result.url;
        }
      }
    });
  };

  /* ----------------------------------------------------------------------------------------
  function submit form
  ---------------------------------------------------------------------------------------- */
  // checkboxall multi-select -------------------------------------->
  methods.checkboxall = function(e) {
    $("#checkall").click(function() {
      $(".item").prop("checked", this.checked);
    });
  };
  $("#checkall").click(function() {
    methods.checkboxall(this);
  });

  // checkboxall multi-delete-submit ------------------------------->
  methods.mutideletesubmit = function(e) {
    $(".btnsubdel").click(function() {
      var urlFrom = $(".btnsubdel").attr("data-url");
      console.log(urlFrom);
      swal(
        {
          title: "ต้องการลบข้อมูล?",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "ยกเลิก",
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ยืนยัน",
          closeOnConfirm: false
        },
        function(isConfirm) {
          if (isConfirm) {
            if ($("input[class='item']").is(":checked")) {
              console.log(urlFrom);
              document.getElementById("formMuti").action = urlFrom;
              $("#formMuti").submit();
              console.log("มี");
            } else {
              console.log(urlFrom);
              console.log("ไม่มี");
              swal("Error!", "กรุณาเลือกข้อมูลที่ต้องการลบ", "error");
            }
          }
        }
      );
    });
  };
  $(".btnsubdel").click(function() {
    methods.mutideletesubmit(this);
  });

  // checkboxall multi-activate-submit ------------------------------->
  methods.mutiactivatesubmit = function(e) {
    $(".btnsubatv").click(function() {
      var urlFrom = $(".btnsubatv").attr("data-url");
      console.log(urlFrom);
      swal(
        {
          title: "ต้องการอัพเดตสถานะใบสั่งซื้อ?",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "ยกเลิก",
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ยืนยัน",
          closeOnConfirm: false
        },
        function(isConfirm) {
          if (isConfirm) {
            if ($("input[class='item']").is(":checked")) {
              console.log(urlFrom);
              document.getElementById("formMuti").action = urlFrom;
              $("#formMuti").submit();
              console.log("มี");
            } else {
              console.log(urlFrom);
              console.log("ไม่มี");
              swal("Error!", "กรุณาเลือกข้อมูลที่ต้องการอัพเดตสถานะ", "error");
            }
          }
        }
      );
    });
  };
  $(".btnsubatv").click(function() {
    methods.mutiactivatesubmit(this);
  });
  
  // printview -------------------------------------->
  methods.printview = function(e) {
    $("#btn-print").click(function() {
      var headstr = "<html><head><title></title></head><body>";
      var footstr = "</body>";
      var newstr = document.getElementById("thisprint").innerHTML;
      var oldstr = document.body.innerHTML;
      document.body.innerHTML = headstr + newstr + footstr;
      window.print();
      document.body.innerHTML = oldstr;
      return false;
    });
  };
  $("#btn-print").click(function() {
    methods.printview(this);
  });
  /* ----------------------------------------------------------------------------------------
  btn-function
  ---------------------------------------------------------------------------------------- */
  //deleteData
  methods.deleteData = function(e) {
    var url = $(e).attr("data-url");
    swal(
      {
        title: "ต้องการลบข้อมูล?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "ยกเลิก",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "ยืนยัน",
        closeOnConfirm: false
      },
      function(isConfirm) {
        if (isConfirm) {
          location.href = url;
        }
      }
    );
  };
  $(".btn-delete").click(function() {
    methods.deleteData(this);
  });

  //checkdeleteData
  methods.checkdelete = function(e) {
    var url = $(e).attr("data-url");
    var urlCheck = $(e).attr("data-urlCheck");
    swal(
      {
        title: "ต้องการลบข้อมูล?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete!",
        closeOnConfirm: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            method: "POST",
            dataType: "json",
            url: urlCheck,
            success: function(result) {
              if (result.error === true) {
                swal(result.title, result.msg, "error");
              } else {
                location.href = url;
              }
            }
          });
        }
      }
    );
  };

  //deleteData
  methods.activatedata = function(e) {
    var url = $(e).attr("data-url");
    swal(
      {
        title: "ต้องการอัพเดตสถานะใบสั่งซื้อ?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "ยกเลิก",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "ยืนยัน",
        closeOnConfirm: false
      },
      function(isConfirm) {
        if (isConfirm) {
          location.href = url;
        }
      }
    );
  };
  $(".btn-activate").click(function() {
    methods.activatedata(this);
  });

  //checkdeleteData
  methods.choosedata = function(e) {
    var url = $(e).attr("data-url");
    var urlCheck = $(e).attr("data-urlCheck");
    swal(
      {
        title: "ต้องการเลือกรายการนี้?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#27ae60",
        confirmButtonText: "Submit",
        closeOnConfirm: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            method: "POST",
            dataType: "json",
            url: urlCheck,
            success: function(result) {
              if (result.error === true) {
                swal(result.title, result.msg, "error");
              } else {
                location.href = url;
              }
            }
          });
        }
      }
    );
  };

  /* ----------------------------------------------------------------------------------------
  function filemanager
  ---------------------------------------------------------------------------------------- */
  methods.jsonFilemanager = function(listFile) {
    var siteUrl = listFile.attr("data-url");
    var jsonUrl = siteUrl + "manager/filemanager/jsonListdata";
    var typeFile = listFile.attr("data-type");
    var Folder = listFile.attr("data-folder");
    var Tags = listFile.attr("data-tags");
    $.ajax({
      method: "POST",
      dataType: "json",
      url: jsonUrl,
      data: {
        typeFile: typeFile,
        Folder: Folder,
        Tags: Tags
      },
      beforeSend: function() {},
      success: function(result) {
        console.log(result);
        listFile.html("");
        $.each(result.listdata, function(index, item) {
          var Texthtml =
            '<a href="' +
            siteUrl +
            "filemanager/" +
            item.file_folder +
            "/" +
            item.file_name +
            '" target="_blank"><span class="corner"></span>';
          var $ext = item.file_name.split(".").pop();
          if ($ext == "jpg" || $ext == "png" || $ext == "gif") {
            Texthtml +=
              '<div class="image"><img alt="image" class="img-responsive" src="' +
              siteUrl +
              "filemanager/" +
              item.file_folder +
              "/" +
              item.file_name +
              '"></div>';
          } else if ($ext == "mp3") {
            Texthtml += '<div class="icon"><i class="fa fa-music"></i>a</div>';
          } else if ($ext == "mpg4") {
            Texthtml +=
              '<div class="icon"><i class="img-responsive fa fa-film"></i></div>';
          } else if ($ext == "xls" || $ext == "xlsx") {
            Texthtml +=
              '<div class="icon"><i class="fa fa-bar-chart-o"></i></div>';
          } else {
            Texthtml += '<div class="icon"><i class="fa fa-file"></i></div>';
          }
          Texthtml +=
            '<div class="file-name">' +
            item.file_name +
            "<br/><small>Added: " +
            item.file_lastedit +
            '</small><br /><small class="tooltip-demo"></a>';
          Texthtml +=
            '<button class="btn btn-white Btn-delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Move to trash" data-url="' +
            siteUrl +
            "manager/filemanager/delete/" +
            item.file_id +
            '"><i class="fa fa-trash"></i></button>';
          Texthtml +=
            '<button class="btn btn-white pull-right clipboard" data-toggle="tooltip" data-placement="top" title="" data-original-title="Copy url file" data-clipboard-text="' +
            siteUrl +
            "filemanager/" +
            item.file_folder +
            "/" +
            item.file_name +
            '"><i class="fa fa-copy"></i></button>';
          Texthtml += "</small></div>";
          listFile.append(
            $('<div class="file-box"></div>').append(
              $('<div class="file"></div>').html(Texthtml)
            )
          );
        });
      }
    });
  };

  return methods;
});
